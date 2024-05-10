<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    use HasFactory;
    protected $table = 'users_level';
    protected $fillable = [
        'level',
    ];
    
    public function get_data($request){
        $data = Self::select('id','level');
        
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('level', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }
}
