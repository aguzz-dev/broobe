<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Strategy extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    const DESKTOP = 1;
    const MOBILE = 2;

    public function metricHistoryRuns(): HasMany
    {
        return $this->hasMany(MetricHistoryRun::class);
    }
}
