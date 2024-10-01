<?php
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  

return new class extends Migration  
{  
    public function up(): void  
    {  
        Schema::create('orders', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming you have a users table  
            $table->timestamps();  
        });  
    }  

    public function down(): void  
    {  
        Schema::dropIfExists('orders');  
    }  
};