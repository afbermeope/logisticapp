<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Seleccione el turno a registrar de {{$persona->nombre}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @foreach($cabeceras as $cabecera)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cabecera_id" value="{{$cabecera->id}}" onclick="guardarValor(this)">
            <label class="form-check-label" for="checkboxGorro">{{$cabecera->horario}} - {{$cabecera->zona->nombre}} - {{$cabecera->cargo->nombre}}</label>
        </div>
    @endforeach
</div>
<div class="modal-footer">
    <button type="button" id="botonSiguiente" class="btn btn-primary" onclick="agregarMovimiento(cabeceraId)" disabled>Siguiente</button>
</div>

<script>
    var cabeceraId;

    function guardarValor(radio) {
        cabeceraId = radio.value;
        // Habilitar el botón "Siguiente" ya que se ha seleccionado un radio button
        var botonSiguiente = document.getElementById('botonSiguiente');
        botonSiguiente.disabled = false;
    }
</script>