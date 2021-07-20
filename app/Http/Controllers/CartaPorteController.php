<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        $datos['cartaPortes'] = CartaPorte::orderBy('id', 'desc')->paginate(100);        
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
        $campos = [
            'toneladas' => 'required|string|max:100',
            'precio' => 'required|string|max:100',
            'chofer' => 'required|string|max:100',
            'empresa' => 'required|string|max:100',
            'entrega' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El campo :attribute es requerido'
        ];
        $this->validate($request, $campos, $mensaje);

        $datos = [
            'toneladas' => $request->toneladas,
            'precioPorTonelada' => $request->precio,
            'precioPorSeguro' => $request->radioSeguro,
            'chofer' => $request->chofer,
            'porcentaje' => $request->porcentaje,
            'nombre' => '',
            'empresa' => $request->empresa,
            'identificadorCartaPorte' => $request->txtCartaPorte == null ? '' : $request->txtCartaPorte,
            'totalFlete' => $request->txtSubTotal,
            'totalEntregado' => $request->txtEntregar,
            'transferencia' => $request->txtTransferencia == null ? '' : $request->txtTransferencia,
            'totalDisel' => $request->txtDisel == null ? '' : $request->txtDisel,
            'estatusTransferencia' => 'PENDIENTE',
            'facturaChofer' => '',
            'retorno' => 'PENDIENTE',
            'fecha' => now(),
            'factura' => '0',
            'reFactura' => $request->reFactura == null ? '0' : $request->reFactura,
            'compro' => Auth::user()->name,
            'remision' => $request->txtRemisiones == null ? '' : $request->txtRemisiones,
            'asignado' => $request->txtAsignado == null ? '' : $request->txtAsignado,
            'entrega' => $request->entrega,
            'estatusPago' => 'PENDIENTE'
        ];
        CartaPorte::insert($datos);
        return redirect('sinFacturar/empresa')->with('mensaje', 'Registro Agregado Correctamente');
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
        $datos['choferes'] = Chofer::all();
        $datos['empresas'] = Empresa::all();
        $datos['lugares'] = LugarEntrega::all();
        $datos['cartaPorte'] = CartaPorte::findOrFail($id);

        return view('cartaPorte.edit', $datos);
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
        $campos = [
            'toneladas' => 'required|string|max:100',
            'precio' => 'required|string|max:100',
            'chofer' => 'required|string|max:100',
            'empresa' => 'required|string|max:100',
            'entrega' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El campo :attribute es requerido'
        ];
        $this->validate($request, $campos, $mensaje);

        $datosCartaPorte = [
            'toneladas' => $request->toneladas,
            'precioPorTonelada' => $request->precio,
            'precioPorSeguro' => $request->radioSeguro,
            'chofer' => $request->chofer,
            'porcentaje' => $request->porcentaje,
            'empresa' => $request->empresa,
            'identificadorCartaPorte' => $request->txtCartaPorte == null ? '' : $request->txtCartaPorte,
            'totalFlete' => $request->txtSubTotal,
            'totalEntregado' => $request->txtEntregar,
            'transferencia' => $request->txtTransferencia == null ? '' : $request->txtTransferencia,
            'totalDisel' => $request->txtDisel == null ? '' : $request->txtDisel,
            'remision' => $request->txtRemisiones == null ? '' : $request->txtRemisiones,
            'asignado' => $request->txtAsignado == null ? '' : $request->txtAsignado,
            'entrega' => $request->entrega,
            'factura' => $request->factura,
            'reFactura' => $request->reFactura == null ? '0' : $request->reFactura
        ];

        CartaPorte::where('id', '=', $id)->update($datosCartaPorte);        
        return redirect('sinFacturar/empresa')->with('mensaje', 'Registro Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartaPorte  $CartaPorte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartaPorte::destroy($id);
        return redirect('sinFacturar/empresa')->with('mensaje', 'Registro Eliminado Correctamente');
    }

    public function sinFacturar($id)
    {
        if ($id == 'nadie') {
            $datos['cartaPortes'] = CartaPorte::orderBy('id', 'desc')->where('asignado', '')->paginate(100);
        } else if ($id == 'empresa') {
            $datos['cartaPortes'] = CartaPorte::orderBy('id', 'desc')->where('asignado', $id)->where('factura', '0')->paginate(100);
        } else {
            $datos['cartaPortes'] = CartaPorte::orderBy('id', 'desc')->where('asignado', $id)->paginate(100);
        }       
    
        return view('cartaPorte.sinFacturar', $datos);
    }    

    
    public function buscar(Request $request)
    {                            
        $texto = $request->texto;  
        $datos['cartaPortes'] = CartaPorte::orderBy('id', 'desc')
                                            ->where('factura', 'like', '%'. $texto . '%')
                                            ->orWhere('reFactura', 'like', '%'. $texto . '%')
                                            ->orWhere('toneladas', 'like', '%'. $texto . '%')
                                            ->orWhere('remision', 'like', '%'. $texto . '%')
                                            ->orWhere('identificadorCartaPorte', 'like', '%'. $texto . '%')
                                            ->orWhere('chofer', 'like', '%'. $texto . '%')
                                            ->orWhere('empresa', 'like', '%'. $texto . '%')
                                            ->orWhere('totalFlete', 'like', '%'. $texto . '%')
                                            ->orWhere('totalEntregado', 'like', '%'. $texto . '%')                                            
                                            ->orWhere('transferencia', 'like', '%'. $texto . '%')
                                            ->orWhere('totalDisel', 'like', '%'. $texto . '%')
                                            ->orWhere('entrega', 'like', '%'. $texto . '%')
                                            ->orWhere('estatusPago', 'like', '%'. $texto . '%')                                            
                                            ->paginate(100);
        $datos['texto'] = $texto;
        return view('cartaPorte.index', $datos);
    }
}          