@extends('adminlte::page')

@section('title', 'Especialistas')

@section('content_header')
    <h1>Especialistas</h1>
@stop
@include('especialistas.modals.create')
@include('especialistas.modals.edit')
@include('especialistas.modals.delete')

@section('content')

<a href="#" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#createEspecialista">Nuevo Especialista <i class="fas fa-plus"></i></a><br>


<table id="especialistas" class="table table-striped" style="width:100%">
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
                @foreach ($especialistas as $especialista)
                    <tr>
                        <td>{{$especialista->id}}</td>
                        <td>{{$especialista->nombre}}</td>
                        <td>{{$especialista->apellido}}</td>
                        <td>{{$especialista->ci}}</td>
                        <td>{{$especialista->especialidad}}</td>
                        <td>{{$especialista->email}}</td>
                        <td>{{$especialista->telefono}}</td>
                        <td>{{$especialista->genero}}</td>
                        <td>

                            <form action="{{ route ('Especialistas.destroy',$especialista->id)}}" method="POST">
                             <a href="#" class="btn btn-primary edit-btn" data-id="{{ $especialista->id }}" data-toggle="modal" data-target="#editModal">Editar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
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
            $('#especialistas').DataTable();
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
