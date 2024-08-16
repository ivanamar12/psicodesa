$(document).on('click', '.edit-btn', function() {
    var Id = $(this).data('id'); // Obtiene el ID del especialista del botón clicado

   
    // Realiza una solicitud AJAX para obtener los datos del especialista
    $.ajax({
        url: '/especialistas/' + Id + '/edit', // Ruta para obtener los datos del especialista
        method: 'GET',
        success: function(data) {
            // Llena el formulario de edición con los datos del especialista
            $('#editEspecialistaId').val(data.id);
            $('#editNombre').val(data.nombre);
            $('#editApellido').val(data.apellido);
            $('#editCedula').val(data.ci);
            $('#editTelefono').val(data.telefono);
            $('#editEmail').val(data.email);
            $('#editModal').modal('show'); // Muestra el modal de edición
        },
        error: function(xhr) {
            alert('Error al obtener los datos del especialista: ' + xhr.status + ' ' + xhr.statusText);
        }
    });
});
