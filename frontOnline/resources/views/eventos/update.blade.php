

@include('mainbar')
<style>
    .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 38px;
    user-select: none;
    -webkit-user-select: none;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @include('messages')
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Evento {{$evento->nobmre}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Evento {{$evento->nombre}}</li>
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
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Agrega a un evento</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->                
                    <form action="{{ route('evento.update',$evento->id) }}" method="POST" role="form">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Ingrese el nombre" required value="{{$evento->nombre}}">
                            </div>
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required value="{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d') }}">                            </div>
                            <div class="form-group">
                                <label for="fecha_fin">Fecha fin</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required value="{{ \Carbon\Carbon::parse($evento->fecha_fin)->format('Y-m-d') }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">Subir</button>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Agregar zonas al evento {{$evento->nombre}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="agregarZona">
                        @csrf
                        <input name="evento_id" id="evento_id" type="hidden" value="{{$evento->id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la zona" required>
                            </div>
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">Subir</button>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Zonas agregadas</h3>
                        </div>
                        <div class="card-body">
                            <div id="result"  class="col-md-12">
                                <table id="zonas-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evento->zonas as $zona)
                                            <tr>
                                                <td>{{ $zona->nombre }}</td>
                                                <td>
                                                    <button class="btn btn-danger" type="button" onClick="confirmDelete({{$zona->id}})">Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
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

<!-- Date time picker  & Plugins -->
<script src="/AdminLTE/plugins/moment/moment.min.js"></script>
<script src="/AdminLTE/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="/AdminLTE/plugins/select2/js/select2.full.min.js"></script>
<script src="/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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


<script type="text/javascript">
    
    $("#agregarZona").submit(function(event){
        event.preventDefault();
      
        let nombre = $("input[name=nombre]").val();
        let evento_id = $("input[name=evento_id]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
  
        $.ajax({
          url: "{{URL::to('/eventos/agregarZona/')}}",
          type:"POST",
          data:{
            nombre:nombre,
            evento_id:evento_id,
            _token: _token
          },
          success:function(response){
            document.getElementById('nombre').value = "";
            // console.log(response);
            if(response) {
              $("#result").html(response); 
            }
          },
         });
    });
</script>

<script>
  function confirmDelete(id){
      if (confirm("Estas seguro de eliminar") == true) {
          let _token   = $('meta[name="csrf-token"]').attr('content');
          let evento_id = $("input[name=evento_id]").val();
          $.ajax({
              url: "{{URL::to('/zona/')}}"+"/"+id,
              type: "POST",
              data: {
                  _method: 'delete',
                  _token: _token,
                  evento_id: {{$evento->id}},
                  action: 'delete'
              },
              success:function(response){
                  if(response) {
                      $("#result").html(response); 
                  }
              },
          });
      } 

  }
</script>

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
  </script>

<script>
    $(function () {

      //Date picker
      $('#reservationdate').datetimepicker({
          format: 'D/M/yy'
      });
    })
 </script>


<script>
    $(function () {
      $("#zonas-table").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": true,
        "buttons": [
            {"extend": 'csvHtml5', 
            "exportOptions": {
                "columns": [ 0,1, ':visible' ]
            }}, 
            {"extend": 'excelHtml5', 
            "exportOptions": {
                "columns": [ 0,1, ':visible' ]
            }},{"extend": 'pdfHtml5', 
            "exportOptions": {
                "columns": [ 0,1, ':visible' ]
            }}, "colvis" ],
        "language": {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },     
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
            },
        },
        
      }).buttons().container().appendTo('#theme-table_wrapper .col-md-6:eq(0)');
    });

  </script>


