@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/inventario')}}" method="post" enctype="multipart/form-data">
    @csrf<!-- Para generar Token  -->
    @include('inventario.form', ['Modo'=>'Crear']  ) <!-- Para llamar al formulario -->

</form>
</div>
@endsection