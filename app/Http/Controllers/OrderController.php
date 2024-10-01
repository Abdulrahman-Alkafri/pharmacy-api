<?php
namespace App\Http\Controllers;  

use App\Models\Order;  
use App\Models\Medicine;  
use Illuminate\Http\Request;  
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;  

class OrderController extends Controller  
{  
    public function store(Request $request): JsonResponse  
{  
    $validator = Validator::make($request->all(), [  
        'medicines' => 'required|array',  
        'medicines.*.id' => 'required|exists:medicines,id',  
        'medicines.*.quantity' => 'required|integer|min:1',  
    ]);  

    if ($validator->fails()) {  
        return response()->json($validator->errors(), 422);  
    }  

    // Create the order  
    $order = Order::create(['user_id' => Auth::id()]);  

    foreach ($request->medicines as $medicineData) {  
        $medicine = Medicine::find($medicineData['id']);  
        
        // Check if there is enough quantity available  
        if ($medicine->quantity_available < $medicineData['quantity']) {  
            return response()->json(['error' => 'Not enough quantity available for medicine: ' . $medicine->trade_name], 422);  
        }  

        // Attach the medicine to the order along with the quantity  
        $order->medicines()->attach($medicine->id, ['quantity' => $medicineData['quantity']]);  

        // Reduce the available quantity of the medicine  
        $medicine->quantity_available -= $medicineData['quantity'];  
        $medicine->save();  
    }  

    return response()->json($order->load('medicines'), 201);  
}

    public function index(): JsonResponse  
    {  
        $orders = Order::with('medicines')->where('user_id', Auth::id())->paginate(10);  
        return response()->json($orders);  
    }  
}