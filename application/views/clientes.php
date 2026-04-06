<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Clientes</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="p-4">

    <div class="container">

        <h3>Clientes</h3>

        <!-- FORM -->
        <input type="hidden" id="id">

        <div class="row mb-3">
            <div class="col">
                <input type="text" id="nombre" class="form-control" placeholder="Nombre">
            </div>
            <div class="col">
                <input type="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="col">
                <input type="text" id="dni" class="form-control" placeholder="DNI">
            </div>
            <div class="col">
                <select id="sexo" class="form-control">
                    <option value="">Sexo</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
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
                    <th>Email</th>
                    <th>DNI</th>
                    <th>Sexo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla"></tbody>
        </table>

    </div>

    <!-- JS -->
    <script src="http://localhost/ci3_proyecto/assets/js/clientes.js"></script>

</body>

</html>