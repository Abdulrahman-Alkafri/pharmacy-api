<?php  

namespace App\Http\Controllers;  

use App\Models\User;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Hash;  
use Illuminate\Validation\ValidationException;  

class AuthController extends Controller  
{  
    public function register(Request $request)  
    {  
        $request->validate([  
            'phone' => ['required', 'string', 'unique:users', 'max:15'],  
            'password' => ['required', 'string', 'min:8'],  
            'role' => ['required', 'string'],  
            'name' => ['required', 'string'],  
        ]);  

        $user = User::create([  
            'phone' => $request->phone,  
            'password' => Hash::make($request->password),  
            'role' => $request->role,  
            'name' => $request->name,  
        ]);  

        // Automatically log the user in  
        Auth::login($user);  

        // Create a token for the user  
        $token = $user->createToken('token-name')->plainTextToken;  

        return response()->json(['message' => 'User registered successfully', 'token' => $token], 201);  
    }  

    public function login(Request $request)  
    {  
        $request->validate([  
            'phone' => ['required', 'string'],  
            'password' => ['required', 'string'],  
        ]);  

        $user = User::where('phone', $request->phone)->first();  

        if (!$user || !Hash::check($request->password, $user->password)) {  
            throw ValidationException::withMessages([  
                'phone' => ['The provided credentials are incorrect.'],  
            ]);  
        }  

        $token = $user->createToken('token-name')->plainTextToken;  

        return response()->json(['token' => $token]);  
    }  

    public function logout(Request $request)  
    {  
        $request->user()->currentAccessToken()->delete();  

        return response()->json(['message' => 'Logged out successfully']);  
    }  
}