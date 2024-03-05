@include('mainbar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @include('messages')
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Personas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Personas</li>
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
                        <h3 class="card-title">Agrega a una persona</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->                
                    <form action="/persona" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="cedula">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese la cédula" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Email</label>
                                <input type="email" class="form-control" id="correo" name="correo">
                            </div>
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">Subir</button>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Lista de personas</h3>
                        </div>
                        <div class="card-body">
                            <table id="persona-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cédula</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($personas as $persona)
                                        <tr>
                                            <td>{{ $persona->nombre }}</td>
                                            <td>{{ $persona->cedula }}</td>
                                            <td>{{ $persona->telefono }}</td>
                                            <td>{{ $persona->correo }}</td>
                                            <td>
                                                <a href="/persona/{{$persona->id}}/edit" target="_blank">
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
      $("#persona-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": [
            {"extend": 'csvHtml5', 
            "exportOptions": {
                "columns": [ 0,1,2,3, ':visible' ]
            }}, 
            {"extend": 'excelHtml5', 
            "exportOptions": {
                "columns": [ 0,1,2,3, ':visible' ]
            }},{"extend": 'pdfHtml5', 
            "exportOptions": {
                "columns": [ 0,1,2,3, ':visible' ]
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
        
      }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
    });
  </script>


