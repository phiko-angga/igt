<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuLevel;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Log;
use Redirect;

class UserPrivilegeController extends Controller
{
    public function index(Request $request){
        $title = "Setting User";
        $breadcrumb = ['Setting','User'];

        $mUserLevel = new UserLevel();
        $userLevel = $mUserLevel->get_data($request);
        $search = $request->search;
        
        if($request->ajax()){
            return view('user_privilege.list_pagination', compact('userLevel','search'));
        }else
            return view('user_privilege.list',compact('userLevel','title','breadcrumb'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $action = 'store';
        $title = 'Add new user privilege';
        $breadcrumb = ['Setting','User Privilege','Add new'];
        
        $menu_parent = Menu::select('id','name')->where('parent',0)->get();
        $menu = new Menu();
        $menuList = $menu->get_menu_level_permission();
        $menu = $menuList->groupBy('parent');

        return view('user_privilege.form',compact('action','title','breadcrumb','menu','menu_parent'));
    }
 
    public function store(Request $request)
    {
        request()->validate([
            'level'   => 'required|unique:users_level',
            'menu'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['level']);
            $userLevel = UserLevel::create($data);

            //ADD MENU PERMISSION
            $menu = $request->menu;
            $akses = [];
            foreach($menu as $m){
                $akses[]= [
                    'level_id' => $userLevel->id,
                    'menu_id' => $m,
                ];
            }
            $menuLevel = MenuLevel::insert($akses);

            DB::commit();
            return redirect('/setting/user-privilege')->with('success', 'User Privilege added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'User Privilege added failed, please try again.']);
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $userLevel = UserLevel::find($id);
        if($userLevel){
            $action = 'update';
            $title = 'update user privilege';
            $breadcrumb = ['Setting','User Privilege','update'];
            
            $menu_parent = Menu::select('id','name')->where('parent',0)->get();
            $mMenu = new Menu; 
            $menuList = $mMenu->get_menu_level_permission($userLevel->id);
            $menu = $menuList->groupBy('parent');
            
            $attribute = 'checked2';
            $value = 1;
            $menu_selected = $menuList->filter(function ($item) use ($attribute, $value) {
                return strtolower($item[$attribute]) == strtolower($value);
            })->pluck('id');
            $menu_selected = array_values($menu_selected->toArray());
            return view('user_privilege.form',compact('action','title','breadcrumb','userLevel','menu','menu_parent','menu_selected'));
        }else{
            return Redirect::back()->withErrors(['error'=> 'User Privilege not found.']);
        }
    }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'level'   => 'required|unique:users_level,level,'.$id,
            'menu'   => 'required',
        ]);
        
        $userLevel = UserLevel::find($id);
        if($userLevel){

            DB::beginTransaction();
            try {
                $data = $request->only(['level']);

                UserLevel::where('id',$userLevel->id)->update($data);

                //ADD MENU PERMISSION
                $deleteOldMenu = MenuLevel::where('level_id',$userLevel->id)->delete();
                $menu = $request->menu;
                $akses = [];
                foreach($menu as $m){
                    $akses[]= [
                        'level_id' => $userLevel->id,
                        'menu_id' => $m,
                    ];
                }
                $menuLevel = MenuLevel::insert($akses);

                DB::commit();

                return redirect('/setting/user-privilege')->with('success', 'User privilege updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'User privilege updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'User privilege not found.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userLevel = UserLevel::find($id);
        if($userLevel){
            UserLevel::where('id',$userLevel->id)->delete();
            return redirect('/setting/user-privilege')->with('success', 'User privilege deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'User privilege not found.']);
        }
    }
}
