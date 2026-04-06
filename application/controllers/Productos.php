<?php

// Evita acceso directo al archivo por URL (seguridad de CodeIgniter)
defined('BASEPATH') OR exit('No direct script access allowed');

// Definimos el controlador Productos
class Productos extends CI_Controller
{

    // Constructor: se ejecuta siempre al instanciar el controlador
    public function __construct()
    {
        // Llama al constructor padre (CI_Controller)
        parent::__construct();

        // Carga el modelo Producto_model para poder usarlo aquí
        $this->load->model('Producto_model');
    }

    // Método por defecto (cuando entras a /productos)
    public function index()
    {
        // Carga la vista llamada 'productos.php'
        $this->load->view('productos');
    }

    // Método para LISTAR productos (SELECT)
    public function listar()
    {
        // Llama al modelo para obtener los datos de la BD
        $data = $this->Producto_model->listar();

        // Convierte los datos a JSON para enviarlos al frontend (AJAX)
        echo json_encode($data);
    }

    // Método para GUARDAR (INSERT o UPDATE)
    public function guardar()
    {
        // Obtiene todos los datos enviados por POST (AJAX)
        $data = $this->input->post();

        // Verifica si existe el ID
        if (isset($data['id']) && $data['id'] != "") {

            // 🔥 Si hay ID → ACTUALIZAR
            $this->Producto_model->actualizar($data);

        } else {

            // 🔥 Si NO hay ID → INSERTAR
            $this->Producto_model->insertar($data);
        }

        // Devuelve respuesta al frontend
        echo json_encode(["status" => "ok"]);
    }

    // Método para ELIMINAR (en realidad es cambio de estado)
    public function eliminar($id)
    {
        // Llama al modelo para eliminar (o cambiar estado)
        $this->Producto_model->eliminar($id);

        // Respuesta al frontend (AJAX)
        echo json_encode(["status" => "ok"]);
    }
}