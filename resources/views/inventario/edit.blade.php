@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/inventario/'.$inventario->id)}}" method="post" enctype="multipart/form-data">
@csrf<!-- Para generar Token  -->
{{method_field('PATCH')}} <!-- para acceder directamente al metodo update -->
@include('inventario.form', ['Modo'=>'Editar'] )<!-- Para llamar al formulario -->

</form>
</div>
@endsection

