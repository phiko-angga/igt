<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Redirect;
use Log;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $title = "Master Position";
        $breadcrumb = ['Master','Position'];

        $mPosition = new Position();
        $position = $mPosition->get_data($request);
        $search = $request->search;
         
        if($request->ajax()){
            return view('position.list_pagination', compact('position','search'));
        }else
            return view('position.list',compact('position','title','breadcrumb'));
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
         $title = 'Add new position';
         $breadcrumb = ['Master','Position','Add new'];
         return view('position.form',compact('action','title','breadcrumb'));
     }

    public function store(Request $request)
    {
        request()->validate([
            'name'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['name']);
            if($request->has('description')) $data['description'] = $request->description;
            
            $position = Position::create($data);
            DB::commit();

            return redirect('/master/position')->with('success', 'Position added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Position added failed, please try again.']);
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
         $position = Position::find($id);
         if($position){
            $action = 'update';
            $title = 'Update master position';
            $breadcrumb = ['Master','Position','update'];
            return view('position.form',compact('position','action','title','breadcrumb'));
         }else{
            return Redirect::back()->withErrors(['error'=> 'Position not found.']);
         }
     }

    public function update(Request $request, $id)
    {
        
        request()->validate([
            'name'   => 'required',
        ]);
        $position = Position::find($id);
        if($position){

            DB::beginTransaction();
            try {
                $data = $request->only(['name']);
                if($request->has('description')) $data['description'] = $request->description;

                Position::where('id',$position->id)->update($data);
                DB::commit();

                return redirect('/master/position')->with('success', 'Position updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Position updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Position not found.']);
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
        
        $position = Position::find($id);
        if($position ){
            Position::where('id',$position->id)->delete();
            return redirect('/master/position')->with('success', 'User deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Position not found.']);
        }
    }

}
