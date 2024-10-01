<?php  

namespace App\Http\Controllers;  

use App\Models\Medicine;  
use Illuminate\Http\Request;  
use Illuminate\Http\JsonResponse;  
use Illuminate\Support\Facades\Validator;  

class MedicineController extends Controller  
{  
    /**  
     * Display a listing of the medicines.  
     * @return JsonResponse  
     */  
    public function index(Request $request): JsonResponse  
    {  
        // Get the classification query parameter  
        $classification = $request->query('classification');  
    
        // Build the query  
        $query = Medicine::query();  
    
        // If classification is provided, filter the results where classification starts with the given string  
        if ($classification) {  
            $query->where('classification', 'like', $classification . '%');  
        }  
        
        // Paginate the results, keeping query parameters for pagination links  
        $medicines = $query->paginate(10)->appends($request->query());  
    
        return response()->json($medicines);  
    }  

    /**  
     * Store a newly created medicine in storage.  
     * @param Request $request  
     * @return JsonResponse  
     */  
    public function store(Request $request): JsonResponse  
    {  
        $validator = Validator::make($request->all(), [  
            'scientific_name' => 'required|string|max:255',  
            'trade_name' => 'required|string|max:255',  
            'classification' => 'required|string|max:255',  
            'manufacturer' => 'required|string|max:255',  
            'quantity_available' => 'required|integer',  
            'expiration_date' => 'required|date',  
            'price' => 'required|numeric',  
        ]);  

        if ($validator->fails()) {  
            return response()->json($validator->errors(), 422);  
        }  

        $medicine = Medicine::create($request->all());  
        return response()->json($medicine, 201);  
    }  

    /**  
     * Display the specified medicine.  
     * @param Medicine $medicine  
     * @return JsonResponse  
     */  
    public function show(Medicine $medicine): JsonResponse  
    {  
        return response()->json($medicine);  
    }  

    /**  
     * Update the specified medicine in storage.  
     * @param Request $request  
     * @param Medicine $medicine  
     * @return JsonResponse  
     */  
    public function update(Request $request, Medicine $medicine): JsonResponse  
    {  
        $validator = Validator::make($request->all(), [  
            'scientific_name' => 'sometimes|required|string|max:255',  
            'trade_name' => 'sometimes|required|string|max:255',  
            'classification' => 'sometimes|required|string|max:255',  
            'manufacturer' => 'sometimes|required|string|max:255',  
            'quantity_available' => 'sometimes|required|integer',  
            'expiration_date' => 'sometimes|required|date',  
            'price' => 'sometimes|required|numeric',  
        ]);  

        if ($validator->fails()) {  
            return response()->json($validator->errors(), 422);  
        }  

        $medicine->update($request->all());  
        return response()->json($medicine);  
    }  

    /**  
     * Remove the specified medicine from storage.  
     * @param Medicine $medicine  
     * @return JsonResponse  
     */  
    public function destroy(Medicine $medicine): JsonResponse  
    {  
        $medicine->delete();  
        return response()->json(null, 204);  
    }  
}