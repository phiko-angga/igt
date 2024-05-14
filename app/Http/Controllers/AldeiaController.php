<?php

namespace App\Http\Controllers;

use App\Models\Aldeia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Redirect;
use Log;

class AldeiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $title = "Master Aldeia";
        $breadcrumb = ['Master','Aldeia'];

        $mAldeia = new Aldeia();
        $aldeia = $mAldeia->get_data($request);
        $search = $request->search;
         
        if($request->ajax()){
            return view('aldeia.list_pagination', compact('aldeia','search'));
        }else
            return view('aldeia.list',compact('aldeia','title','breadcrumb'));
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
         $title = 'Add new aldeia';
         $breadcrumb = ['Master','Aldeia','Add new'];
         return view('aldeia.form',compact('action','title','breadcrumb'));
     }

    public function store(Request $request)
    {
        request()->validate([
            'aldeia'   => 'required',
            'suco_id'   => 'required|exists:suco,id',
            'kode'   => 'required|numeric|regex:/^\d[0-9]{1}$/',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['aldeia','suco_id','kode','urut']);
            
            $aldeia = Aldeia::create($data);
            DB::commit();

            return redirect('/master/aldeia')->with('success', 'Aldeia added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Aldeia added failed, please try again.']);
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
         $aldeia = Aldeia::find($id);
         $mAldeia = new Aldeia();
          $aldeia = $mAldeia->get_detail($id);
         if($aldeia){
            $action = 'update';
            $title = 'Update master aldeia';
            $breadcrumb = ['Master','Aldeia','update'];
            return view('aldeia.form',compact('aldeia','action','title','breadcrumb'));
         }else{
            return Redirect::back()->withErrors(['error'=> 'Aldeia not found.']);
         }
     }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'aldeia'   => 'required',
            'suco_id'   => 'required|exists:suco,id',
            'kode'   => 'required|numeric|regex:/^\d[0-9]{1}$/',
        ]);
        $aldeia = Aldeia::find($id);
        if($aldeia){

            DB::beginTransaction();
            try {
                $data = $request->only(['aldeia','suco_id','kode','urut']);

                Aldeia::where('id',$aldeia->id)->update($data);
                DB::commit();

                return redirect('/master/aldeia')->with('success', 'Aldeia updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Aldeia updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Aldeia not found.']);
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
        
        $aldeia = Aldeia::find($id);
        if($aldeia ){
            Aldeia::where('id',$aldeia->id)->delete();
            return redirect('/master/aldeia')->with('success', 'Aldeia deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Aldeia not found.']);
        }
    }

}
