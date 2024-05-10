<?php

namespace App\Http\Controllers;

use App\Models\Posto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Redirect;
use Log;

class PostoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $title = "Master Posto";
        $breadcrumb = ['Master','Posto'];

        $mPosto = new Posto();
        $posto = $mPosto->get_data($request);
        $search = $request->search;
         
        if($request->ajax()){
            return view('posto.list_pagination', compact('posto','search'));
        }else
            return view('posto.list',compact('posto','title','breadcrumb'));
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
         $title = 'Add new posto';
         $breadcrumb = ['Master','Posto','Add new'];
         return view('posto.form',compact('action','title','breadcrumb'));
     }

    public function store(Request $request)
    {
        request()->validate([
            'posto'   => 'required',
            'municipio_id'   => 'required|exists:municipio,id',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['posto','municipio_id']);
            
            $posto = Posto::create($data);
            DB::commit();

            return redirect('/master/posto')->with('success', 'Posto added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Posto added failed, please try again.']);
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
        $mPosto = new Posto();
         $posto = $mPosto->get_detail($id);
         if($posto){
            $action = 'update';
            $title = 'Update master posto';
            $breadcrumb = ['Master','Posto','update'];
            return view('posto.form',compact('posto','action','title','breadcrumb'));
         }else{
            return Redirect::back()->withErrors(['error'=> 'Posto not found.']);
         }
     }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'posto'   => 'required',
            'municipio_id'   => 'required|exists:municipio,id',
        ]);
        $posto = Posto::find($id);
        if($posto){

            DB::beginTransaction();
            try {
                $data = $request->only(['posto','municipio_id']);

                Posto::where('id',$posto->id)->update($data);
                DB::commit();

                return redirect('/master/posto')->with('success', 'Posto updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Posto updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Posto not found.']);
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
        
        $posto = Posto::find($id);
        if($posto ){
            Posto::where('id',$posto->id)->delete();
            return redirect('/master/posto')->with('success', 'User deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Posto not found.']);
        }
    }

}
