<?php
namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class Order extends Model  
{  
    use HasFactory;  

    protected $fillable = ['user_id'];  

    public function medicines()  
    {  
        return $this->belongsToMany(Medicine::class)->withPivot('quantity')->withTimestamps();  
    }  
}