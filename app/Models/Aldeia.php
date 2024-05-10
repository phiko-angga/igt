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
    ];

    public function get_data($request){
        $data = Self::select('aldeia.*','suco.suco')
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
        $data = Self::select('aldeia.*','suco.suco')
        ->join('suco','suco.id','=','aldeia.suco_id')
        ->where('aldeia.id',$id)->first();
        
        return $data; 
    }
}
