<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class DomainGroup extends Model
{
    use HasFactory;

    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class, 'group_id');
    }
}
