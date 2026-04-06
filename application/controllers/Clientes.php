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

        //  VALIDAR CAMPOS VACÍOS
        if (empty($data['dni']) || empty($data['email'])) {
            echo json_encode(["error" => "Campos obligatorios vacíos"]);
            return;
        }

        //  VALIDAR DNI (8 dígitos)
        if (!preg_match('/^\d{8}$/', $data['dni'])) {
            echo json_encode(["error" => "DNI debe tener 8 dígitos numéricos"]);
            return;
        }

        //  VALIDAR EMAIL
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["error" => "Email inválido"]);
            return;
        }

        //  VALIDAR DNI REPETIDO
        if ($this->Cliente_model->existeDni($data['dni'])) {
            if (empty($data['id'])) {
                echo json_encode(["error" => "DNI ya existe"]);
                return;
            }
        }

        // 🔥 VALIDAR EMAIL REPETIDO
        if ($this->Cliente_model->existeEmail($data['email'])) {
            if (empty($data['id'])) {
                echo json_encode(["error" => "Email ya existe"]);
                return;
            }
        }

        //  GUARDAR
        if (!empty($data['id'])) {
            $this->Cliente_model->actualizar($data);
        } else {
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