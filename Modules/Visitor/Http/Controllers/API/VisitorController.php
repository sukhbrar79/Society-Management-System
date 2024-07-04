<?php

namespace Modules\Visitor\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\Visitor\Models\Visitor;
use Modules\Visitor\Http\Resources\VisitorResource;
use Modules\Visitor\Http\Resources\VisitorCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $query = Visitor::query();
        $query->where('resident_id', Auth::id());

        // Apply filters if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        // You can add more filters based on your requirements

        $visitors = $query->paginate(10); // Adjust pagination as per your needs

        return response()->json(['status'=>1,'data'=>new VisitorCollection($visitors),'message'=>''], 200);
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

        $visitor = Visitor::create(array_merge($request->all(), ['created_by' => Auth::id(), 'user_id' => Auth::id(),'status'=>'pending']));

        return response()->json(['status'=>1,'data'=>new VisitorResource($visitor),'message'=>''], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'block_id' => 'nullable|exists:blocks,id',
            'flat_id' => 'nullable|exists:flats,id',
            'subject' => 'nullable|string|max:125',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'priority' => 'required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $visitor = Visitor::findOrFail($id);
        $visitor->update(array_merge($request->all(), ['updated_by' => Auth::id(), 'user_id' => Auth::id()]));

        return response()->json(['status'=>1,'data'=>new VisitorResource($visitor),'message'=>''], 200);
    }

    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->update(['deleted_by' => Auth::id()]);
        $visitor->delete();

        return response()->json(['status'=>1,'message' => 'Visitor deleted successfully'], 200);
    }
}
