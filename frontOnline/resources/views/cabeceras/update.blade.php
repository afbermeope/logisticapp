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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Editar</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->                
                    <form action="{{ route('cabecera.update',$cabecera->id) }}" method="POST" role="form">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body row">
                            <div class="form-group col-md-4">
                                <label for="persona_id">Personal</label>
                                <select class="select2" style="width: 100%;" name="persona_id" id="persona_id" required>
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id }}" {{ $persona->id == $cabecera->persona->id ? 'selected' : '' }}>
                                            {{ $persona->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="evento_id">Evento</label>
                                <select class="select2" style="width: 100%;" name="evento_id" id="evento_id" required onChange="getZonas()">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($eventos as $evento)
                                        <option value="{{ $evento->id }}" {{ $evento->id == $cabecera->zona->evento->id ? 'selected' : '' }}>
                                            {{ $evento->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="form-group col-md-4">
                                <label for="zona_id">Zona</label>
                                <select class=" select2" style="width: 100%;" name="zona_id" id="zona_id" required> 
                                    <option value="{{$cabecera->zona->id}}" selected>{{$cabecera->zona->nombre}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cargo_id">Cargo</label>
                                <select class="select2" style="width: 100%;" name="cargo_id" id="cargo_id" required onChange="getTarifas()">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}" {{ $cargo->id == $cabecera->tarifa->cargo->id ? 'selected' : '' }}>
                                            {{ $cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="form-group col-md-4">
                                <label for="tarifa_id">Tarifa</label>
                                <select class=" select2" style="width: 100%;" name="tarifa_id" id="tarifa_id" required> 
                                    <option value="{{$cabecera->tarifa->id}}" selected>${{$cabecera->tarifa->valor}} - {{$cabecera->tarifa->hora}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="hora_inicio">Hora inicio</label>
                                <br>
                                <input type="time" name="hora_inicio" id="hora_inicio" required value="{{ substr($cabecera->horario, 0, 5) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="hora_fin">Hora fin</label>
                                <br>
                                <input type="time" name="hora_fin" id="hora_fin" required value="{{ substr($cabecera->horario, -5) }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">Subir</button>
                        </div>
                    </form>
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

