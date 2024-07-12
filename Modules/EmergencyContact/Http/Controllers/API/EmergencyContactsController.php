<?php

namespace Modules\EmergencyContact\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\EmergencyContact\Models\EmergencyContact;
use Modules\EmergencyContact\Http\Resources\EmergencyContactResource;
use Modules\EmergencyContact\Http\Resources\EmergencyContactCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EmergencyContactsController extends Controller
{
    public function index(Request $request)
    {
        $query = EmergencyContact::query();
        // Apply filters if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // You can add more filters based on your requirements

        $contacts = $query->paginate(100); // Adjust pagination as per your needs

        return response()->json(['status'=>1,'data'=>EmergencyContactResource::collection($contacts),'message'=>''], 200);
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

        $contact = EmergencyContact::create(array_merge(
            $request->all(),
            ['created_by' => Auth::id(),'user_id' => Auth::id(),'status'=>'pending']
        ));

        return response()->json(['status'=>1,'data' => new EmergencyContactResource($contact),'message'=>''], 201);
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

        $contact = EmergencyContact::findOrFail($id);
        $contact->update(array_merge(
            $request->all(),
            ['updated_by' => Auth::id(),'user_id' => Auth::id()]
        ));

        return response()->json(['status'=>1,'data' => new EmergencyContactResource($contact),'message'=>''], 200);
    }

    public function destroy($id)
    {
        $contact = EmergencyContact::findOrFail($id);
        $contact->update(['deleted_by' => Auth::id()]);
        $contact->delete();

        return response()->json(['message' => 'EmergencyContact deleted successfully','status'=>1], 200);
    }

}
