<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class PmiDeparture extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'date',
        'visa_id',
        'total',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function visa(): BelongsTo
    {
        return $this->belongsTo(Visa::class);
    }
}
