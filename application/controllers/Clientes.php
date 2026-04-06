<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cliente_model');
    }
    public function index()
    {
        $this->load->view('clientes');

    }

    public function listar()
    {
        $data = $this->Cliente_model->listar();
        echo json_encode($data);
    }

    public function guardar()
    {
        $data = $this->input->post();

        //  VALIDAR DNI REPETIDO
        if ($this->Cliente_model->existeDni($data['dni'])) {

            // SI ESTÁS EDITANDO, permite el mismo DNI
            if (!isset($data['id']) || $data['id'] == "") {
                echo json_encode(["error" => "DNI ya existe"]);
                return;
            }
        }

        // 🔥 VALIDAR EMAIL REPETIDO
        if ($this->Cliente_model->existeEmail($data['email'])) {

            // SI ESTÁS EDITANDO, permite el mismo email
            if (!isset($data['id']) || $data['id'] == "") {
                echo json_encode(["error" => "Email ya existe"]);
                return;
            }
        }

        //  AQUÍ YA VALIDADO → AHORA SÍ GUARDAS
        if (isset($data['id']) && $data['id'] != "") {
            // UPDATE
            $this->Cliente_model->actualizar($data);
        } else {
            // INSERT
            $this->Cliente_model->insertar($data);
        }

        echo json_encode(["status" => "ok"]);
    }
    public function eliminar($id)
    {
        $this->Cliente_model->eliminar($id);
        echo json_encode(["status" => "ok"]);
    }


}