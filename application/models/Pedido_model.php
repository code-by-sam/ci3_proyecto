<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido_model extends CI_Model
{

    // 🔥 INSERTAR PEDIDO
    public function insertarPedido($cliente_id, $total)
    {
        $query = $this->db->query("CALL sp_pedido_insertar(?,?)", [
            $cliente_id,
            $total
        ]);

        $data = $query->row();

        mysqli_next_result($this->db->conn_id);

        return $data->pedido_id; // 🔥 devuelve el ID
    }


    // 🔥 INSERTAR DETALLE
    public function insertarDetalle($pedido_id, $producto_id, $cantidad, $precio)
    {
        $this->db->query("CALL sp_detalle_insertar(?,?,?,?)", [
            $pedido_id,
            $producto_id,
            $cantidad,
            $precio
        ]);

        mysqli_next_result($this->db->conn_id);
    }


    // 🔥 LISTAR PEDIDOS
    public function listar()
    {
        $query = $this->db->query("CALL sp_pedido_listar()");
        $data = $query->result();

        mysqli_next_result($this->db->conn_id);

        return $data;
    }


    // 🔥 DETALLE DE PEDIDO
    public function detalle($pedido_id)
    {
        $query = $this->db->query("CALL sp_pedido_detalle(?)", [
            $pedido_id
        ]);

        $data = $query->result();

        mysqli_next_result($this->db->conn_id);

        return $data;
    }
}