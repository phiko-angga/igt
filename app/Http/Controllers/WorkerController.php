<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Redirect;
use Log;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $title = "Master Local / Foreign Worker";
        $breadcrumb = ['Master','Local / Foreign Worker'];

        $worker = new Worker();
        $worker = $worker->get_data($request);
        $search = $request->search;
         
        if($request->ajax()){
            return view('worker.list_pagination', compact('Worker','search'));
        }else
            return view('worker.list',compact('worker','title','breadcrumb'));
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
         $title = 'Add new Local / Foreign Worker';
         $breadcrumb = ['Master','Local / Foreign Worker','Add new'];
         return view('worker.form',compact('action','title','breadcrumb'));
     }

    public function store(Request $request)
    {
        request()->validate([
            'type'   => 'required',
            'dob'   => 'required',
            'name'   => 'required',
            'corporate_id'   => 'required|exists:corporate,id',
            'position_id'   => 'required|exists:position,id',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except(['id','_method','_token']);
            //GET & SET CODE
            $lastCode = Worker::orderBy("code","desc")->first();
            if($lastCode){
                $newCode = intval($lastCode->code)+1;
                $data["code"] = str_pad(strval($newCode),5,"0",STR_PAD_LEFT);
            }else{
                $data["code"] = str_pad("1",5,"0",STR_PAD_LEFT);
            }
            
            $worker = Worker::create($data);
            DB::commit();

            return redirect('/transaction/worker')->with('success', 'Local / Foreign Worker added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Local / Foreign Worker added failed, please try again.']);
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
         $worker = Worker::with(['corporate','position'])->where('id',$id)->first();
         if($worker){
            $action = 'update';
            $title = 'Update master local / foreign worker';
            $breadcrumb = ['Master','Local / Foreign Worker','update'];
            return view('worker.form',compact('worker','action','title','breadcrumb'));
         }else{
            return Redirect::back()->withErrors(['error'=> 'Local / Foreign Worker not found.']);
         }
     }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'type'   => 'required',
            'dob'   => 'required',
            'name'   => 'required',
            'corporate_id'   => 'required|exists:corporate,id',
            'position_id'   => 'required|exists:position,id',
        ]);
        $worker = Worker::find($id);
        if($worker){

            DB::beginTransaction();
            try {
                $data = $request->except(['_method','id','_token']);

                Worker::where('id',$worker->id)->update($data);
                DB::commit();

                return redirect('/transaction/worker')->with('success', 'Local / Foreign Worker updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Local / Foreign Worker updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Local / Foreign Worker not found.']);
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
        
        $worker = Worker::find($id);
        if($worker ){
            Worker::where('id',$worker->id)->delete();
            return redirect('/transaction/worker')->with('success', 'Local / Foreign Worker deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Local / Foreign Worker not found.']);
        }
    }

}
