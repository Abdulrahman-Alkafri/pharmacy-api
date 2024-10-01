<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoritesController extends Controller
{
    public function index(){
        $favorites = Favorites::with("medicine")->paginate(10);
        return response()->json($favorites);
    }
    public function show(Favorites $favorite){
        return response()->json($favorite);
    }
    public function store(Request $request)  
    {  
        $validator = Validator::make($request->all(), [  
            "medicine_id" => "required|integer|exists:medicines,id", // Ensure the medicine exists  
            "user_id" => "required|integer|exists:users,id" // Ensure the user exists  
        ]);  
    
        if ($validator->fails()) {  
            return response()->json($validator->errors(), 422);  
        }  
        $favorite = Favorites::create([  
            'medicine_id' => $request->medicine_id,  
            'user_id' => $request->user_id,  
        ]);  
    
        return response()->json($favorite, 201);  
    }
    public function destroy(Favorites $favorite){
        $favorite->delete();
        return response()->json(null, 204);
    }
}