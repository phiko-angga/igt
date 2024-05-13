<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table = 'municipio';
    protected $fillable = [
        'municipio','urut','id',
        'kode',
    ];

    public function get_data($request){
        $data = Self::select('*');
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('municipio', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }
}
