<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'user_level',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function level(){
        return $this->belongsTo(UserLevel::class,'user_level','id');
    }

    public function menu(){
        return $this->hasMany(UserLevel::class,'id','user_level')
        ->select('menu.link','menu.parent','menu.name')
        ->join('menu_level','menu_level.level_id','=','users_level.id')
        ->join('menu','menu.id','=','menu_level.menu_id')
        ->where('menu.active',1);
    }
    
    public function get_data($request){
        $data = Self::with('level')->select('users.name','users.username','users.id','email','user_level');
        
        $search = $request->get('search');
        if(isset($search)){
            $data = $data->where('name', 'like', '%'.$search.'%')
            ->orWhere('username', 'like', '%'.$search.'%');
        }
        $data = $data->paginate(10);
        
        return $data; 
    }
}
