<?php

namespace Modules\Guideline\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\Guideline\Models\Guideline;
use Modules\Guideline\Http\Resources\GuidelineResource;
use Modules\Guideline\Http\Resources\GuidelineCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class GuidelinesController extends Controller
{
    public function index(Request $request)
    {
        $query = Guideline::query();
        
        // Apply filters if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // You can add more filters based on your requirements

        $guidelines = $query->paginate(10); // Adjust pagination as per your needs

        return response()->json(['status'=>1,'data'=>GuidelineResource::collection($guidelines),'message'=>''], 200);
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

        $invoice = Guideline::create(array_merge(
            $request->all(),
            ['created_by' => Auth::id(),'user_id' => Auth::id(),'status'=>'pending']
        ));

        return response()->json(['status'=>1,'data' => new GuidelineResource($invoice),'message'=>''], 201);
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

        $invoice = Guideline::findOrFail($id);
        $invoice->update(array_merge(
            $request->all(),
            ['updated_by' => Auth::id(),'user_id' => Auth::id()]
        ));

        return response()->json(['status'=>1,'data' => new GuidelineResource($invoice),'message'=>''], 200);
    }

    public function destroy($id)
    {
        $invoice = Guideline::findOrFail($id);
        $invoice->update(['deleted_by' => Auth::id()]);
        $invoice->delete();

        return response()->json(['message' => 'Guideline deleted successfully','status'=>1], 200);
    }

}
