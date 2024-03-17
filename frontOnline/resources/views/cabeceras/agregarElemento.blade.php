
@if($movimiento->descripcion == 'checkin' )
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar ingreso de elementos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="movimiento_id" id="movimiento_id" value="{{$movimiento->id}}">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="checkboxGorro">
            <label class="form-check-label" for="checkboxGorro">Gorro</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="checkboxChaleco">
            <label class="form-check-label" for="checkboxChaleco">Chaleco</label>
        </div>
        <div class="form-group mt-3">
            <label for="textoOtro">Especifique (Otro):</label>
            <input type="text" class="form-control" id="textoOtro" placeholder="Especifique...">
        </div>
@else
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar salida de elementos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    @if($elementos->count() == 0)
        Esta persona no registró ningun elemento, pulse cerrar para salir
    @endif
    @foreach ($elementos as $elemento)
        <input type="hidden" name="movimiento_id" id="movimiento_id" value="{{$movimiento->id}}">
        @if($elemento->nombre == "gorro")
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="checkboxGorro" required>
                <label class="form-check-label" for="checkboxGorro">Gorro</label>
            </div>
        @elseif($elemento->nombre == "chaleco")
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="checkboxChaleco" required>
                <label class="form-check-label" for="checkboxChaleco">Chaleco</label>
            </div>
        @elseif($elemento->nombre != null)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="checkboxOtro" required>
                <label class="form-check-label" for="checkboxOtro">{{$elemento->nombre}}</label>
            </div>
        @endif
    @endforeach
@endif
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarCacheYRecargar()">Cerrar</button>
        @if($elementos->count() >= 1)
            <button type="button" class="btn btn-primary" onclick="registrarElemento()">Guardar</button>
        @endif
    </div>