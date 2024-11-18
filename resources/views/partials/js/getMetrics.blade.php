<script>
let metricsData = {};
jQuery(document).ready(function () {
    jQuery('.btn-primary').on('click', function (e) {
        e.preventDefault();
        const loader = $('#loader');
        const url = $('.url-input input[type="url"]').val();

        if (!url) {
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Por favor, ingrese una URL para analizar.',
            });
            return;
        }

        const categories = {
            pwa: $('[name="pwa"]').is(':checked'),
            seo: $('[name="seo"]').is(':checked'),
            performance: $('[name="performance"]').is(':checked'),
            best_practices: $('[name="best-practices"]').is(':checked'),
            accessibility: $('[name="accessibility"]').is(':checked')
        };

        if (!Object.values(categories).includes(true)) {
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Por favor, seleccione al menos una categoría para analizar.',
            });
            return;
        }

        const strategy = $('.strategy-select').val();

        const payload = {
            url: url,
            ...categories,
            strategy: strategy
        };

        loader.show();
        jQuery.ajax({
            url: "{{ route('metrics.get') }}",
            type: 'GET',
            data: payload,
            success: function (response) {
                console.log('Métricas recibidas:', response);
                metricsData = response;
                loader.hide();

                if (response.seo) {
                    updateChartData('seo', response.seo.score);
                    $('#seoScore').text(response.seo.score.toFixed(2)).show(); // Solo el score
                }
                if (response.performance) {
                    updateChartData('performance', response.performance.score);
                    $('#performanceScore').text(response.performance.score.toFixed(2)).show(); // Solo el score
                }
                if (response['best-practices']) {
                    updateChartData('practices', response['best-practices'].score);
                    $('#practicesScore').text(response['best-practices'].score.toFixed(2)).show(); // Solo el score
                }
                if (response.accessibility) {
                    updateChartData('accessibility', response.accessibility.score);
                    $('#accessibilityScore').text(response.accessibility.score.toFixed(2)).show(); // Solo el score
                }
            },
            error: function (xhr, status, error) {
                loader.hide();

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;

                    let errorMessages = '';
                    for (let field in errors) {
                        errorMessages += errors[field].join(', ') + '\n';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error de validación',
                        text: 'Por favor, corrige los siguientes errores:',
                        footer: `<pre>${errorMessages}</pre>`,
                        confirmButtonText: 'Cerrar'
                    });
                }
                else if (xhr.status === 400) {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'La URL debe terminar con un dominio válido como .com, .es, .net, entre otros.',
                        confirmButtonText: 'Cerrar'
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error del servidor',
                        text: 'Hubo un problema con la solicitud. Por favor, intentalo más tarde.',
                        confirmButtonText: 'Cerrar'
                    });
                }
            }
        });
    });
});

</script>
