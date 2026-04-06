let detalle = [];
let total = 0;

$(document).ready(function () {
	cargarClientes();
	cargarProductos();
	listarPedidos();

	// AGREGAR PRODUCTO
	$("#agregar").click(function () {
		let id = $("#producto").val();
		let nombre = $("#producto option:selected").text();
		let precio = $("#producto option:selected").data("precio");
		let cantidad = $("#cantidad").val();

		let subtotal = precio * cantidad;

		detalle.push({ id, nombre, precio, cantidad, subtotal });

		total += subtotal;

		pintarDetalle();
	});

	// GUARDAR PEDIDO
	$("#guardarPedido").click(function () {
		let cliente_id = $("#cliente").val();

		$.post(
			"http://localhost/ci3_proyecto/index.php/pedidos/guardar",
			{
				cliente_id: cliente_id,
				total: total,
				detalle: JSON.stringify(detalle),
			},
			function () {
				alert("Pedido guardado");
				location.reload();
			},
		);
	});
});

// CARGAR CLIENTES
function cargarClientes() {
	$.get(
		"http://localhost/ci3_proyecto/index.php/clientes/listar",
		function (res) {
			console.log("CLIENTES:", res);
			let data = JSON.parse(res);

			let html = "";
			data.forEach((c) => {
				html += `<option value="${c.id}">${c.nombre}</option>`;
			});

			$("#cliente").html(html);
		},
	);
}

// CARGAR PRODUCTOS
function cargarProductos() {
	$.get(
		"http://localhost/ci3_proyecto/index.php/productos/listar",
		function (res) {
			let data = JSON.parse(res);

			let html = "";
			data.forEach((p) => {
				html += `<option value="${p.id}" data-precio="${p.precio}">${p.nombre}</option>`;
			});

			$("#producto").html(html);
		},
	);
}
function listarPedidos() {
	console.log("listarPedidos funcionando"); // 👈 prueba

	$.get(
		"http://localhost/ci3_proyecto/index.php/pedidos/listar",
		function (res) {
			let data = JSON.parse(res);
			let html = "";

			data.forEach((p) => {
				html += `
                <tr>
                    <td>${p.id}</td>
                    <td>${p.cliente}</td>
                    <td>${p.fecha}</td>
                    <td>${p.total}</td>
                    <td>
                        <button onclick="verDetalle(${p.id})" 
                        class="btn btn-info btn-sm">Ver</button>
                    </td>
                </tr>

                <tr id="detalle_${p.id}" style="display:none;">
                    <td colspan="5">
                        <table class="table">
                            <tbody id="contenido_${p.id}"></tbody>
                        </table>
                    </td>
                </tr>
            `;
			});

			$("#tabla_pedidos").html(html);
		},
	);
}

// PINTAR DETALLE
function pintarDetalle() {
	let html = "";

	detalle.forEach((d) => {
		html += `
            <tr>
                <td>${d.nombre}</td>
                <td>${d.cantidad}</td>
                <td>${d.precio}</td>
                <td>${d.subtotal}</td>
            </tr>
        `;
	});

	$("#detalle").html(html);
	$("#total").text(total);
}

function verDetalle(id) {
	let fila = $("#detalle_" + id);

	// toggle (mostrar / ocultar)
	if (fila.is(":visible")) {
		fila.hide();
		return;
	}

	$.get(
		"http://localhost/ci3_proyecto/index.php/pedidos/detalle/" + id,
		function (res) {
			let data = JSON.parse(res);
			let html = "";

			data.forEach((d) => {
				html += `
                <tr>
                    <td>${d.producto}</td>
                    <td>${d.cantidad}</td>
                    <td>${d.precio}</td>
                    <td>${d.subtotal}</td>
                </tr>
            `;
			});

			$("#contenido_" + id).html(html);
			fila.show();
		},
	);
}
