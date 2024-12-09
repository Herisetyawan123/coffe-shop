<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function contactPhone(): HasMany
    {
        return $this->hasMany(ContactPhone::class);
    }
}
