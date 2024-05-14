<?php

namespace App\Http\Controllers;

use App\Models\CommActivityAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Redirect;
use Log;

class CommActivityAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $title = "Master Commercial Activity Authorized";
        $breadcrumb = ['Master','Commercial Activity Authorized'];

        $mCommActivityAuth = new CommActivityAuth();
        $commActivityAuth = $mCommActivityAuth->get_data($request);
        $search = $request->search;
         
        if($request->ajax()){
            return view('comm_activity_auth.list_pagination', compact('commActivityAuth','search'));
        }else
            return view('comm_activity_auth.list',compact('commActivityAuth','title','breadcrumb'));
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
         $title = 'Add new commercial activity authorized';
         $breadcrumb = ['Master','commercial activity authorized','Add new'];
         return view('comm_activity_auth.form',compact('action','title','breadcrumb'));
     }

    public function store(Request $request)
    {
        request()->validate([
            'id_number'   => 'required|unique:commactivity_auth',
            'description'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['id_number','description','description2']);
            
            $commActivityAuth = CommActivityAuth::create($data);
            DB::commit();

            return redirect('/master/comm-activity-auth')->with('success', 'Commercial activity authorized added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Commercial activity authorized added failed, please try again.']);
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
         $commActivityAuth = CommActivityAuth::find($id);
         if($commActivityAuth){
            $action = 'update';
            $title = 'Update master Commercial activity authorized';
            $breadcrumb = ['Master','Commercial activity authorized','update'];
            return view('comm_activity_auth.form',compact('commActivityAuth','action','title','breadcrumb'));
         }else{
            return Redirect::back()->withErrors(['error'=> 'Commercial activity authorized not found.']);
         }
     }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'id_number'   => 'required|unique:commactivity_auth,id_number,'.$id,
            'description'   => 'required',
        ]);
        $commActivityAuth = CommActivityAuth::find($id);
        if($commActivityAuth){

            DB::beginTransaction();
            try {
                $data = $request->only(['id_number','desription','description2']);
                CommActivityAuth::where('id',$commActivityAuth->id)->update($data);
                DB::commit();

                return redirect('/master/comm-activity-auth')->with('success', 'Commercial activity authorized updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Commercial activity authorized updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Commercial activity authorized not found.']);
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
        
        $commActivityAuth = CommActivityAuth::find($id);
        if($commActivityAuth ){
            CommActivityAuth::where('id',$commActivityAuth->id)->delete();
            return redirect('/master/comm-activity-auth')->with('success', 'Commercial activity authorized deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Commercial activity authorized not found.']);
        }
    }

}
