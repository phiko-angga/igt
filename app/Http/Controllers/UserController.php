<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Log;
use Redirect;

class UserController extends Controller
{
    public function index(Request $request){
        $title = "Setting User";
        $breadcrumb = ['Setting','User'];

        $mUser = new User();
        $users = $mUser->get_data($request);
        $search = $request->search;
        
        if($request->ajax()){
            return view('user.list_pagination', compact('users','search'));
        }else
            return view('user.list',compact('users','title','breadcrumb'));
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
        $title = 'Add new user';
        $breadcrumb = ['Setting','User','Add new'];
        $levels = UserLevel::all();
        return view('user.form',compact('action','title','breadcrumb','levels'));
    }
 
    public function store(Request $request)
    {
        request()->validate([
            'name'   => 'required',
            'username'   => 'required',
            'password'   => 'required|min:8',
            'password_confirm'   => 'required|min:8|same:password',
            'user_level'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['name','username','user_level']);
            $data['password'] = Hash::make($request->password);
            $data['email'] = $request->username.'@gmail.com';
            $user = User::create($data);

            DB::commit();
            return redirect('/setting/user')->with('success', 'User added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'User added failed, please try again.']);
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
        $users = User::find($id);
        if($users){
            $levels = UserLevel::all();
            $action = 'update';
            $title = 'update user';
            $breadcrumb = ['Setting','User','update'];
            return view('user.form',compact('users','action','title','breadcrumb','levels'));
        }else{
            return Redirect::back()->withErrors(['error'=> 'User not found.']);
        }
    }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'name'   => 'required',
            'username'   => 'required',
            'user_level'   => 'required',
            'password'   => 'nullable|min:8',
            'password_confirm'   => 'nullable|min:8|same:password',
        ]);
        $user = User::find($id);
        if($user){

            DB::beginTransaction();
            try {
                $data = $request->only(['name','username','user_level']);
                if($request->has('email')) $data['email'] = $request->email;
                if(isset($request->password)){
                    $data['password'] = Hash::make($request->password);
                }

                User::where('id',$user->id)->update($data);
                DB::commit();

                return redirect('/setting/user')->with('success', 'User updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'User updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'User not found.']);
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
        $user = User::find($id);
        if($user ){
            User::where('id',$user->id)->delete();
            return redirect('/setting/user')->with('success', 'User deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'User not found.']);
        }
    }
}
