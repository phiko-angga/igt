<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table = 'municipio';
    protected $fillable = [
        'municipio',
    ];

    public function get_data($request){
        $data = Self::select('id','municipio');
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('municipio', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }
}
