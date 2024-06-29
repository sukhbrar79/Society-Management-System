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
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // You can add more filters based on your requirements

        $flats = $query->paginate(10); // Adjust pagination as per your needs

        return response()->json(new FlatCollection($flats), 200);
    }
}
