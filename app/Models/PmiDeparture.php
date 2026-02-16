<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PmiDeparture extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'visa_id',
        'total',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }

    public function visa(): BelongsTo
    {
        return $this->belongsTo(Visa::class);
    }
}
