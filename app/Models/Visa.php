<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Visa extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'color',
    ];


    public function pmiDepartures(): HasMany
    {
        return $this->hasMany(PmiDeparture::class);
    }
}
