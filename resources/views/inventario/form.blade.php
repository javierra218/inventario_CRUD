<h1>{{$Modo}} Item</h1> <!-- Para mostrar el modo -->

@if(count ($errors)>0) <!--Para mostrar errores-->
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-group">
    <label for="Componente">Componente</label>
    <input type="text" class="form-control" name="Componente" value=" {{isset($inventario->Componente) ? $inventario->Componente:old('Componente') }}" id="Componente">
    <br>
</div>

<div class="form-group">
    <label for="Producto">Producto</label>
    <input type="text" class="form-control" name="Producto" value=" {{isset($inventario->Producto) ? $inventario->Producto:old('Producto') }}" id="Producto">
    <br>
</div>

<div class="form-group">
    <label for="Precio">Precio</label>
    <input type="text" class="form-control" name="Precio" value=" {{isset($inventario->Precio) ? $inventario->Precio:old('Precio') }}" id="Precio">
    <br>
</div>

<div class="form-group">
    <label for="Foto">Foto</label>

    @if(isset($inventario->Foto))
    <img src="{{asset('storage/'.$inventario->Foto)}}" alt="100" width="100"> <!-- Para mostrar la foto -->
    @endif
    <input type="file" class="form-group" name="Foto" value="" id="Foto">
    <br>
</div>

<input class="btn btn-success" type="submit" value="{{$Modo=='Crear' ? 'Agregar' : 'Editar'}}"> <!-- Para agreagar un nuevo registro -->

<a  class="btn btn-primary" href="{{url('inventario')}}">Regresar</a>
<!--- Para Regresar al index -->
<br>