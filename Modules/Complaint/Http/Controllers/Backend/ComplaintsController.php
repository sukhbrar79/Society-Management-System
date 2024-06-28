<?php

namespace Modules\Complaint\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class ComplaintsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Complaints';

        // module name
        $this->module_name = 'complaints';

        // directory path of the module
        $this->module_path = 'complaint::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Complaint\Models\Complaint";
    }

}
