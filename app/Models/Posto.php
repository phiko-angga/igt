<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posto extends Model
{
    use HasFactory;
    protected $table = 'posto';
    protected $fillable = [
        'posto',
        'municipio_id','urut',
        'kode',
    ];

    public function municipio(){
        return $this->belongsTo(Municipio::class,'municipio_id','id');
    }

    public function get_data($request){
        $data = Self::with('municipio')->select('posto.*','municipio.municipio as municipio_name')
        ->join('municipio','municipio.id','=','posto.municipio_id');
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('posto', 'like', '%'.$search.'%')
            ->orWhere('municipio', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }

    public function get_detail($id){
        $data = Self::select('posto.*','municipio.municipio','municipio.kode as municipio_kode')
        ->join('municipio','municipio.id','=','posto.municipio_id');
        $data = $data->where('posto.id',$id)->first();
        
        return $data; 
    }
}
