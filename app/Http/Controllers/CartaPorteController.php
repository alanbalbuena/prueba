<?php

namespace App\Http\Controllers;

use App\Models\CartaPorte;
use App\Models\Chofer;
use App\Models\Empresa;
use App\Models\LugarEntrega;
use Illuminate\Http\Request;

class CartaPorteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['cartaPortes'] = CartaPorte::orderBy('id', 'desc')->paginate(5);
        return view('cartaPorte.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datos['choferes'] = Chofer::all();
        $datos['empresas'] = Empresa::all();
        $datos['lugares'] = LugarEntrega::all();
        return view('cartaPorte.create', $datos);
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
        /* $campos = [
            'nombre' => 'required|string|max:100',
            'codigo' => 'required|string|max:100',
            'porcentaje' => 'required|int|max:10',
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido'
        ];
        $this->validate($request, $campos, $mensaje); */
        
        $datos = [
            'toneladas' => $request->txtToneladas,
            'precioPorTonelada' => $request->txtPrecioPorTonelada,
            'precioPorSeguro' => $request->radioSeguro,
            'chofer' => $request->txtChofer,
            'nombre' => '',
            'empresa' => $request->txtEmpresa,
            'identificadorCartaPorte' => $request->txtCartaPorte,
            'totalFlete' => $request->txtSubTotal,
            'totalEntregado' => $request->txtEntregar,
            'transferencia' => $request->txtTransferencia,
            'totalDisel' => $request->txtDisel,
            'estatusTransferencia' => 'PENDIENTE',
            'facturaChofer' => '',
            'retorno' => 'PENDIENTE',
            'fecha' => now(),
            'factura' => '0',
            'reFactura' => '0',
            'compro' => 'ANGEL',
            'remision' => $request->txtRemisiones,
            'entrega' => $request->txtEntrega,
            'estatusPago' => 'PENDIENTE'
        ];
        CartaPorte::insert($datos);
        return redirect('sinFacturar')->with('mensaje', 'Registro Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartaPorte  $cartaPorte
     * @return \Illuminate\Http\Response
     */
    public function show(CartaPorte $cartaPorte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartaPorte  $cartaPorte
     * @return \Illuminate\Http\CartaPorte
     */
    public function edit($id)
    {
        //
        $cartaPorte = CartaPorte::findOrFail($id);

        return view('cartaPorte.edit', compact('cartaPorte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartaPorte  $cartaPorte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosCartaPorte = request()->except(['_token', '_method']);
        CartaPorte::where('id', '=', $id)->update($datosCartaPorte);

        return redirect('sinFacturar')->with('mensaje', 'Registro Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartaPorte  $CartaPorte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        CartaPorte::destroy($id);
        return redirect('sinFacturar')->with('mensaje', 'Registro Eliminado Correctamente');
    }

    public function sinFacturar()
    {
        $datos['cartaPortes'] = CartaPorte::where('factura', '0')->paginate(5);        
        return view('cartaPorte.sinFacturar', $datos);
    }
}
