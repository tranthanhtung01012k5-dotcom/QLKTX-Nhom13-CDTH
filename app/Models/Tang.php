<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tang extends Model
{
    protected $table = 'tang';

    public function toaNha(): BelongsTo
    {
        return $this->belongsTo(ToaNha::class, 'toa_nha_id', 'id');
    }
}
