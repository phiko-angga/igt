<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $table = 'worker';
    protected $fillable = [
        'name','type','code','country','gender','dob','c_university','c_institute','c_diploma','c_academy','c_senior_hs','c_junior_hs',
        'c_photo_3x4','phone','corporate_id','position_id','pob','work_startdate','work_period','c_good_behavior_letter','c_health_certificate',
        'c_diploma2','c_birth_certificate','c_identity_card'
    ];

    public function corporate(){
        return $this->belongsTo(Corporate::class,'corporate_id','id');
    }

    public function position(){
        return $this->belongsTo(Position::class,'position_id','id');
    }

    public function get_data($request){
        $data = Self::with(['corporate','position'])->select('*');
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
