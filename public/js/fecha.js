$(document).ready(function() {
    var hoy = new Date();
    var dd = String(hoy.getDate()).padStart(2, '0');
    var mm = String(hoy.getMonth() + 1).padStart(2, '0'); 
    var yyyy = hoy.getFullYear();
    hoy = yyyy + '-' + mm + '-' + dd; 

    $('#fecha_nac').attr('max', hoy); 

    $('#fecha_nac').on('change', function() {
        var fecha_nacSeleccionada = $(this).val();
        if (fecha_nacSeleccionada > hoy) {
            $('#mensaje').text('Por favor, selecciona una fecha que no sea futura.').show();
            $(this).val(''); 
        } else {
            $('#mensaje').hide(); 
        }
    });
});