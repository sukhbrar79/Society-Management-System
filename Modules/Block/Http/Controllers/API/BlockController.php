<?php

namespace Modules\Block\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\Block\Models\Block;
use Modules\Block\Http\Resources\BlockResource;
use Modules\Block\Http\Resources\BlockCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function index(Request $request)
    {
        $query = Block::query();

        // Apply filters if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // You can add more filters based on your requirements

        $blocks = $query->paginate(10); // Adjust pagination as per your needs

        return response()->json(['status'=>1,'data'=>BlockResource::collection($blocks),'message'=>''], 200);
    }
}
