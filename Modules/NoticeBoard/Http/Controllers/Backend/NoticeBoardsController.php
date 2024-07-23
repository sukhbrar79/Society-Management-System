<?php

namespace Modules\NoticeBoard\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class NoticeBoardsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'NoticeBoards';

        // module name
        $this->module_name = 'noticeboards';

        // directory path of the module
        $this->module_path = 'noticeboard::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\NoticeBoard\Models\NoticeBoard";
    }
    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading . ' ' . label_case($module_action);

        // Fetch the user
        $user = auth()->user();

        // Determine if the user has the 'service staff' role
        $isServiceStaff = $user->hasRole('service-staff'); // Adjust the role check as necessary

        // Create the base query
        $query = $module_model::select('id', 'name', 'description', 'status', 'expiry_date', 'updated_at');

        // Apply filtering if user is a service staff
        if ($isServiceStaff) {
            $query->where('assigned_to', $user->id);
        }

        $$module_name = $query->get(); // Retrieve the data

        $data = $$module_name;

        return Datatables::of($query)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->editColumn('status', function ($data) {
                

                return $data->status?'Publish':'Un-Publish';
            })
            ->rawColumns(['name', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }
}
