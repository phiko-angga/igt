<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aldeia extends Model
{
    use HasFactory;
    protected $table = 'aldeia';
    protected $fillable = [
        'aldeia',
        'suco_id',
        'urut',
        'kode',
    ];

    public function suco(){
        return $this->belongsTo(Suco::class,'suco_id','id');
    }
    
    public function get_data($request){
        $data = Self::with('suco')->select('aldeia.*','suco.suco as suco_name')
        ->join('suco','suco.id','=','aldeia.suco_id');
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('aldeia', 'like', '%'.$search.'%')
            ->orWhere('suco', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }

    public function get_detail($id){
        $data = Self::with('suco')->select('aldeia.*')
        ->where('aldeia.id',$id)->first();
        
        return $data; 
    }
}
