@include('main')
    <title>LogisticApp | Dashboard</title>
    
      <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/AdminLTE/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/AdminLTE/dist/css/adminlte.min.css">

    <style>
        /* Estilos personalizados */
        body {
            background: linear-gradient(to right, #3494e6, #ec6ead);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #ff7b54;
            border-color: #ff7b54;
        }
    </style>
</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="codigoBarrasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="result">
            
        </div>
    </div>
</div>

<!-- Button trigger modal -->
    <!-- Contenido principal -->
    <div class="wrapper">
        <br><br><br>
        <div class="container text-center">
            <h2>Escaneo de Código de Barras</h2>
            <div class="form-group">
                <textarea class="form-control" rows="5" id="codigoBarrasInput" placeholder="Ingrese el código de barras"></textarea>
            </div>
            <button class="btn btn-primary" id="escanearBtn" data-toggle="modal" onclick="escanearCodigoBarras()">Escanear</button>
        </div>
    </div>
    <script src="/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/AdminLTE/dist/js/adminlte.js"></script>

    <script src="/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="/AdminLTE/plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/AdminLTE/dist/js/demo.js"></script>
   
   <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Selecciona automáticamente el textarea al cargar la página
      document.getElementById('codigoBarrasInput').select();

      // Evento de escucha para el textarea
      document.getElementById('codigoBarrasInput').addEventListener('keydown', function (event) {
                if (event.key === 'Tab' || event.key === 'Enter') {
                    event.preventDefault(); // Evita el comportamiento por defecto del Tab o Enter
                    // Abre el modal
                    escanearCodigoBarras();
                }
            });
    });
  </script>

<script>
  function escanearCodigoBarras() {
    var codigoBarras = document.getElementById('codigoBarrasInput').value;
    var evento_id = {{$evento_id}};
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: "{{URL::to('/cabecera/consultarCabeceras/')}}",
      type:"POST",
      data:{
        evento_id:evento_id,
        codigoBarras:codigoBarras,
        _token: _token
      },
      success:function(response){
          // alert(response);
          if(response) {
              $("#result").html(response); 
          }
        $('#codigoBarrasModal').modal('show');
      },
    });
};
</script>

<script>
  function agregarMovimiento($cabeceraId) {
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: "{{URL::to('/cabecera/agregarMovimiento/')}}",
      type:"POST",
      data:{
        cabeceraId:cabeceraId,
        _token: _token
      },
      success:function(response){
          // alert(response);
          if(response) {
              $("#result").html(response); 
          }
        $('#codigoBarrasModal').modal('show');
      },
    });
};
</script>


<script>
    function registrarElemento() {
      var codigoBarras = document.getElementById('codigoBarrasInput');
      var checkboxGorro = document.getElementById('checkboxGorro');
      var checkboxChaleco = document.getElementById('checkboxChaleco');
      var checkboxOtro = document.getElementById('checkboxOtro');
      var movimiento_id = document.getElementById('movimiento_id');
      var textoOtro = document.getElementById('textoOtro');
      let _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "{{URL::to('/elemento/')}}",
        type:"POST",
        data:{
            movimiento_id: movimiento_id ? movimiento_id.value : "",
            codigoBarras: codigoBarras ? codigoBarras.checked : false,
            checkboxGorro: checkboxGorro ? checkboxGorro.checked : false,
            checkboxChaleco: checkboxChaleco ? checkboxChaleco.checked : false,
            checkboxOtro: checkboxOtro ? checkboxOtro.checked : false,
            textoOtro: textoOtro ? textoOtro.value : "",
            _token: _token
        },
        success:function(response){
            if(response == "ok"){
                alert("Bienvenido");
                document.getElementById('codigoBarrasInput').value = "";
                recargar()
            }else{
              recargar()
            }
        },
      });
  };
</script>

<script>
  function limpiarCacheYRecargar() {
    // Limpiar la caché del navegador
    if (caches && caches.keys) {
        caches.keys().then(function (names) {
            names.forEach(function (name) {
                caches.delete(name);
            });
        });
    }
    // Recargar la página
    location.reload(true); // El parámetro true forza la recarga de la página desde el servidor, evitando el uso de la caché del navegador
}

</script>
<script>
  function recargar() {
    // Limpiar la caché del navegador
    document.getElementById("codigoBarrasInput").value = "";
    // Recargar la página
    location.reload(true); // El parámetro true forza la recarga de la página desde el servidor, evitando el uso de la caché del navegador
}
</body>
</html>
