<?php

namespace Modules\Parking\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\Parking\Models\Parking;
use Modules\Parking\Models\ParkingAllocation;
use Modules\Parking\Http\Resources\ParkingResource;
use Modules\Parking\Http\Resources\ParkingCollection;
use Modules\Parking\Http\Resources\ParkingAllocationResource;
use Modules\Parking\Http\Resources\ParkingAllocationCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    
    public function parkingSlots(Request $request)
    {
        $availableParkings = Parking::whereDoesntHave('activeAllocation')->get();

        return response()->json(['status'=>1,'data'=>ParkingResource::collection($availableParkings),'message'=>''], 200);
    }
    public function index(Request $request)
    {
        $query = ParkingAllocation::query();
        $query->where('resident_id', Auth::id());
        // Apply filters if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        // You can add more filters based on your requirements

        $parkings = $query->with('parking')->paginate(10); // Adjust pagination as per your needs

        return response()->json(['status'=>1,'data'=>ParkingAllocationResource::collection($parkings),'message'=>''], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'block_id' => 'nullable|exists:blocks,id',
            'flat_id' => 'nullable|exists:flats,id',
            'parking_id' => 'nullable|string|max:125',
            'allocation_date' => 'nullable|date',  
            'expiration_date' => 'nullable|date'  
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validator->after(function ($validator) use ($request) {
            $exists = DB::table('parking_allocations')
                        ->where('block_id', $request->block_id)
                        ->where('flat_id', $request->flat_id)
                        ->where('parking_id', $request->parking_id)
                        ->where('status', 'Pending')
                        ->exists();
    
            if ($exists) {
                $validator->errors()->add('combination', 'This parking allocation already exists for the given block, flat, parking ID, and status.');
            }
        });
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $parking = ParkingAllocation::create(array_merge(
            $request->all(),
            ['created_by' => Auth::id(),'resident_id' => Auth::id(),'status'=>'Pending']
        ));

        return response()->json(['status'=>1,'data'=>new ParkingAllocationResource($parking),'message'=>''], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'block_id' => 'nullable|exists:blocks,id',
            'flat_id' => 'nullable|exists:flats,id',
            'parking_id' => 'nullable|string|max:125',
            'allocation_date' => 'nullable|date',  
            'expiration_date' => 'nullable|date'  
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $parking = ParkingAllocation::findOrFail($id);
        $parking->update(array_merge(
            $request->all(),
            ['updated_by' => Auth::id()]
        ));

        return response()->json(['status'=>1,'data'=>new ParkingAllocationResource($parking),'message'=>''], 200);
    }

    public function destroy($id)
    {
        $parking = Parking::findOrFail($id);
        $parking->update(['deleted_by' => Auth::id()]);
        $parking->delete();

        return response()->json(['message' => 'Parking deleted successfully'], 200);
    }

}
