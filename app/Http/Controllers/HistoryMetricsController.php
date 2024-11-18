<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetricRequest;
use App\Http\Requests\StoreMetricHistoryRequest;
use App\Models\MetricHistoryRun;

class HistoryMetricsController extends Controller
{
    public function storeMetrics(StoreMetricHistoryRequest $request)
    {
        return (new MetricHistoryRun)->store($request);
    }

    public function datatable()
    {
        return (new MetricHistoryRun)->datatable();
    }
}
