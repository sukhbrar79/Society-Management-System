<?php

namespace Modules\Parking\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class ParkingsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Parkings';

        // module name
        $this->module_name = 'parkings';

        // directory path of the module
        $this->module_path = 'parking::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Parking\Models\Parking";
    }

}
