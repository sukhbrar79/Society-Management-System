<?php

namespace Modules\Visitor\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'visitors';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Visitor\database\factories\VisitorFactory::new();
    }
}
