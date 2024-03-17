@include('mainbar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @include('messages')
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Personal / Evento</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Eventos</li>
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
                        <h3 class="card-title">Vincula al personal a un evento</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->                
                    <form action="/cabecera" method="POST">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-md-4">
                                <label for="persona_id">Personal</label>
                                <select class=" select2" style="width: 100%;" name="persona_id" id="persona_id" required>
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{$persona->id}}">{{$persona->nombre}} - {{$persona->cedula}}</option>
                                    @endforeach
                                </select>    
                            </div>
                            <div class="form-group col-md-4">
                                <label for="evento_id">Evento</label>
                                <select class=" select2" style="width: 100%;" name="evento_id" id="evento_id" required onChange="getZonas()">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($eventos as $evento)
                                        <option value="{{$evento->id}}">{{$evento->nombre}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="form-group col-md-4">
                                <label for="zona_id">Zona</label>
                                <select class=" select2" style="width: 100%;" name="zona_id" id="zona_id" required> 
                                    <option value="">Selecciona</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cargo_id">Cargo</label>
                                <select class=" select2" style="width: 100%;" name="cargo_id" id="cargo_id" required onChange="getTarifas()">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tarifa_id">Tarifa</label>
                                <select class=" select2" style="width: 100%;" name="tarifa_id" id="tarifa_id" required> 
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="hora_inicio">Hora inicio</label>
                                <br>
                                <input type="time" name="hora_inicio" id="hora_inicio" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="hora_fin">Hora fin</label>
                                <br>
                                <input type="time" name="hora_fin" id="hora_fin" required>
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
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">O sube un archivo plano<h3>
                        </div>
                        <div class="card-body row">
                            <form action="/cabecera/subirExcel" method="post" enctype="multipart/form-data">
                                @csrf <!-- Asegúrate de incluir el token CSRF si estás utilizando Laravel -->
                            
                                <label for="archivo_excel">Selecciona un archivo Excel:</label>
                                <input type="file" id="archivo_excel" name="archivo_excel" accept=".xlsx">
                            
                                <button type="submit">Subir Archivo</button>
                            </form>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Lista de usuarios</h3>
                        </div>
                        <div class="card-body">
                            <table id="cabecera-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Persona</th>
                                        <th>Evento</th>
                                        <th>Zona</th>
                                        <th>Horario</th>
                                        <th>Cargo</th>
                                        <th>Valor tarifa</th>
                                        <th>Valor hora</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cabeceras as $cabecera)
                                        <tr>
                                            <td>{{ $cabecera->persona->nombre ?? '' }} - {{ $cabecera->persona->cedula ?? ''}}</td>
                                            <td>{{ $cabecera->zona->evento->nombre ?? ''}}</td>
                                            <td>{{ $cabecera->zona->nombre ?? ''}}</td>
                                            <td>{{ $cabecera->horario ?? ''}}</td>
                                            <td>{{ $cabecera->tarifa->cargo->nombre ?? ''}}</td>
                                            <td>{{ $cabecera->tarifa->valor ?? ''}}</td>
                                            <td>{{ $cabecera->tarifa->hora ?? ''}}</td>
                                            <td>
                                                <a href="/cabecera/{{$cabecera->id}}/edit" target="_blank">
                                                    <button class="btn btn-secondary" type="button">Editar</button>
                                                </a>
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
        "responsive": true, "lengthChange": false, "autoWidth": false,
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


