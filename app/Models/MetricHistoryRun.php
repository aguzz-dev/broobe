<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\HttpFoundation\JsonResponse;

class MetricHistoryRun extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function strategy(): BelongsTo
    {
        return $this->belongsTo(Strategy::class);
    }

    public function datatable()
    {
        $data = self::get();
        return response()->json([
            'data' => $data
        ]);
    }


    public function store($request)
    {
        $strategy = Strategy::where('name', strtoupper($request->strategy))->first();

        if (!$strategy) {
            return response()->json(['error' => 'Strategy not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $metricHistoryRun = MetricHistoryRun::create([
            'url' => $request['url'],
            'accesibility_metric' => $request['metrics']['accessibility']['score'],
            'pwa_metric' => 0,
            'performance_metric' => $request['metrics']['performance']['score'],
            'seo_metric' => $request['metrics']['seo']['score'],
            'best_practices_metric' => $request['metrics']['best-practices']['score'],
            'strategy_id' => $strategy->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Metrics saved successfully', 'data' => $metricHistoryRun], JsonResponse::HTTP_OK);
    }

}
