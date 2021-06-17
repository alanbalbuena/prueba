<h1>{{ $modo }} Registro</h1>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>

@endif
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="number" step=0.01 class="form-control" id="toneladas" placeholder="Toneladas" name="toneladas" onkeyup="CalcularEntrega()">
    </div>
    <div class="form-group col-md-6">
        <input type="number" class="form-control" id="precio" placeholder="Precio" name="precio" onkeyup="CalcularEntrega()">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input class="form-control" list="datalistChoferes" id="chofer" placeholder="Chofer" name="txtChofer" onchange="setPorcentage()">
        <datalist id="datalistChoferes">
            @foreach($choferes as $chofer)            
            <option data-id="{{ $chofer->porcentaje}}" value="{{$chofer->nombre}}"></option>
            @endforeach
        </datalist>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label class="radio-inline">
            <input type="radio" name="radioPorcentaje" id="porcentage0" value="0">0%
        </label>
        <label class="radio-inline">
            <input type="radio" name="radioPorcentaje" id="porcentage4" value="4">4%
        </label>
        <label class="radio-inline">
            <input type="radio" name="radioPorcentaje" id="porcentage8" value="8">8%
        </label>
        <label class="radio-inline">
            <input type="radio" name="radioPorcentaje" id="porcentage10" value="10">10%
        </label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label class="radio-inline">
            <input type="radio" name="radioSeguro" value="0" checked>0
        </label>
        <label class="radio-inline">
            <input type="radio" name="radioSeguro" value="35">35
        </label>
        <label class="radio-inline">
            <input type="radio" name="radioSeguro" value="65">65
        </label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input class="form-control" list="datalistEmpresas" id="empresa" placeholder="Empresa" name="empresa">
        <datalist id="datalistEmpresas">
            @foreach($empresas as $empresa)            
                <option data-id="{{ $empresa->id}}" value="{{$empresa->nombre}}"></option>
            @endforeach
        </datalist>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input class="form-control" list="datalistEntregas" id="entrega" placeholder="Lugar de Entrega" name="entrega">
        <datalist id="datalistEntregas">
            @foreach($lugares as $lugar)            
                <option data-id="{{ $lugar->id}}" value="{{$lugar->nombre}}"></option>
            @endforeach
        </datalist>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control" id="txtCartaPorte" placeholder="CartaPortes" name="txtCartaPorte">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control" id="txtRemisiones" placeholder="Remisiones" name="txtRemisiones">
    </div>
</div>
<div class="form-row">
    <label class="col-sm-3 col-form-label">Sub Total</label>
    <div class="form-group col-md-9">
        <input type="number" class="form-control" id="txtSubTotal" placeholder="Sub Total" name="txtSubTotal" readonly>
    </div>
</div>
<div class="form-row">
    <label class="col-sm-3 col-form-label">Transferencia</label>
    <div class="form-group col-md-9">
        <input type="number" class="form-control" id="txtTransferencia" name="txtTransferencia" placeholder="Transferencia" onkeyup="CalcularEntrega()">
    </div>
</div>
<div class="form-row">
    <label class="col-sm-3 col-form-label">Disel</label>
    <div class="form-group col-md-9">
        <input type="number" class="form-control" id="txtDisel" name="txtDisel" placeholder="Disel" onkeyup="CalcularEntrega()">
    </div>
</div>
<div class="form-row">
    <label class="col-sm-3 col-form-label">Entregar</label>
    <div class="form-group col-md-9 ">
        <input type="number" class="form-control" id="txtEntregar" name="txtEntregar" placeholder="Entregar" readonly>
    </div>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }}">
<a class="btn btn-primary" href="{{ url('sinFacturar/')}}">Regresar</a>

<script>
    $(document).ready(function() {
        $('input:radio[name=radioPorcentaje]').change(function() {
            CalcularEntrega();
        });

        $('input:radio[name=radioSeguro]').change(function() {
            CalcularEntrega();
        });
    });

    function setPorcentage() {
        var porcentageChofer = $('#datalistChoferes').find("option[value='" + $('#chofer').val() + "']").attr('data-id');
        console.log(porcentageChofer);
        $("#porcentage" + porcentageChofer).prop('checked', true);
        CalcularEntrega();
    }

    function CalcularEntrega() {

        var toneladas = document.getElementById("toneladas").value;
        var precioPorTonelada = document.getElementById("precio").value;
        var porcentaje = $('input[name=radioPorcentaje]:checked').val();
        var seguro = $('input[name=radioSeguro]:checked').val();
        var transferencia = $("#txtTransferencia").val();
        var disel = $("#txtDisel").val();
        var porcentageChofer = $('#datalistChoferes').find("option[value='" + $('#chofer').val() + "']").attr('data-id');

        if (toneladas.length > 0 && precioPorTonelada.length > 0 && porcentageChofer != undefined) {

            var subtotal = (toneladas * precioPorTonelada) + (toneladas * seguro);
            var entregar = subtotal - subtotal * (porcentaje / 100);

            document.getElementById("txtSubTotal").value = subtotal.toFixed(2);
            document.getElementById("txtEntregar").value = entregar.toFixed(2) - transferencia - disel;

        } else {
            document.getElementById("txtSubTotal").value = "";
            document.getElementById("txtEntregar").value = "";
            // $("#porcentage0").prop('checked',true);
        }
    };
</script>