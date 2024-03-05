<table id="zonas-table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($zonas as $zona)
            <tr>
                <td>{{ $zona->nombre }}</td>
                <td>
                    <button class="btn btn-danger" type="button" onClick="confirmDelete({{$zona->id}})">Eliminar</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>