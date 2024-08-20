<?php

namespace App\Models;

use App\Services\CheckDomains\DomainStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $url
 * @property int $group_id
 * @property int $check_rate
 * @property DomainStatus $status
 * @property ?Carbon $last_check_at
 * @property ?Carbon $offline_since
 * @property Carbon $created_at
 * @property ?Carbon $updated_at
 *
 * @property DomainGroup $group
 * @property DomainCheckLog[] $logs
 */
class Domain extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => DomainStatus::class,
            'last_check_at' => 'datetime',
            'offline_since' => 'datetime',
        ];
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(DomainGroup::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(DomainCheckLog::class);
    }
}
