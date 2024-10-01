<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = [  
        'scientific_name',  
        'trade_name',  
        'classification',  
        'manufacturer',  
        'quantity_available',  
        'expiration_date',  
        'price',  
    ];
    public function orders()  
    {  
        return $this->belongsToMany(Order::class)->withPivot('quantity')->withTimestamps();  
    }    
    public function favorites(){
        return $this->hasMany(Favorites::class);
    }
}