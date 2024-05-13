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
        'posto_id','urut',
        'kode',
    ];

    public function posto(){
        return $this->belongsTo(Posto::class,'posto_id','id');
    }

    public function get_data($request){
        $data = Self::with('posto')->select('suco.*','posto.posto as posto_name')
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
        $data = Self::with('posto')->select('*')
        ->where('suco.id',$id)->first();
        
        return $data; 
    }
}
