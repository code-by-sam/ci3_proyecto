<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pedido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="p-4">

    <div class="container">

        <h3>Nuevo Pedido</h3>

        <!-- CLIENTE -->
        <select id="cliente" class="form-control mb-3"></select>

        <!-- PRODUCTO -->
        <div class="row mb-3">
            <div class="col">
                <select id="producto" class="form-control"></select>
            </div>
            <div class="col">
                <input type="number" id="cantidad" class="form-control" placeholder="Cantidad">
            </div>
            <div class="col">
                <button id="agregar" class="btn btn-success w-100">Agregar</button>
            </div>
        </div>

        <!-- DETALLE -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="detalle"></tbody>
        </table>

        <h4>Total: <span id="total">0</span></h4>

        <button id="guardarPedido" class="btn btn-primary">Guardar Pedido</button>
        <hr>

        <h4>Pedidos</h4>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla_pedidos"></tbody>
        </table>
    </div>

    <script src="http://localhost/ci3_proyecto/assets/js/pedidos.js"></script>

</body>

</html>