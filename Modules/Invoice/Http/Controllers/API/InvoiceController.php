<?php

namespace Modules\Invoice\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\Invoice\Models\Invoice;
use Modules\Invoice\Http\Resources\InvoiceResource;
use Modules\Invoice\Http\Resources\InvoiceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::query();
        $query->where('resident_id', Auth::id());
        // Apply filters if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        // You can add more filters based on your requirements

        $invoices = $query->paginate(10); // Adjust pagination as per your needs

        return response()->json(['status'=>1,'data'=>InvoiceResource::collection($invoices),'message'=>''], 200);
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

        $invoice = Invoice::create(array_merge(
            $request->all(),
            ['created_by' => Auth::id(),'user_id' => Auth::id(),'status'=>'pending']
        ));

        return response()->json(['status'=>1,'data' => new InvoiceResource($invoice),'message'=>''], 201);
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

        $invoice = Invoice::findOrFail($id);
        $invoice->update(array_merge(
            $request->all(),
            ['updated_by' => Auth::id(),'user_id' => Auth::id()]
        ));

        return response()->json(['status'=>1,'data' => new InvoiceResource($invoice),'message'=>''], 200);
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update(['deleted_by' => Auth::id()]);
        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted successfully','status'=>1], 200);
    }

}
