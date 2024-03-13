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
    <div class="container">
        <h1>Seleccione un evento:</h1>
        <div class="row">
            @foreach ($eventos as $evento)
            <div class="wrapper col col-4">
                <div class="container text-center">
                    <h2>{{$evento->nombre}}</h2>
                    <a href="/registrarMovimiento/{{$evento->id}}"><button class="btn btn-primary">Seleccionar</button></a>
                </div>
            </div>
            @endforeach
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

</body>
</html>
