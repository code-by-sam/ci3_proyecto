<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Productos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="p-4">

    <div class="container">

        <h3>Productos</h3>

        <!-- FORM -->
        <input type="hidden" id="id">

        <div class="row mb-3">
            <div class="col">
                <input type="text" id="nombre" class="form-control" placeholder="Nombre">
            </div>
            <div class="col">
                <input type="number" step="0.01" id="precio" class="form-control" placeholder="Precio">
            </div>

            <div class="col">
                <button id="guardar" class="btn btn-primary w-100">Guardar</button>
            </div>
        </div>

        <!-- TABLA -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla"></tbody>
        </table>

    </div>

    <!-- JS -->
    <script src="http://localhost/ci3_proyecto/assets/js/productos.js"></script>

</body>

</html>