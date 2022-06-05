@extends('layouts.app')
<!-- Para incluir template -->

@section('content')
<div class="container">

    @if(Session::has('Mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{Session::get('Mensaje')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <a class="btn btn-success" href="{{url('inventario/create')}}">Registrar Nuevo Item</a>
    <!--- Para agregar un item -->
    <br>
    <br>

    <table class="table table-light ">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Componente</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventarios as $inventario)
            <tr>
                <td> {{$loop->iteration}} </td>
                <th>
                    <img src="{{asset('storage/'.$inventario->Foto)}}" alt="100" width="100"> <!-- Para mostrar la foto -->
                </th>
                <td>{{$inventario->Componente}}</td>
                <td>{{$inventario->Producto}}</td>
                <td>{{$inventario->Precio}}</td>
                <td>
                    <a href="{{url('/inventario/'.$inventario->id.'/edit')}}" class="btn btn-warning">Editar</a> <!-- Para Editar -->

                    |
                    <form action="{{url('/inventario/'.$inventario->id)}}" class="d-inline" method="post">
                        <!-- Creacion de todo el Boton Borrar -->
                        @csrf
                        <!-- Para generar Token  -->
                        {{method_field('DELETE')}}<!-- Metodo Delete, para que acepte el borrar -->
                        <input class="btn btn-danger" type="submit" onclick="return confirm('Quieres Borrar?')" value="Borrar">
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    {{$inventarios->links()}} <!-- Para paginacion -->
    
</div>
@endsection