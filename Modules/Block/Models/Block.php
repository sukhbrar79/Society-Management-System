<?php

namespace Modules\Block\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Flat\Models\Flat;

class Block extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'blocks';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Block\database\factories\BlockFactory::new();
    }
    /**
     * Get the flat that belongs to the block.
     */
    public function flats()
    {
        return $this->HasMany(Flat::class);
    }
}
