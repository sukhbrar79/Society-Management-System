<?php

namespace Modules\EmergencyContact\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmergencyContact extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'emergencycontacts';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\EmergencyContact\database\factories\EmergencyContactFactory::new();
    }
}
