<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    use HasFactory;
    protected $table = 'corporate';
    protected $fillable = [
        'municipio_id','posto_id','suco_id','aldeia_id','commactivity_auth_id','company',
        'number','address','noted'
    ];

    public function municipio(){
        return $this->belongsTo(Municipio::class,'municipio_id','id');
    }

    public function posto(){
        return $this->belongsTo(Posto::class,'posto_id','id');
    }

    public function suco(){
        return $this->belongsTo(Suco::class,'suco_id','id');
    }

    public function aldeia(){
        return $this->belongsTo(Aldeia::class,'aldeia_id','id');
    }

    public function commactivity_auth(){
        return $this->belongsTo(CommActivityAuth::class,'commactivity_auth_id','id');
    }

    public function get_data($request){
        $data = Self::with(['municipio','posto','suco','aldeia','commactivity_auth'])->select('corporate.*');
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('company', 'like', '%'.$search.'%')
            ->orWhere('number', 'like', '%'.$search.'%')
            ->orWhere('address', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }

    public function get_detail($id){
        $data = Self::with(['municipio','posto','suco','aldeia','commactivity_auth'])->select('corporate.*')
        ->where('id',$id)->first();
        
        return $data; 
    }
}
