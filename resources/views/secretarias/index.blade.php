@extends('adminlte::page')

@section('title', 'Secretarias')

@section('content_header')
    <h1>Secretarias</h1>
@stop

@section('content')

@php

$heads = [
    'ID',
    'Name',
    ['label' => 'Phone', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

$config = [
    'data' => [
    ],
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>

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
@stop
