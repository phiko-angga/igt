<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommActivityAuth extends Model
{
    use HasFactory;
    protected $table = 'commactivity_auth';
    protected $fillable = [
        'id_number','description','description2'
    ];

    public function get_data($request){
        $data = Self::select('*');
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('id_number', 'like', '%'.$search.'%')
            ->orWhere('description','like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }
}
