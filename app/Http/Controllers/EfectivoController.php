<?php

namespace App\Http\Controllers;

use App\Models\Efectivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EfectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['efectivos'] = Efectivo::orderBy('id', 'desc')->paginate(5); 
        $datos['dinero'] = EfectivoController::obtenerDinero();       
        return view('efectivo.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('efectivo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $datosEfectivo = [
            'cantidad'=>$request->cantidad,
            'concepto'=>$request->concepto,
            'aplicacion'=>$request->aplicacion,
            'nota'=>$request->nota == null ? '' : $request->nota,
            'tipo'=>$request->tipo,
            'created_at'=>now()
        ];
        Efectivo::insert($datosEfectivo);
        return redirect('efectivo')->with('mensaje','Registro Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Efectivo  $efectivo
     * @return \Illuminate\Http\Response
     */
    public function show(Efectivo $efectivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Efectivo  $efectivo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos['efectivo'] = Efectivo::findOrFail($id);   
        return view('efectivo.edit', $datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Efectivo  $efectivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosEfectivo = [
            'cantidad'=>$request->cantidad,
            'concepto'=>$request->concepto,
            'aplicacion'=>$request->aplicacion,
            'nota'=>$request->nota,
            'tipo'=>$request->tipo
        ];
        
        Efectivo::where('id', '=', $id)->update($datosEfectivo);
        return redirect('efectivo')->with('mensaje', 'Registro Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Efectivo  $efectivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Efectivo::destroy($id);
        return redirect('efectivo')->with('mensaje', 'Registro Eliminado Correctamente');
    }

    static function obtenerDinero(){
        $ingreso =      DB::table('efectivos')->where('tipo','=','INGRESO')->sum('cantidad');
        $gasto =        DB::table('efectivos')->where('tipo','=','GASTO')->sum('cantidad');
        $prestamos =    DB::table('prestamos')->where('estatus','=','PENDIENTE')->sum('cantidad');
        $cartaPortes =  DB::table('carta_portes')
                            ->where('estatusPago', '!=', 'CANCELADA')
                            ->where('asignado', '=', 'EMPRESA')
                            ->whereDate('fecha', '>', '2020-01-23')
                            ->sum('totalEntregado');


        $datos['dinero'] = $ingreso - $gasto - $prestamos - $cartaPortes;

        return $datos['dinero'];
    }
}
