<?php

class Pedidos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pedido_model');
    }
    public function index()
    {
        $this->load->view('pedidos');
    }

    public function guardar()
    {
        $cliente_id = $this->input->post('cliente_id');
        $total = $this->input->post('total');
        $detalle = json_decode($this->input->post('detalle'), true);

        // 🔥 insertar pedido
        $pedido_id = $this->Pedido_model->insertarPedido($cliente_id, $total);

        // 🔥 insertar detalle
        foreach ($detalle as $d) {
            $this->Pedido_model->insertarDetalle(
                $pedido_id,
                $d['id'],
                $d['cantidad'],
                $d['precio']
            );
        }

        echo json_encode(["status" => "ok"]);
    }
    public function listar()
    {
        $data = $this->Pedido_model->listar();
        echo json_encode($data);
    }

    public function detalle($id)
    {
        $data = $this->Pedido_model->detalle($id);
        echo json_encode($data);
    }
}