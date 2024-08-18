<?php

namespace Modules\Guideline\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guideline extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'guidelines';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Guideline\database\factories\GuidelineFactory::new();
    }
}
