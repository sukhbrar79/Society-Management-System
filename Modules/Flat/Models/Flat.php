<?php

namespace Modules\Flat\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Block\Models\Block;

class Flat extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'flats';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Flat\database\factories\FlatFactory::new();
    }

    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
}
