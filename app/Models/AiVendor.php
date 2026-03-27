<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'key', 'api_key'])]
class AiVendor extends Model
{
    public function aiModels(): HasMany
    {
        return $this->hasMany(AiModel::class);
    }
}
