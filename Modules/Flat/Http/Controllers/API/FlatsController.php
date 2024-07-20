<?php

namespace Modules\Flat\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\Flat\Models\Flat;
use Modules\Flat\Http\Resources\FlatResource;
use Modules\Flat\Http\Resources\FlatCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FlatsController extends Controller
{
    public function index(Request $request)
    {
        $query = Flat::query();

        // Apply filters if provided in the request
        if ($request->has('id')) {
            $query->where('block_id', $request->id);
        }

        // You can add more filters based on your requirements

        $flats = $query->paginate(10); // Adjust pagination as per your needs

        return response()->json(['status' => 1, 'data' => FlatResource::collection($flats), 'message' => ''], 200);
    }
    public function getFlatsByBlock(Request $request)
    {
        $blockId = $request->input('block_id');
        $flats = \Modules\Flat\Models\Flat::where('block_id', $blockId)->pluck('name', 'id');
        return response()->json(['flats' => $flats]);
    }
}
