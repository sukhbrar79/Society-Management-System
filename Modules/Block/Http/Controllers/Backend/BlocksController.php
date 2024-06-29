<?php

namespace Modules\Block\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class BlocksController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Blocks';

        // module name
        $this->module_name = 'blocks';

        // directory path of the module
        $this->module_path = 'block::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Block\Models\Block";
    }

}
