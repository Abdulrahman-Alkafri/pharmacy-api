<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model  
{  
    use HasFactory;  

    protected $fillable = ["medicine_id", "user_id"]; // Add user_id here  

    public $timestamps = false; // Disable timestamps  

    public function medicine()  
    {  
        return $this->belongsTo(Medicine::class);  
    }  

    public function user()  
    {  
        return $this->belongsTo(User::class);  
    }  
}