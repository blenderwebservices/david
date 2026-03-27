<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'ai_vendor_id', 'ai_model_id', 'api_key', 'base_url', 'is_default', 'web_search_enabled', 'system_prompt'])]
class AiProvider extends Model
{
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(AiVendor::class, 'ai_vendor_id');
    }

    public function aiModel(): BelongsTo
    {
        return $this->belongsTo(AiModel::class, 'ai_model_id');
    }
}
