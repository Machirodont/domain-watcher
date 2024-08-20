<?php

namespace App\Models;

use App\Services\CheckDomains\DomainCheckStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $domain_id
 * @property int $status
 * @property ?int $code
 * @property int $content_size
 * @property string $error
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 *
 * @property Domain $domain
 */
class DomainCheckLog extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => DomainCheckStatus::class,
        ];
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }
}
