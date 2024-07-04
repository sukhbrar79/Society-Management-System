<?php

namespace Modules\Parking\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Parking\Models\Parking;
use Modules\Block\Models\Block;
use Modules\Flat\Models\Flat;

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
    public function parking()
    {
        return $this->hasOne(Parking::class, 'id', 'parking_id');
    }
    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
    public function flat()
    {
        return $this->hasOne(Flat::class, 'id', 'flat_id');
    }
}
