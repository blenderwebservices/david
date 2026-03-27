<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['ai_vendor_id', 'name', 'key', 'model_key'])]
class AiModel extends Model
{
    public function aiVendor(): BelongsTo
    {
        return $this->belongsTo(AiVendor::class);
    }
}
