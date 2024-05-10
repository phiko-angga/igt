<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Redirect;
use Log;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $title = "Master Municipio";
        $breadcrumb = ['Master','Municipio'];

        $mMunicipio = new Municipio();
        $municipio = $mMunicipio->get_data($request);
        $search = $request->search;
         
        if($request->ajax()){
            return view('municipio.list_pagination', compact('municipio','search'));
        }else
            return view('municipio.list',compact('municipio','title','breadcrumb'));
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
         $title = 'Add new municipio';
         $breadcrumb = ['Master','Municipio','Add new'];
         return view('municipio.form',compact('action','title','breadcrumb'));
     }

    public function store(Request $request)
    {
        request()->validate([
            'municipio'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['municipio']);
            
            $municipio = Municipio::create($data);
            DB::commit();

            return redirect('/master/municipio')->with('success', 'Municipio added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Municipio added failed, please try again.']);
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
         $municipio = Municipio::find($id);
         if($municipio){
            $action = 'update';
            $title = 'Update master municipio';
            $breadcrumb = ['Master','Municipio','update'];
            return view('municipio.form',compact('municipio','action','title','breadcrumb'));
         }else{
            return Redirect::back()->withErrors(['error'=> 'Municipio not found.']);
         }
     }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'municipio'   => 'required',
        ]);
        $municipio = Municipio::find($id);
        if($municipio){

            DB::beginTransaction();
            try {
                $data = $request->only(['municipio']);

                Municipio::where('id',$municipio->id)->update($data);
                DB::commit();

                return redirect('/master/municipio')->with('success', 'Municipio updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Municipio updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Municipio not found.']);
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
        
        $municipio = Municipio::find($id);
        if($municipio ){
            Municipio::where('id',$municipio->id)->delete();
            return redirect('/master/municipio')->with('success', 'User deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Municipio not found.']);
        }
    }

}
