<?php  

namespace App\Models;  

use Illuminate\Contracts\Auth\MustVerifyEmail;  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Foundation\Auth\User as Authenticatable;  
use Illuminate\Notifications\Notifiable;  
use Laravel\Sanctum\HasApiTokens;  

class User extends Authenticatable  
{  
    use HasFactory, Notifiable, HasApiTokens;  

    protected $fillable = [  
        'phone', 'password', 'role', 'name' 
    ];  

    protected $hidden = [  
        'password', 'remember_token',  
    ];  
    public function favorite(){
        return $this->hasMany(Favorites::class);
    }
}