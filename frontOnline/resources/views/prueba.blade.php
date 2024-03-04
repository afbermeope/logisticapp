<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba</title>
</head>
<body>
    <form action="/detalleTurno/" method="post" >
        @csrf
        <input type="text" name="cedula" id="cedula">
        <input type="submit" value="Subir">
    </form>
</body>
<script>
        window.onload = function() {
            // Tu código aquí se ejecutará cuando la página haya cargado completamente.
            document.getElementById("cedula").focus();

            // Puedes agregar cualquier lógica o funciones que desees ejecutar después de la carga completa.
        };
    </script>
</script>
</html>