@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
<h1>Pacientes</h1>
@stop

@section('content')

<div class="modal fade" id="pacienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(0, 204, 204); background: linear-gradient(90deg, rgb(0, 153, 204) 0%, rgb(0, 204, 204) 100%);">
        <h5 class="modal-title" id="exampleModalLabel">Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="pacienteForm">
          <input type="hidden" id="pacienteId">
          <div class="form-group row">
          <div class="col-12 col-lg-3 mb-2">
              <label for="representante_id" class="form-label">Representante *</label>
              <select class="form-control form-control-solid select2" required style="width: 100%;" id="genero_id">
                <option selected>Seleccione un representante</option>
                @foreach ($representantes as $representante)
                <option value="{{$representante->id}}">{{$representante->nombre}}</option>
                @endforeach
              </select>
            </div>
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
              <label for="grado" class="form-label">Grado *</label>
              <input type="text" class="form-control" id="grado" required placeholder="grado" title="Grado">
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
              </select>
            </div>
            <div class="col-12 col-lg-3 mb-2">
              <label for="municipio_id" class="form-label">Municipio *</label>
              <select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_id">
              </select>
            </div>
            <div class="col-12 col-lg-3 mb-2">
              <label for="parroquia_id" class="form-label">Parroquias *</label>
              <select class="form-control form-control-solid select2" style="width: 100%;" id="parroquia_id">
              </select>
            </div>
            <div class="col-12 col-lg-3 mb-2">
              <label for="sector" class="form-label">Sector *</label>
              <input type="text" class="form-control" id="sector" required placeholder="cas/edif/apt/ #, calle/vereda/avenida #, nombre del sector" title="Sector">
            </div>
            <label><b>(*)Campos obligatorios</b></label><br>
            <a href="/pacientes" class="btn btn-secondary" tabindex="5">Cancelar</a>
            <button type="submit" class="btn btn-primary" tabindex="5">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<button class="btn btn-primary" data-toggle="modal" data-target="#pacienteModal" id="createBtn">Nuevo Paciente</button>
<table id="table1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>CI</th>
      <th>Grado</th>
      <th>Email</th>
      <th>Telefono</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody id="pacienteList">
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

<script src="/js/jquery.min.js"></script>
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

  showEstados(estados)

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
    const filteredMunicipios = municipios.filter(item => item.estado_id == id)
    showMunicipios(filteredMunicipios)
  }

  const filterParroquias = (id) => {
    const filteredParroquias = parroquias.filter(item => item.mmunicipio_id == id)
    showParroquias(filteredParroquias)
  }

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
    function getPacientes() {
      $.get('/pacientes/data', function(data) {
        $('#pacienteList').empty();
        data.forEach(paciente => {
          $('#pacienteList').append(`
                    <tr>
                        <td>${paciente.id}</td>
                        <td>${paciente.nombre}</td>
                        <td>${paciente.apellido}</td>
                        <td>${paciente.ci}</td>
                        <td>${paciente.grado}</td>
                        <td>${paciente.email}</td>
                        <td>${paciente.telefono}</td>
                        <td>
                           <button class="btn btn-warning btn-sm" onclick="editPaciente(${paciente.id})">Editar</button>
                           <button class="btn btn-danger btn-sm" onclick="deletePaciente(${paciente.id})">Eliminar</button>
                        </td>
                    </tr>
                `);
        });
        $('#table1').DataTable();
      });
    }
    getPacientes();


    $('#createBtn').click(function(e) {
      e.preventDefault();
      $('#pacienteId').val('');
      $('#pacienteForm')[0].reset();
      $('#exampleModalLabel').text('Registrar Paciente');
      $('#pacienteModal').modal('show');
    });

    // Enviar el formulario
    $('#pacienteForm').submit(function(e) {
      e.preventDefault();
      let id = $('#pacienteId').val();
      let url = id ? `/pacientes/${id}` : '/pacientes';
      let method = id ? 'PUT' : 'POST';

      $.ajax({
        url: url,
        method: method,
        data: {
          nombre: $('#nombre').val(),
          apellido: $('#apellido').val(),
          ci: $('#ci').val(),
          fecha_nac: $('#fecha_nac').val(),
          grado: $('#grado').val(),
          telefono: $('#telefono').val(),
          email: $('#email').val(),
          representante_id: $('#representante_id').val(),
          genero_id: $('#genero_id').val(),
          estado_id: $('#estado_id').val(),
          municipio_id: $('#municipio_id').val(),
          parroquia_id: $('#parroquia_id').val(),
          sector: $('#sector').val(),
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          $('#pacienteForm')[0].reset(); // Limpiar el formulario
          $('#pacienteId').val(''); // Limpiar el ID
          $('#pacienteModal').modal('hide'); // Cerrar el modal
          getPacientes(); // Actualizar la lista de paciente
        },
        error: function(xhr) {
          alert('Error: ' + xhr.responseText); // Manejar errores
        }
      });
    });
  });


  function editPaciente(id) {
    $.get(`/pacientes/${id}`, function(data) {
      $('#pacienteId').val(data.id);
      $('#nombre').val(data.nombre);
      $('#apellido').val(data.apellido);
      $('#ci').val(data.ci);
      $('#fecha_nac').val(data.fecha_nac);
      $('#grado').val(data.grado);
      $('#telefono').val(data.telefono);
      $('#email').val(data.email);
      $('#representante_id').val(data.representante_id);
      $('#genero_id').val(data.genero_id);
      $('#estado_id').val(data.estado_id);
      $('#municipio_id').val(data.municipio_id);
      $('#parroquia_id').val(data.parroquia_id);
      $('#sector').val(data.sector);
      $('#exampleModalLabel').text('Editar paciente'); // Cambiar el título
      $('#pacienteModal').modal('show'); // Mostrar el modal
    });
  }

  function deletePaciente(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este paciente?')) {
      $.ajax({
        url: `/pacientes/${id}`,
        method: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          getPacientes();
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