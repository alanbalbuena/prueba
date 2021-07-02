<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use Illuminate\Http\Request;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['choferes'] = Chofer::orderBy('id', 'desc')->paginate(5);
        return view('chofer.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('chofer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $campos = [
            'nombre'=>'required|string|max:100',
            'codigo'=>'required|string|max:100',
            'porcentaje'=>'required|int|max:10',
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido'
        ];
        $this->validate($request,$campos,$mensaje);

        $datosChofer = request()->except('_token');
        Chofer::insert($datosChofer);
        return redirect('chofer')->with('mensaje','Chofer Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function show(Chofer $chofer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $chofer = Chofer::findOrFail($id);

        return view('chofer.edit', compact('chofer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosChofer = request()->except(['_token', '_method']);
        Chofer::where('id', '=', $id)->update($datosChofer);

        return redirect('chofer')->with('mensaje','Chofer Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Chofer::destroy($id);
        return redirect('chofer')->with('mensaje','Chofer Eliminado Correctamente');
    }
}
