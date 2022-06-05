<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['inventarios'] = Inventario::paginate(5);
        return view('inventario.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('inventario.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $campos=[
            'Componente'=>'required|string|max:100',
            'Producto'=>'required|string|max:100',
            'Precio'=>'required|numeric',
            'Foto'=>'required|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        $mensaje=[
            'required' => 'El :attribute es requerido',
            'Foto.require' => 'La Foto es requerida',
        ];
        $this->validate($request,$campos,$mensaje);
        

       // $datosInvetario = $request->all();
        $datosInventario = $request->except('_token'); //para que no se guarde el token
        if($request->hasFile('Foto')){ //si el usuario subio una foto
            $datosInventario['Foto'] = $request->file('Foto')->store('uploads', 'public'); //para guardar la foto en la carpeta public/uploads
        }
        Inventario::insert($datosInventario); //insertar datos en la tabla inventario
        //return response()->json($datosInventario); //para devolver un json
        return redirect('/inventario')->with('Mensaje', 'Item Guardado'); //para mostrar un mensaje de que se guardo correctamente
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $inventario=Inventario::findOrFail($id); 
        return view('inventario.edit', compact('inventario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //

        $campos=[
            'Componente'=>'required|string|max:100',
            'Producto'=>'required|string|max:100',
            'Precio'=>'required|numeric',
            
        ];

        $mensaje=[
            'required' => 'El :attribute es requerido',
            
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|mimes:jpeg,png,jpg,gif,svg|max:10000',];
            $mensaje=[
                'Foto.require' => 'La Foto es requerida',
            ];
        }



        $this->validate($request,$campos,$mensaje);



        $datosInventario=request()->except(['_token','_method']); //para evitar que se envie el token y el metodo

        if($request->hasFile('Foto')){ //si el usuario subio una foto
            $inventario=Inventario::findOrFail($id); //buscar el registro en la tabla inventario
            Storage::delete('public/'.$inventario->Foto); //borrar la foto anterior 
            $datosInventario['Foto'] = $request->file('Foto')->store('uploads', 'public'); //para guardar la foto en la carpeta public/uploads
        }




        Inventario::where('id', $id)->update($datosInventario); //actualizar datos en la tabla inventario   

        $inventario=Inventario::findOrFail($id); //buscar el registro en la tabla inventario
        //return view('inventario.edit', compact('inventario')); //devolver la vista edit con los datos del registro
        return redirect('inventario') -> with('Mensaje', 'Item actualizado con exito'); //Para retornar a la pagina principal



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $inventario = Inventario::findOrFail($id); //Buscar el registro por id antiguo
        if (Storage::delete('public/' . $inventario->Foto)) { //Eliminar la foto antigua
            Inventario::destroy($id); //Eliminar el registro por id
        }
        
        return redirect('inventario') -> with('Mensaje', 'Item eliminado con exito'); //Para retornar a la pagina principal y mostrar mensaje
    }
}
