$(document).ready(function () {
	listar();

	// GUARDAR
	$("#guardar").click(function () {
		let data = {
			id: $("#id").val(),
			nombre: $("#nombre").val(),
			email: $("#email").val(),
			dni: $("#dni").val(),
			sexo: $("#sexo").val(),
		};
		let dni = data.dni;

		//  VALIDACIÓNES DNI
		if (data.dni.trim() === "") {
			alert("El DNI es obligatorio");
			$("#dni").focus();
			return; //
		}

		if (data.email.trim() === "") {
			alert("El email es obligatorio");
			$("#email").focus();
			return; //
		}

		// 🔥 SOLO NÚMEROS Y 8 DÍGITOS
		if (!/^\d{8}$/.test(dni)) {
			alert("El DNI debe tener exactamente 8 dígitos y solo números");
			$("#dni").focus();
			return;
		}

		$.post(
			"http://localhost/ci3_proyecto/index.php/clientes/guardar",
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
		"http://localhost/ci3_proyecto/index.php/clientes/listar",
		function (res) {
			let datos = JSON.parse(res);
			let html = "";

			datos.forEach((c) => {
				html += `
                <tr>
                    <td>${c.id}</td>
                    <td>${c.nombre}</td>
                    <td>${c.email}</td>
                    <td>${c.dni}</td>
                    <td>${c.sexo}</td>
                    <td>
                        <button onclick="editar(${c.id},'${c.nombre}','${c.email}','${c.dni}','${c.sexo}')"
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
	if (confirm("¿Eliminar cliente?")) {
		$.get(
			"http://localhost/ci3_proyecto/index.php/clientes/eliminar/" + id,
			function () {
				listar();
			},
		);
	}
}

// EDITAR
function editar(id, nombre, email, dni, sexo) {
	$("#id").val(id);
	$("#nombre").val(nombre);
	$("#email").val(email);
	$("#dni").val(dni);
	$("#sexo").val(sexo);
}

// LIMPIAR
function limpiar() {
	$("#id").val("");
	$("#nombre").val("");
	$("#email").val("");
	$("#dni").val("");
	$("#sexo").val("");
}
