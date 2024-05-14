<?php

namespace App\Http\Controllers;

use App\Models\Suco;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Redirect;
use Log;

class SucoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $title = "Master Suco";
        $breadcrumb = ['Master','Suco'];

        $mSuco = new Suco();
        $suco = $mSuco->get_data($request);
        $search = $request->search;
         
        if($request->ajax()){
            return view('suco.list_pagination', compact('suco','search'));
        }else
            return view('suco.list',compact('suco','title','breadcrumb'));
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
         $title = 'Add new suco';
         $breadcrumb = ['Master','Suco','Add new'];
         return view('suco.form',compact('action','title','breadcrumb'));
     }

    public function store(Request $request)
    {
        $posto_id = $request->posto_id;
        request()->validate([
            'suco'   => 'required',
            'posto_id'   => 'required|exists:posto,id',
            'kode'   => [
                            'required','numeric','regex:/^\d[0-9]{1}$/',
                            Rule::unique('suco')->where(function ($query) use($posto_id){
                                return $query->where('posto_id', $posto_id);
                            })
                        ],
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['suco','posto_id','kode','urut']);
            
            $suco = Suco::create($data);
            DB::commit();

            return redirect('/master/suco')->with('success', 'Suco added successfully');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Suco added failed, please try again.']);
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
        
         $mSuco = new Suco();
          $suco = $mSuco->get_detail($id);
         if($suco){
            $action = 'update';
            $title = 'Update master suco';
            $breadcrumb = ['Master','Suco','update'];
            return view('suco.form',compact('suco','action','title','breadcrumb'));
         }else{
            return Redirect::back()->withErrors(['error'=> 'Suco not found.']);
         }
     }

    public function update(Request $request, $id)
    {
        
        $posto_id = $request->posto_id;
        request()->validate([
            'suco'   => 'required',
            'posto_id'   => 'required|exists:posto,id',
            'kode'   => 'required|numeric|regex:/^\d[0-9]{1}$/',
            'kode'   => [
                            'required','numeric','regex:/^\d[0-9]{1}$/',
                            Rule::unique('suco')->ignore($id)->where(function ($query) use($posto_id){
                                return $query->where('posto_id', $posto_id);
                            })
                        ],
        ]);
        $suco = Suco::find($id);
        if($suco){

            DB::beginTransaction();
            try {
                $data = $request->only(['suco','posto_id','kode','urut']);

                Suco::where('id',$suco->id)->update($data);
                DB::commit();

                return redirect('/master/suco')->with('success', 'Suco updated successfully');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Suco updated failed, please try again.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Suco not found.']);
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
        
        $suco = Suco::find($id);
        if($suco ){
            Suco::where('id',$suco->id)->delete();
            return redirect('/master/suco')->with('success', 'Suco deleted successfully');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Suco not found.']);
        }
    }

}
