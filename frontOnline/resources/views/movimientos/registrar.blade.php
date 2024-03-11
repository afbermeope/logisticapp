<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
  <div class="modal fade" id="codigoBarrasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opciones de Escaneo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkboxGorro">
                        <label class="form-check-label" for="checkboxGorro">Gorro</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkboxChaleco">
                        <label class="form-check-label" for="checkboxChaleco">Chaleco</label>
                    </div>
                    <div class="form-group mt-3">
                        <label for="textoOtro">Especifique (Otro):</label>
                        <input type="text" class="form-control" id="textoOtro" placeholder="Especifique...">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="escanearCodigoBarras()">Escanear</button>
            </div>
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
            <button class="btn btn-primary" id="escanearBtn" data-toggle="modal" data-target="#codigoBarrasModal">Escanear</button>
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

      document.getElementById('checkboxGorro').checked = true;
      document.getElementById('checkboxChaleco').checked = true;

      // Evento de escucha para el textarea
      document.getElementById('codigoBarrasInput').addEventListener('keydown', function (event) {
                if (event.key === 'Tab' || event.key === 'Enter') {
                    event.preventDefault(); // Evita el comportamiento por defecto del Tab o Enter
                    // Abre el modal
                    $('#codigoBarrasModal').modal('show');
                }
            });
    });
  </script>

  <script>
    function escanearCodigoBarras() {
      var codigoBarras = document.getElementById('codigoBarrasInput').value;
      // Obtener el estado de los checkboxes
      var checkboxGorro = document.getElementById('checkboxGorro').checked;
      var checkboxChaleco = document.getElementById('checkboxChaleco').checked;
      // Obtener el texto del campo "Otro"
      var textoOtro = document.getElementById('textoOtro').value;

      let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "{{URL::to('/cabecera/agregarMovimiento/')}}",
        type:"POST",
        data:{
          codigoBarras:codigoBarras,
          checkboxGorro:checkboxGorro,
          checkboxChaleco:checkboxChaleco,
          textoOtro:textoOtro,
          _token: _token
        },
        success:function(response){
          // console.log(response);
          alert("yay");
        },
      });
  };
</script>
</body>
</html>
