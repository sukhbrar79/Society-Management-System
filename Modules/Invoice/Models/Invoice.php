<?php

namespace Modules\Invoice\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'invoices';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Invoice\database\factories\InvoiceFactory::new();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'resident_id');
    }
}
