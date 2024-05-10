<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = [
        'link',
        'parent',
        'name',
        'active',
        'order',
    ];
    
    function get_menu_level_permission($level = ''){
        $data = Self::select('menu.*','parent.name as parent')
        ->selectRaw("coalesce(ml.id,0) as curmenu")
        ->selectRaw("case when ml.id is not null then 'true' else 'false' end as checked")
        ->selectRaw("case when ml.id is not null then 1 else 0 end as checked2")
        ->join('menu as parent','parent.id','=','menu.parent')
        ->leftJoin('menu_level as ml', function($join) use($level)
        {
            $join->on('menu.id', '=', 'ml.menu_id');
            $join->where('ml.level_id',$level);
        })
        ->where('menu.parent','<>',0)
        ->orderBy('order')->get();
        return $data;
    }
}
