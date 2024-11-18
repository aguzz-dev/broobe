<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metric_history_runs', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->float('accesibility_metric');
            $table->float('pwa_metric');
            $table->float('performance_metric');
            $table->float('seo_metric');
            $table->float('best_practices_metric');
            $table->foreignId('strategy_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metric_history_runs');
    }
};
