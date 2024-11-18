<script>
    jQuery(document).ready(function () {
        jQuery('.btn-save').on('click', function (e) {
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

            if (Object.keys(metricsData).length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Por favor, obtenga las métricas antes de guardarlas.',
                });
                return;
            }

            const strategy = $('.strategy-select').val();

            const payload = {
                url: url,
                strategy: strategy,
                metrics: metricsData
            };

            loader.show();
            jQuery.ajax({
                url: "{{ route('metrics.store') }}",
                type: 'POST',
                data: {
                    _token: jQuery('meta[name="csrf-token"]').attr('content'),
                    ...payload
                },
                success: function (response) {
                    console.log('Métricas guardadas:', response);
                    loader.hide();
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Métricas guardadas exitosamente!',
                        confirmButtonText: 'Cerrar'
                    });
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
                    } else {
                        console.error('Error al guardar métricas:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un problema al guardar las métricas.',
                            confirmButtonText: 'Cerrar'
                        });
                    }
                }
            });
        });
    });
</script>
