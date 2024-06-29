<?php

namespace Modules\Complaint\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Block\Models\Block;
use Modules\Flat\Models\Flat;
use App\Enums\ComplaintStatus;

class Complaint extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'complaints';

    protected $casts = [
        'status' => ComplaintStatus::class,
    ];
    

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Complaint\database\factories\ComplaintFactory::new();
    }


    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }

    public function flat()
    {
        return $this->hasOne(Flat::class, 'id', 'block_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

