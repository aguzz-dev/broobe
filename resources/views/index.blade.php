<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Broobe Challenge</title>
    <link rel="stylesheet" href="{{ asset('css/metrics/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/metrics/datatable.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    @include('partials.loader')

    <div class="container">
        <header>
            <h1>Broobe Challenge</h1>
        </header>

        <nav class="tabs">
            <button class="tab runMetric" onclick="showTab('runMetric')">Run Metric</button>
            <button class="tab metricHistory" onclick="showTab('metricHistory')">Metric History</button>
        </nav>

        <div id="runMetric" class="tab-content">
            @include('partials.metrics')
        </div>
        <div id="metricHistory" class="tab-content" style="display: none;">
            @include('partials.history-metrics')
        </div>
    </div>
    @include('partials.js.chartJs')
    @include('partials.js.getMetrics')
    @include('partials.js.saveMetrics')
    <script>
        function showTab(tabName) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.style.display = 'none';
            });

            const activeTab = document.getElementById(tabName);
            activeTab.style.display = 'block';

            const tabButtons = document.querySelectorAll('.tab');
            tabButtons.forEach(button => {
                button.style.color = 'black';
                button.style.fontWeight = 'normal';
            });

            const activeButton = document.querySelector(`.${tabName}`);
            if (activeButton) {
                activeButton.style.color = '#6F3DEA';
                activeButton.style.fontWeight = 'bold';
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            showTab('runMetric');
        });
    </script>
</body>
</html>
