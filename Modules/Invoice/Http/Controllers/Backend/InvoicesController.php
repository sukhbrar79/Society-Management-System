<?php

namespace Modules\Invoice\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class InvoicesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Invoices';

        // module name
        $this->module_name = 'invoices';

        // directory path of the module
        $this->module_path = 'invoice::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Invoice\Models\Invoice";
    }

    /**
     * Retrieves the data for the index page of the module.
     *
     * @return Illuminate\Http\JsonResponse
     */
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

        $$module_name = $module_model::select('id','name','invoice_number','resident_id','amount','invoice_date','due_date','status', 'updated_at');

        $data = $$module_name;
        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->addColumn('resident_id', function ($data) {
                return $data->user?->name ?? '-';;
            })
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    /**
     * Store a new resource in the database.
     *
     * @param  Request  $request  The request object containing the data to be stored.
     * @return RedirectResponse The response object that redirects to the index page of the module.
     *
     * @throws Exception If there is an error during the creation of the resource.
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $validated = $request->validate([
            'resident_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',           
        ]);

        $$module_name_singular = $module_model::factory()->create(array_merge($validated, ['status' => 'pending']));

        flash("New '".Str::singular($module_title)."' Added")->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect("admin/{$module_name}");
    }

}
