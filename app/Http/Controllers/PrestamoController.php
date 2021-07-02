<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['prestamos'] = Prestamo::orderBy('id', 'desc')->paginate(5);
        return view('prestamo.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datos['prestamo'] = new Prestamo();
        $datos['prestamo']->estatus = 'PENDIENTE';
        $datos['prestamo']->entrego = Auth::user()->name;

        
        return view('prestamo.create', $datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = [
            'cantidad' => $request->cantidad,
            'chofer' => $request->chofer,
            'entrego' => Auth::user()->name,
            'estatus' => $request->estatus,
            'fechaPrestamo' => now(),
            'fechaPago' => '',

        ];
        Prestamo::insert($datos);
        return redirect('prestamo')->with('mensaje', 'Registro Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos['prestamo'] = Prestamo::findOrFail($id);

        return view('prestamo.edit', $datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $anterior['prestamo'] = Prestamo::findOrFail($id);
        $pagado = $anterior['prestamo']->fechaPago == '' ? false : true;
        $datos = [
            'cantidad' => $request->cantidad,
            'chofer' => $request->chofer,
            'entrego' => $request->entrego,
            'estatus' => $request->estatus,            
            'fechaPago' => $request->estatus == 'PENDIENTE' ? '' : ($pagado ? $anterior['prestamo']->fechaPago : now())
        ];
        
        Prestamo::where('id', '=', $id)->update($datos);     
        return redirect('prestamo')->with('mensaje', 'Registro Agregado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        //
    }
}
