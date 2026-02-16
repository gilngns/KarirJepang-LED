<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DivisionReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'user_id',
        'job_description',
        'progress_percentage',
        'report_date',
    ];

    protected function casts(): array
    {
        return [
            'report_date' => 'date',
        ];
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
