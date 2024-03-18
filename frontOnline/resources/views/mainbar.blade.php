@include('main')
  <title>LogisticApp | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/AdminLTE/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/AdminLTE/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/AdminLTE/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/AdminLTE/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="/AdminLTE/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/AdminLTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="/AdminLTE/plugins/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="/AdminLTE/plugins/fullcalendar/main.css">

  <link rel="stylesheet" href="/AdminLTE/plugins/dropzone/min/dropzone.min.css">

  <link rel="stylesheet" href="/multiple-email-input/css/jquery.multi-emails.css">

  <style>
    .select2-container .select2-selection--single {
      box-sizing: border-box;
      cursor: pointer;
      display: block;
      height: 38px;
      user-select: none;
      -webkit-user-select: none;
    }

    .select2-selection__choice {
      color: black !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a class="nav-link">Hola {{Auth::user()->name}}</a>
        </li>

      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/home" class="brand-link">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8"> --}}
        <span class="brand-text font-weight-light"><img src="/Logo.png" alt="" style="width: 100%"></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-header">Menú</li>
            <li class="nav-item">
              <a href="/home" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/evento" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Eventos
                </p>
              </a>
            </li>
            <li class="nav-item">
                <a href="/cargo" class="nav-link">
                  <i class="nav-icon fas fa-id-card"></i>
                  <p>
                      Cargos
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/persona" class="nav-link">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                      Personas
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/cabecera" class="nav-link">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>Turnos
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/detalleTurno" class="nav-link">
                  <i class="nav-icon fa fa-compress"></i>
                  <p>
                      Personal Montaje/Desmontaje
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/movimiento" class="nav-link">
                  <i class="nav-icon fa fa-compress"></i>
                  <p>
                      Movimientos
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/db" class="nav-link">
                  <i class="nav-icon fa fa-database"></i>
                  <p>
                    Bases de datos
                  </p>
                </a>
              </li>
           
            <li class="nav-item">
              <a href="/logout" class="nav-link">
                <i class=" fas fa-sign-out-alt"></i>
                <p>
                  Cerrar sesión
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- jQuery -->
    <script src="/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- AdminLTE App -->
    <script src="/AdminLTE/dist/js/adminlte.js"></script>