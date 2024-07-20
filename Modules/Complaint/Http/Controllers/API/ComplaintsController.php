<?php

namespace Modules\Complaint\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\Complaint\Models\Complaint;
use Modules\Complaint\Http\Resources\ComplaintResource;
use Modules\Complaint\Http\Resources\ComplaintCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ComplaintCreated;

class ComplaintsController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::query();
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

        return response()->json(['status'=>1,'data'=>ComplaintResource::collection($complaints),'message'=>''], 200);
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

        $complaint = Complaint::create(array_merge(
            $request->all(),
            ['created_by' => Auth::id(),'user_id' => Auth::id(),'status'=>'pending']
        ));

        // Notify all managers
        $managers = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'manager');
        })->get(); // Assuming you have a role field for managers

        foreach ($managers as $manager) {
            $manager->notify(new ComplaintCreated($complaint));
        }

        return response()->json(['status'=>1,'data' => new ComplaintResource($complaint),'message'=>''], 201);
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

        $complaint = Complaint::findOrFail($id);
        $complaint->update(array_merge(
            $request->all(),
            ['updated_by' => Auth::id(),'user_id' => Auth::id()]
        ));

        return response()->json(['status'=>1,'data' => new ComplaintResource($complaint),'message'=>''], 200);
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->update(['deleted_by' => Auth::id()]);
        $complaint->delete();

        return response()->json(['message' => 'Complaint deleted successfully','status'=>1], 200);
    }

}
