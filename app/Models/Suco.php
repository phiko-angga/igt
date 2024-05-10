<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suco extends Model
{
    use HasFactory;
    protected $table = 'suco';
    protected $fillable = [
        'suco',
        'posto_id',
    ];

    public function get_data($request){
        $data = Self::select('suco.*','posto.posto')
        ->join('posto','posto.id','=','suco.posto_id');
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('suco', 'like', '%'.$search.'%')
            ->orWhere('posto', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }

    public function get_detail($id){
        $data = Self::select('suco.*','posto.posto')
        ->join('posto','posto.id','=','suco.posto_id')
        ->where('suco.id',$id)->first();
        
        return $data; 
    }
}
