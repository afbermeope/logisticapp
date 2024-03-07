<table id="tarifas-table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Valor</th>
            <th>Hora</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cargo->tarifas as $tarifa)
            <tr>
                <td>{{ $tarifa->valor }}</td>
                <td>{{ $tarifa->hora }}</td>
                <td>
                    <button class="btn btn-danger" type="button" onClick="confirmDelete({{$tarifa->id}})">Eliminar</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

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