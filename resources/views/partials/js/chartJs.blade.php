<script>
    const commonOptions = {
        type: 'doughnut',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            return `Score: ${(context.raw * 100).toFixed()}%`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true,
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    };

    function createChart(canvasId, value, color) {
        const ctx = document.getElementById(canvasId).getContext('2d');
        const remaining = 1 - value;

        return new Chart(ctx, {
            ...commonOptions,
            data: {
                datasets: [{
                    data: [value, remaining],
                    backgroundColor: [
                        `rgba(${color}, 0.8)`,
                        `rgba(${color}, 0.1)`
                    ],
                    borderWidth: 0,
                    borderRadius: 20
                }]
            }
        });
    }

    const charts = {
        seo: createChart('seoChart', 0, '79, 70, 229'),
        performance: createChart('performanceChart', 0, '59, 130, 246'),
        practices: createChart('practicesChart', 0, '16, 185, 129'),
        accessibility: createChart('accessibilityChart', 0, '236, 72, 153')
    };

    Object.entries(charts).forEach(([key, chart]) => {
        const canvas = chart.canvas;
        const value = chart.data.datasets[0].data[0];

        chart.options.plugins.afterDraw = function(chart) {
            const ctx = chart.ctx;
            const width = chart.width;
            const height = chart.height;

            ctx.restore();
            ctx.font = 'bold 24px sans-serif';
            ctx.textBaseline = 'middle';
            ctx.textAlign = 'center';

            const gradient = ctx.createLinearGradient(0, 0, width, 0);
            gradient.addColorStop(0, '#4F46E5');
            gradient.addColorStop(1, '#7C3AED');

            ctx.fillStyle = gradient;
            ctx.fillText((value * 100).toFixed() + '%', width / 2, height / 2);
            ctx.save();
        };
    });

    function updateChartData(chartKey, score) {
        const chart = charts[chartKey];
        if (!chart) {
            console.error(`Chart "${chartKey}" no encontrado.`);
            return;
        }

        const adjustedScore = score === 1 ? 0.999 : score;
        chart.data.datasets[0].data = [adjustedScore, 1 - adjustedScore];
        chart.update();
    }

    document.querySelectorAll('.metric-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            const canvasId = card.querySelector('canvas').id;
            const chart = charts[canvasId.replace('Chart', '').toLowerCase()];

            if (chart) {
                chart.options.animation.animateScale = true;
                chart.update();
            }
        });
    });
</script>
