<?php

namespace Modules\Guideline\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class GuidelinesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Guidelines';

        // module name
        $this->module_name = 'guidelines';

        // directory path of the module
        $this->module_path = 'guideline::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Guideline\Models\Guideline";
    }

}
