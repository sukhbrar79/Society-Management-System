<?php

namespace Modules\Parking\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\Parking\Models\Parking;
use Modules\Parking\Http\Resources\ParkingResource;
use Modules\Parking\Http\Resources\ParkingCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    public function index(Request $request)
    {
        $query = Parking::query();
        $query->where('user_id', Auth::id());
        // Apply filters if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        // You can add more filters based on your requirements

        $complaints = $query->paginate(10); // Adjust pagination as per your needs

        return response()->json(ParkingResource::collection($complaints), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'block_id' => 'nullable|exists:blocks,id',
            'flat_id' => 'nullable|exists:flats,id',
            'subject' => 'nullable|string|max:125',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $complaint = Parking::create(array_merge(
            $request->all(),
            ['created_by' => Auth::id(),'user_id' => Auth::id(),'status'=>'pending']
        ));

        return response()->json(['data' => new ParkingResource($complaint)], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'block_id' => 'nullable|exists:blocks,id',
            'flat_id' => 'nullable|exists:flats,id',
            'subject' => 'nullable|string|max:125',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $complaint = Parking::findOrFail($id);
        $complaint->update(array_merge(
            $request->all(),
            ['updated_by' => Auth::id(),'user_id' => Auth::id()]
        ));

        return response()->json(['data' => new ParkingResource($complaint)], 200);
    }

    public function destroy($id)
    {
        $complaint = Parking::findOrFail($id);
        $complaint->update(['deleted_by' => Auth::id()]);
        $complaint->delete();

        return response()->json(['message' => 'Parking deleted successfully'], 200);
    }

}
