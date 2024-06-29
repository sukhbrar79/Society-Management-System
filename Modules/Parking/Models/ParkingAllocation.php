<?php

namespace Modules\Parking\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingAllocation extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'parking_allocations';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Parking\database\factories\ParkingAllocationFactory::new();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'resident_id');
    }
}
