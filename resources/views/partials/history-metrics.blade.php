<body class="bg-gray-50">
    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Métricas de Rendimiento</h2>
        </div>

        <table id="tableMetrics">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>URL</th>
                    <th>Accesibilidad</th>
                    <th>PWA</th>
                    <th>Rendimiento</th>
                    <th>SEO</th>
                    <th>Mejores Prácticas</th>
                    <th>Estrategia</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script>
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    function getMetricClass(value) {
        if (value >= 0.90) return 'metric-good';
        if (value >= 0.50) return 'metric-warning';
        return 'metric-poor';
    }

    jQuery(document).ready(function () {
        jQuery('#tableMetrics').DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            processing: true,
            searching: false,
            serverSide: false,
            ajax: {
                url: "{{ route('metrics.datatable') }}",
                type: "GET",
                dataType: "json"
            },
            columns: [
                { data: 'id' },
                { data: 'url' },
                {
                    data: 'accesibility_metric',
                    render: function(data) {
                        return `<span class="metric-badge ${getMetricClass(data)}">${data}</span>`;
                    }
                },
                {
                    data: 'pwa_metric',
                    render: function(data) {
                        return `<span class="metric-badge ${getMetricClass(data)}">${data}</span>`;
                    }
                },
                {
                    data: 'performance_metric',
                    render: function(data) {
                        return `<span class="metric-badge ${getMetricClass(data)}">${data}</span>`;
                    }
                },
                {
                    data: 'seo_metric',
                    render: function(data) {
                        return `<span class="metric-badge ${getMetricClass(data)}">${data}</span>`;
                    }
                },
                {
                    data: 'best_practices_metric',
                    render: function(data) {
                        return `<span class="metric-badge ${getMetricClass(data)}">${data}</span>`;
                    }
                },
                {
                    data: 'strategy_id',
                    render: function(data) {
                        return data === 1 ? 'Mobile' : data === 2 ? 'Desktop' : 'Unknown';
                    }
                },
                {
                    data: 'created_at',
                    render: function(data) {
                        return new Date(data).toLocaleDateString();
                    }
                },
                {
                    data: 'updated_at',
                    render: function(data) {
                        return new Date(data).toLocaleDateString();
                    }
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            }
        });
    });
    </script>
</body>
</html>
