<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Option;

class Poll extends Model
{
    use HasFactory;

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);

    }

}
