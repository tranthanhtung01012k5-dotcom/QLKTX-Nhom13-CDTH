<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phong extends Model
{
    protected $table = 'phong';

    public function tang(): BelongsTo
    {
        return $this->belongsTo(Tang::class, 'tang_id', 'id');
    }
}
