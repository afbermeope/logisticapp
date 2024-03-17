@include('mainbar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @include('messages')
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Movimientos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Movimientos</li>
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
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Movimientos</h3>
                        </div>
                        <div class="card-body">
                            <table id="cabecera-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Evento</th>
                                        <th>Zona</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Fecha creacion</th>
                                        <th>Dia del evento</th>
                                        <th>Tipo del movimiento</th>
                                        <th>Valor turno</th>
                                        <th>Elementos del movimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movimientos as $movimiento)
                                        <tr>
                                            <td>{{ $movimiento->detalleturno->cabecera->zona->evento->nombre ?? '' }}</td>
                                            <td>{{ $movimiento->detalleturno->cabecera->zona->nombre ?? '' }}</td>
                                            <td>{{ $movimiento->detalleturno->cabecera->persona->cedula ?? '' }}</td>
                                            <td>{{ $movimiento->detalleturno->cabecera->persona->nombre ?? '' }}</td>
                                            <td>{{ $movimiento->created_at ?? '' }}</td>
                                            <td>{{ $movimiento->detalleTurno->numero_dia ?? '' }}</td>
                                            <td>{{ $movimiento->descripcion ?? '' }}</td>
                                            <td>{{ $movimiento->descripcion == 'checkout' ? $movimiento->detalleturno->cabecera->tarifa->valor : '' }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($movimiento->elementos as $elemento)
                                                        <li>{{$elemento->nombre}}</li>
                                                    @endforeach
                                                </ul>
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
    </section>
</div>

<!-- jQuery -->
<script src="/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/AdminLTE/plugins/select2/js/select2.full.min.js"></script>
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
    $(function () {
        //Initialize Select2 Elements

        $('.select2').select2();
    })
</script>

<script>
    function getZonas(){
          var evento  = document.getElementById("evento_id");
          var evento_id = evento.options[evento.selectedIndex].value;
          var sel = document.getElementById('zona_id');
          var length = sel.options.length;
          //Block the select while get cities
          sel.readOnly = true;
          //Delete all previous options
          if (length >0){
              for (i = length-1; i >= 0; i--) {
                  sel.removeChild( sel.options[i]); 
              }
          }
          $.ajax({
              url: "{{URL::to('/evento/getZonas/')}}"+"/"+evento_id,
              type:"GET",
              success:function(response){
                  if(response) {  

                      var opt = document.createElement('option');
                      opt.appendChild( document.createTextNode("Seleccione") );
                      opt.value = ""; 
                      sel.appendChild(opt); 

                      $.each(response,function(index,value){
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode(value['nombre']) );
                          opt.value = value['id']; 
                          sel.appendChild(opt); 
                      });
  
                  }
              },
          });
          //Unlock the select input
          sel.readOnly = false;
      }
</script>

<script>
    function getTarifas(){
          var cargo  = document.getElementById("cargo_id");
          var cargo_id = cargo.options[cargo.selectedIndex].value;
          var sel = document.getElementById('tarifa_id');
          var length = sel.options.length;
          sel.readOnly = true;
          //Delete all previous options
          if (length >0){
              for (i = length-1; i >= 0; i--) {
                  sel.removeChild( sel.options[i]); 
              }
          }
          $.ajax({
              url: "{{URL::to('/cargo/getTarifas/')}}"+"/"+cargo_id,
              type:"GET",
              success:function(response){
                  if(response) {  

                      var opt = document.createElement('option');
                      opt.appendChild( document.createTextNode("Seleccione") );
                      opt.value = ""; 
                      sel.appendChild(opt); 

                      $.each(response,function(index,value){
                          var opt = document.createElement('option');
                          opt.appendChild( document.createTextNode("$" + value['valor']+ " x " + value['hora']) );
                          opt.value = value['id']; 
                          sel.appendChild(opt); 
                      });
  
                  }
              },
          });
          //Unlock the select input
          sel.readOnly = false;
      }
</script>

<script>
    $(function () {
      $("#cabecera-table").DataTable({
        "responsive": true, "autoWidth": false,
        "lengthMenu": [ 25, 50, 75, "All" ],
        "buttons": [
            {"extend": 'csvHtml5', 
            "exportOptions": {
                "columns": [ 0,1,2,3,4, ':visible' ]
            }}, 
            {"extend": 'excelHtml5', 
            "exportOptions": {
                "columns": [ 0,1,2,3,4, ':visible' ]
            }},{"extend": 'pdfHtml5', 
            "exportOptions": {
                "columns": [ 0,1,2,3,4, ':visible' ]
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
        
      }).buttons().container().appendTo('#cabecera-table_wrapper .col-md-6:eq(0)');
    });
  </script>


