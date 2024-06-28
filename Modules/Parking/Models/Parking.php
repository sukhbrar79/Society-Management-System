<?php

namespace Modules\Parking\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'parkings';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Parking\database\factories\ParkingFactory::new();
    }
}
