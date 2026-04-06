$(document).ready(function () {
	listar();

	// GUARDAR
	$("#guardar").click(function () {
		let data = {
			id: $("#id").val(),
			nombre: $("#nombre").val(),
			precio: $("#precio").val(),
		};

		$.post(
			"http://localhost/ci3_proyecto/index.php/productos/guardar",
			data,
			function () {
				limpiar();
				listar();
			},
		);
	});
});

// LISTAR
function listar() {
	$.get(
		"http://localhost/ci3_proyecto/index.php/productos/listar",
		function (res) {
			let datos = JSON.parse(res);
			let html = "";

			datos.forEach((c) => {
				html += `
                <tr>
                    <td>${c.id}</td>
                    <td>${c.nombre}</td>
                    <td>${c.precio}</td>
                    <td>
                        <button onclick="editar(${c.id},'${c.nombre}','${c.precio}')"
                        class="btn btn-warning btn-sm">Editar</button>
                        <button onclick="eliminar(${c.id})" 
                        class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                    
                </tr>
            `;
			});

			$("#tabla").html(html);
		},
	);
}

//ELIMINAR-CAMBIAR ESTADO
function eliminar(id) {
	if (confirm("¿Eliminar producto?")) {
		$.get(
			"http://localhost/ci3_proyecto/index.php/productos/eliminar/" + id,
			function () {
				listar();
			},
		);
	}
}

// EDITAR
function editar(id, nombre, precio) {
	console.log("EDITANDO ID:", id); // 👈 prueba
	$("#id").val(id);
	$("#nombre").val(nombre);
	$("#precio").val(precio);
}

// LIMPIAR
function limpiar() {
	$("#id").val("");
	$("#nombre").val("");
	$("#precio").val("");
}
