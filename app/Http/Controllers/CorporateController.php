<?php

namespace App\Http\Controllers;

use App\Models\Corporate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Redirect;
use Log;

class CorporateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $title = "Master Corporate";
        $breadcrumb = ['Master','Corporate'];

        $corporate = new Corporate();
        $corporate = $corporate->get_data($request);
        $search = $request->search;
         
        if($request->ajax()){
            return view('corporate.list_pagination', compact('Corporate','search'));
        }else
            return view('corporate.list',compact('corporate','title','breadcrumb'));
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
         $title = 'Add new Corporate';
         $breadcrumb = ['Master','Corporate','Add new'];
         return view('corporate.form',compact('action','title','breadcrumb'));
     }

    public function store(Request $request)
    {
        request()->validate([
            'company'   => 'required',
            'number'   => 'required',
            'address'   => 'required',
            'municipio_id'   => 'required|exists:municipio,id',
            'posto_id'   => 'required|exists:posto,id',
            'suco_id'   => 'required|exists:suco,id',
            'aldeia_id'   => 'required|exists:aldeia,id',
            'commactivity_auth_id'   => 'required|exists:commactivity_auth,id',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except(['id','_method']);
            
            $corporate = Corporate::create($data);
            DB::commit();

            return redirect('/master/corporate')->with('success', 'Corporate added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Corporate added failed, please try again.']);
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
         $corporate = Corporate::find($id);
         if($corporate){
            $action = 'update';
            $title = 'Update master Corporate';
            $breadcrumb = ['Master','Corporate','update'];
            return view('corporate.form',compact('corporate','action','title','breadcrumb'));
         }else{
            return Redirect::back()->withErrors(['error'=> 'Corporate not found.']);
         }
     }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'company'   => 'required',
            'number'   => 'required',
            'address'   => 'required',
            'municipio_id'   => 'required|exists:municipio,id',
            'posto_id'   => 'required|exists:posto,id',
            'suco_id'   => 'required|exists:suco,id',
            'aldeia_id'   => 'required|exists:aldeia,id',
            'commactivity_auth_id'   => 'required|exists:commactivity_auth,id',
        ]);
        $corporate = Corporate::find($id);
        if($corporate){

            DB::beginTransaction();
            try {
                $data = $request->except(['_method','id','_token']);

                Corporate::where('id',$corporate->id)->update($data);
                DB::commit();

                return redirect('/master/corporate')->with('success', 'Corporate updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Corporate updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Corporate not found.']);
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
        
        $corporate = Corporate::find($id);
        if($corporate ){
            Corporate::where('id',$corporate->id)->delete();
            return redirect('/master/corporate')->with('success', 'User deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Corporate not found.']);
        }
    }

}
