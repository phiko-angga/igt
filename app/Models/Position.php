<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'position';
    protected $fillable = [
        'name',
        'description',
    ];

    public function get_data($request){
        $data = Self::select('id','name','description');
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('name', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }
}
