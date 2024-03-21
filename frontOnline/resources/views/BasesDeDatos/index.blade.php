@include('mainbar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @include('messages')
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bases de datos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Bases de datos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <!-- Main row -->
            <div class="row">
              <div class="col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">    
                    <h2>Bajar información al servidor en la nube</h2>
                    <p>Presiona continuar para descargar la informacion de la nube en tu servidor local</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-arrow-down-c"></i>
                  </div>
                  <a onclick="confirmarBajada()" class="small-box-footer">Continuar <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h2>Subir la información a la nube</h2>
    
                    <p>Presiona continuar para agregar a la información en la nube los datos de tu servidor local</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-arrow-up-c"></i>
                  </div>
                  <a onclick="confirmarSubida()" class="small-box-footer">Continuar <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>

  function confirmarBajada() {
    // Mostrar el cuadro de diálogo y guardar la respuesta del usuario
    var respuesta = window.confirm("¿Estás seguro de realizar esta acción, debe estar conectado a internet?");
      
    // Verificar si el usuario hizo clic en "Aceptar"
    if (respuesta) {
      $.ajax({
          url: "{{URL::to('/db/bajarInformacion/')}}",
          type:"GET",
          success:function(response){
              if(response) {  
                console.log(response);
                alert("Bajado correctamente");

              }
          },
      });
    }
  }

</script>
<script>
  function confirmarSubida(params) {
    // Mostrar el cuadro de diálogo y guardar la respuesta del usuario
    var respuesta = window.confirm("¿Estás seguro de realizar esta acción, debe estar conectado a internet?");
    // Verificar si el usuario hizo clic en "Aceptar"
    if (respuesta) {
      $.ajax({
          url: "{{URL::to('/db/enviarInformacionServer/')}}",
          type:"GET",
          success:function(response){
              if(response) {  
                alert("subido correctamente");
              }
          },
      });
    }
  }
</script>
<script>
  
</script>
<script>
  
</script>