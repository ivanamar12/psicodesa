@extends('adminlte::page')

@section('title', 'Secretarias')

@section('content_header')
    <h1>Secretarias</h1>
@stop
@include('secretarias.modals.create')
@include('secretarias.modals.edit')
@include('secretarias.modals.delete')

@section('content')

<a href="#" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#createSecretaria">Nuevo Secretaria<i class="fas fa-plus"></i></a><br>


<table id="secretarias" class="table table-striped" style="width:100%">
            <thead>
                <tr class="">
                    <th>id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cedula</th>
                    <th>Especialidad</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Genero</th>
                    <th>acciones</th>
                </tr>
            </thead>
            <tbody>
        </table>
@stop

@section('css')
    {{-- Agregar aquí hojas de estilo adicionales --}}
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
@stop

@section('css')
<link href="/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
@stop

@section('js')
<script src="/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <script src="/js/dataTables.js"></script>
    <script src="/js/dataTables.bootstrap5.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/fecha.js"></script>
    <script src="/js/direccion.js"></script>
    <script src="/js/crud.js"></script>

    <script>
        $(document).ready(function(){
            $('#secretarias').DataTable();
        })
    </script>
    
    <script>
        $(document).ready(function() {
            $('#miDataTable').DataTable();
        });
    </script>
    <script type="text/javascript">
  const estados = <?php echo json_encode($estados); ?>;
  const municipios = <?php echo json_encode($municipios); ?>;
  const parroquias = <?php echo json_encode($parroquias); ?>;
</script>
@stop
