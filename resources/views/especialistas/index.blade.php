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
            <!-- Campo Nombre -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="nombre" class="form-label">Nombres *</label>
              <input type="text" class="form-control" id="nombre" placeholder="Nombres de pila" title="Nombres" required>
            </div>
            <!-- Campo Apellido -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="apellido" class="form-label">Apellidos *</label>
              <input type="text" class="form-control" id="apellido" placeholder="Apellidos" title="Apellidos" required>
            </div>
            <!-- Campo Cédula -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="ci" class="form-label">Cédula *</label>
              <input type="number" class="form-control" id="ci" required placeholder="Cédula identidad solo números" title="Cédula" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && this.value.length <= 7;">
            </div>
            <!-- Campo Fecha de Nacimiento -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="fecha_nac" class="form-label">Fecha de Nacimiento *</label>
              <input type="date" class="form-control" id="fecha_nac" required title="Fecha Nacimiento">
              <span id="mensaje" style="color: red; display: none;"></span>
            </div>
            <!-- Campo Especialidad -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="especialidad" class="form-label">Especialidad *</label>
              <input type="text" class="form-control" id="especialidad" required placeholder="Especialidad" title="Especialidad">
            </div>
            <!-- Campo Teléfono -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="telefono" class="form-label">Teléfono *</label>
              <input type="text" class="form-control" required id="telefono" placeholder="0000-0000000" title="Teléfono" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && this.value.length <= 10;">
            </div>
            <!-- Campo Email -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="email" class="form-label">Correo Electrónico *</label>
              <input type="email" class="form-control" required id="email" placeholder="micorreo@gmail.com" title="Correo Electrónico">
            </div>
            <!-- Campo Género -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="genero_id" class="form-label">Género *</label>
              <select class="form-control form-control-solid select2" required style="width: 100%;" id="genero_id">
                <option selected>Seleccione su género</option>
                @foreach ($generos as $genero)
                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                @endforeach
              </select>
            </div>
            <!-- Campo Estado -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="estado_id" class="form-label">Estado *</label>
              <select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_id">
              </select>
            </div>
            <!-- Campo Municipio -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="municipio_id" class="form-label">Municipio *</label>
              <select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_id">
              </select>
            </div>
            <!-- Campo Parroquia -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="parroquia_id" class="form-label">Parroquias *</label>
              <select class="form-control form-control-solid select2" style="width: 100%;" id="parroquia_id">
              </select>
            </div>
            <!-- Campo Sector -->
            <div class="col-12 col-lg-3 mb-2">
              <label for="sector" class="form-label">Sector *</label>
              <input type="text" class="form-control" id="sector" required placeholder="cas/edif/apt/ #, calle/vereda/avenida #, nombre del sector" title="Sector">
            </div>
            <label><b>(*)Campos obligatorios</b></label><br>
            <a href="/especialistas" class="btn btn-secondary" tabindex="5">Cancelar</a>
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
      <th>Teléfono</th>
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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/dataTables.js"></script>
<script src="/js/dataTables.bootstrap5.js"></script>

<script>
  const estados = @json($estados);
  const municipios = @json($municipios);
  const parroquias = @json($parroquias);

  const selectEstado = $('#estado_id');
  const selectMunicipio = $('#municipio_id');
  const selectParroquia = $('#parroquia_id');

  const showEstados = (estados) => {
    selectEstado.empty().append('<option selected>Seleccione estado</option>');
    selectMunicipio.empty().append('<option selected>Seleccione municipio</option>');
    selectParroquia.empty().append('<option selected>Seleccione parroquia</option>');

    estados.forEach(item => {
      selectEstado.append(`<option value="${item.id}">${item.estado}</option>`);
    });
  };

  const showMunicipios = (filteredMunicipios) => {
    selectMunicipio.empty().append('<option selected>Seleccione municipio</option>');
    selectParroquia.empty().append('<option selected>Seleccione parroquia</option>');

    filteredMunicipios.forEach(item => {
      selectMunicipio.append(`<option value="${item.id}">${item.municipio}</option>`);
    });
  };

  const showParroquias = (filteredParroquias) => {
    selectParroquia.empty().append('<option selected>Seleccione parroquia</option>');
    
    filteredParroquias.forEach(item => {
      selectParroquia.append(`<option value="${item.id}">${item.parroquia}</option>`);
    });
  };

  const filterMunicipios = (id) => {
    const filteredMunicipios = municipios.filter(item => item.estado_id == id);
    showMunicipios(filteredMunicipios);
  };

  const filterParroquias = (id) => {
    const filteredParroquias = parroquias.filter(item => item.municipio_id == id);
    showParroquias(filteredParroquias);
  };

  selectEstado.on('change', function() {
    const IdValue = $(this).val();
    filterMunicipios(IdValue);
  });

  selectMunicipio.on('change', function() {
    const IdValue = $(this).val();
    filterParroquias(IdValue);
  });
</script>

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
<script src="/js/fecha.js"></script>
@stop
