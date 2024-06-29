<?php

namespace Modules\Parking\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Parking\Models\ParkingAllocation;
use Modules\Parking\Models\ParkingRequest;

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

    public function activeAllocation()
    {
        return $this->hasOne(ParkingAllocation::class,'parking_id', 'id');
    }

    public function ParkingRequest()
    {
        return $this->hasMany(ParkingRequest::class,'parking_id', 'id');
    }
}
