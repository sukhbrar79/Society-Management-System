<?php

namespace Modules\NoticeBoard\Http\Controllers\API;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Modules\NoticeBoard\Models\NoticeBoard;
use Modules\NoticeBoard\Http\Resources\NoticeBoardResource;
use Modules\NoticeBoard\Http\Resources\NoticeBoardCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NoticeBoardCreated;

class NoticeBoardsController extends Controller
{
    public function index(Request $request)
    {
        $query = NoticeBoard::query();
        // Apply filters if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        $NoticeBoards = $query->paginate(10); 

        return response()->json(['status'=>1,'data'=>NoticeBoardResource::collection($NoticeBoards),'message'=>''], 200);
    }
}
