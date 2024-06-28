<?php

namespace Modules\Visitor\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class VisitorsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Visitors';

        // module name
        $this->module_name = 'visitors';

        // directory path of the module
        $this->module_path = 'visitor::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Visitor\Models\Visitor";
    }

}
