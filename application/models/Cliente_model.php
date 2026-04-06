<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model
{

    public function listar()
    {
        $query = $this->db->query("CALL sp_cliente_listar()");
        return $query->result();
    }

    public function insertar($data)
    {
        $this->db->query("CALL sp_cliente_insertar(?,?,?,?)", [
            $data['nombre'],
            $data['email'],
            $data['dni'],
            $data['sexo']
        ]);
    }

    // 🔥 ESTE TE FALTABA
    public function actualizar($data)
    {
        $query = $this->db->query("CALL sp_cliente_actualizar(?,?,?,?,?)", [
            $data['id'],
            $data['nombre'],
            $data['email'],
            $data['dni'],
            $data['sexo']
        ]);


    }

    public function eliminar($id)
    {
        $this->db->query("CALL sp_cliente_eliminar(?)", [$id]);

    }

    public function existeDni($dni)
    {
        $query = $this->db->query("SELECT * FROM cliente WHERE dni = ?", [$dni]);
        return $query->num_rows() > 0;
    }

    public function existeEmail($email)
    {
        $query = $this->db->query("SELECT * FROM cliente WHERE email = ?", [$email]);
        return $query->num_rows() > 0;
    }
}