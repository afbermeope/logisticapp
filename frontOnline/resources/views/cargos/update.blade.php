

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
            <h1 class="m-0">Cargo {{$cargo->nombre}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Cargo {{$cargo->nombre}}</li>
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
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Agrega a un cargo</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->                
                    <form action="{{ route('cargo.update',$cargo->id) }}" method="POST" role="form">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group col-md-4">
                                <label for="nombre_cargo">Nombre</label>
                                <input type="text" class="form-control" id="nombre_cargo" name="nombre_cargo" placeholder="Ingrese el nombre" required value="{{$cargo->nombre}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="evento_id">Evento</label>
                                <select class="select2" style="width: 100%;" name="evento_id" id="evento_id" required onChange="getZonas()">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($eventos as $evento)
                                        <option value="{{ $evento->id }}" {{ $evento->id == $cargo->evento->id ? 'selected' : '' }}>
                                            {{ $evento->nombre }}
                                        </option>
                                    @endforeach
                                </select>
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
                        <h3 class="card-title">Agregar tarifas al cargo {{$cargo->nombre}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="agregarTarifa">
                        @csrf
                        <input name="cargo_id" id="cargo_id" type="hidden" value="{{$cargo->id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="numeric" class="form-control" id="valor" name="valor" placeholder="Ingrese el valor de la tarifa" required>
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input type="numeric" class="form-control" id="hora" name="hora" placeholder="Hora de la tarifa" required>
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
                            <h3 class="card-title">Tarifas agregadas</h3>
                        </div>
                        <div class="card-body">
                            <div id="result"  class="col-md-12">
                                <table id="tarifas-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Hora</th>
                                            <th>Valor</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cargo->tarifas as $tarifa)
                                            <tr>
                                                <td>{{ $tarifa->hora }}</td>
                                                <td>{{ $tarifa->valor }}</td>
                                                <td>
                                                    <button class="btn btn-danger" type="button" onClick="confirmDelete({{$tarifa->id}})">Eliminar</button>
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

<script>
    $(function () {
        //Initialize Select2 Elements

        $('.select2').select2();
    })
</script>
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
<script src="/AdminLTE/plugins/select2/js/select2.full.min.js"></script>


<script type="text/javascript">
    
    $("#agregarTarifa").submit(function(event){
        event.preventDefault();
      
        let valor = $("input[name=valor]").val();
        let hora = $("input[name=hora]").val();
        let cargo_id = $("input[name=cargo_id]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
  
        $.ajax({
          url: "{{URL::to('/cargos/agregarTarifa/')}}",
          type:"POST",
          data:{
            valor:valor,
            hora:hora,
            cargo_id:cargo_id,
            _token: _token
          },
          success:function(response){
            document.getElementById('valor').value = "";
            document.getElementById('hora').value = "";
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
          let cargo_id = $("input[name=cargo_id]").val();
          $.ajax({
              url: "{{URL::to('/tarifa/')}}"+"/"+id,
              type: "POST",
              data: {
                  _method: 'delete',
                  _token: _token,
                  cargo_id: {{$cargo->id}},
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
      $("#tarifas-table").DataTable({
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


