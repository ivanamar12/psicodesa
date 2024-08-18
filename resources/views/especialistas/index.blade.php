@extends('adminlte::page')

@section('title', 'Especialistas')

@section('content_header')
    <h1>Especialistas</h1>
@stop

@section('content')

<div class="modal fade" id="especialistaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(0, 204, 204); background: linear-gradient(90deg, rgb(0, 153, 204) 0%, rgb(0, 204, 204) 100%);">
        <h5 class="modal-title" id="exampleModalLabel">Especialista</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="especialistaForm">
                <input type="hidden" id="especialistaId">
              <div class="form-group row">
              <div class="col-12 col-lg-3 mb-2">
                <label for="nombre" class="form-label">Nombres *</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombres de pila" title="Nombres" required>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="apellido" class="form-label">Apellidos *</label>
                <input type="text" class="form-control" id="apellido" placeholder="Apellidos" title="Apellidos" required>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="ci" class="form-label">Cedula *</label>
                <input type="number" class="form-control" id="ci" required placeholder="Cedula identidad solo numeros" title="Cedula" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=7;">
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="fecha_nac" class="form-label">Fecha de Nacimiento *</label>
                <input type="date" class="form-control" id="fecha_nac" required title="Fecha Nacimiento">
                <span id="mensaje" style="color: red; display: none;"></span>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="especialidad" class="form-label">Especialidad *</label>
                <input type="text" class="form-control" id="especialidad" required placeholder="Especialidad" title="Especialidad">
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="telefono" class="form-label">Telefono *</label>
                <input type="text" class="form-control" required id="telefono" placeholder="0000-0000000" title="Telefono" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=10;">
              </div>

              <div class="col-12 col-lg-3 mb-2">
                <label for="email" class="form-label">Correo Electronico *</label>
                <input type="email" class="form-control" required id="email" placeholder="micorreo@gmail.com" title="Correo Electronico">
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="genero_id" class="form-label">Genero *</label>
                <select class="form-control form-control-solid select2" required style="width: 100%;" id="genero_id">
                    <option selected>Seleccione su genero</option>
                    @foreach ($generos as $genero)
                    <option value="{{$genero->id}}">{{$genero->genero}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="estado_id" class="form-label">Estado *</label>
                <select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_id">
                    <option selected>Seleccione un estado</option>
                    @foreach ($estados as $estado)
                    <option value="{{$estado->id}}">{{$estado->estado}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="municipio_id" class="form-label">Municipio *</label>
                <select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_id">
                    <option selected>Seleccione un municipio</option>
                    @foreach ($municipios as $municipio)
                    <option value="{{$municipio->id}}">{{$municipio->municipio}}</option>
                    @endforeach
                </select>
              </div>
               <div class="col-12 col-lg-3 mb-2">
                <label for="parroquia_id" class="form-label">Parroquias *</label>
                <select class="form-control form-control-solid select2" required style="width: 100%;" id="parroquia_id">
                    <option selected>Seleccione un parroquia</option>
                    @foreach ($parroquias as $parroquia)
                    <option value="{{$parroquia->id}}">{{$parroquia->parroquia}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-12 col-lg-3 mb-2">
                <label for="sector" class="form-label">Sector *</label>
                <input type="text" class="form-control" id="sector" required placeholder="cas/edif/apt/ #, calle/vereda/avenida #, nombre del sector" title="Sector">
              </div>
              <label><b>(*)Campos obligatorios</b></label><br>
              <a href="/especilistas" class="btn btn-secondary" tabindex="5">Cancelar</a>
              <button type="submit" class="btn btn-primary" tabindex="5">Agregar</button>
            </div>
            </form>
      </div>
    </div>
  </div>
</div>

<button class="btn btn-primary" data-toggle="modal" data-target="#especialistaModal" id="createBtn">Nuevo Especialista</button>
<table id="table1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>CI</th>
            <th>Especialidad</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="especialistaList">
        <!-- Los datos se insertan aquí -->
    </tbody>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link href="/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
@stop

@section('js')
<script>
$(document).ready(function() {
    function getEspecialistas() {
        $.get('/especialistas/data', function(data) { 
            $('#especialistaList').empty(); 
            data.forEach(especialista => {
                $('#especialistaList').append(`
                    <tr>
                        <td>${especialista.id}</td>
                        <td>${especialista.nombre}</td>
                        <td>${especialista.apellido}</td>
                        <td>${especialista.ci}</td>
                        <td>${especialista.especialidad}</td>
                        <td>${especialista.email}</td>
                        <td>${especialista.telefono}</td>
                        <td>
                           <button class="btn btn-warning btn-sm" onclick="editEspecialista(${especialista.id})">Editar</button>
                           <button class="btn btn-danger btn-sm" onclick="deleteEspecialista(${especialista.id})">Eliminar</button>
                        </td>
                    </tr>
                `);
            });
            $('#table1').DataTable();
        });
    }
    getEspecialistas();

   
    $('#createBtn').click(function(e) {
        e.preventDefault();
        $('#especialistaId').val('');
        $('#especialistaForm')[0].reset(); 
        $('#exampleModalLabel').text('Registrar Especialista'); 
        $('#especialistaModal').modal('show');
    });

    // Enviar el formulario
    $('#especialistaForm').submit(function(e) {
        e.preventDefault();
        let id = $('#especialistaId').val();
        let url = id ? `/especialistas/${id}` : '/especialistas';
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: {
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                ci: $('#ci').val(),
                fecha_nac: $('#fecha_nac').val(),
                especialidad: $('#especialidad').val(),
                telefono: $('#telefono').val(),
                email: $('#email').val(),
                genero_id: $('#genero_id').val(),
                estado_id: $('#estado_id').val(),
                municipio_id: $('#municipio_id').val(),
                parroquia_id: $('#parroquia_id').val(),
                sector: $('#sector').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#especialistaForm')[0].reset(); // Limpiar el formulario
                $('#especialistaId').val(''); // Limpiar el ID
                $('#especialistaModal').modal('hide'); // Cerrar el modal
                getEspecialistas(); // Actualizar la lista de especialistas
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText); // Manejar errores
            }
        });
    });
});


function editEspecialista(id) {
    $.get(`/especialistas/${id}`, function(data) {
        $('#especialistaId').val(data.id);
        $('#nombre').val(data.nombre);
        $('#apellido').val(data.apellido);
        $('#ci').val(data.ci);
        $('#fecha_nac').val(data.fecha_nac);
        $('#especialidad').val(data.especialidad);
        $('#telefono').val(data.telefono);
        $('#email').val(data.email);
        $('#genero_id').val(data.genero_id);
        $('#estado_id').val(data.estado_id);
        $('#municipio_id').val(data.municipio_id);
        $('#parroquia_id').val(data.parroquia_id);
        $('#sector').val(data.sector);
        $('#exampleModalLabel').text('Editar Especialista'); // Cambiar el título
        $('#especialistaModal').modal('show'); // Mostrar el modal
    });
}

function deleteEspecialista(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este especialista?')) {
        $.ajax({
            url: `/especialistas/${id}`,
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                getEspecialistas();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    }
}
</script>

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/dataTables.js"></script>
<script src="/js/dataTables.bootstrap5.js"></script>
<script src="/js/fecha.js"></script>
<script src="/js/direccion.js"></script>
@stop
