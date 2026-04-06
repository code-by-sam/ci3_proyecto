<?php

// Evita acceso directo al archivo (seguridad de CodeIgniter)
defined('BASEPATH') OR exit('No direct script access allowed');

// Definimos el modelo Producto_model
class Producto_model extends CI_Model
{

    // 🔥 MÉTODO: LISTAR PRODUCTOS
    public function listar()
    {
        // Ejecuta el procedimiento almacenado
        $query = $this->db->query("CALL sp_producto_listar()");

        // Devuelve los resultados como objetos
        return $query->result();
    }

    // 🔥 MÉTODO: INSERTAR PRODUCTO
    public function insertar($data)
    {
        // Ejecuta el SP de insertar
        // Se pasan los parámetros (nombre, precio)
        $this->db->query("CALL sp_producto_insertar(?,?)", [
            $data['nombre'],  // nombre del producto
            $data['precio']   // precio del producto
        ]);
    }

    // 🔥 MÉTODO: ACTUALIZAR PRODUCTO
    public function actualizar($data)
    {
        // Ejecuta el SP de actualizar
        // Se pasan (id, nombre, precio)
        $query = $this->db->query("CALL sp_producto_actualizar(?,?,?)", [
            $data['id'],      // ID del producto a actualizar
            $data['nombre'],  // nuevo nombre
            $data['precio']   // nuevo precio
        ]);
    }

    // 🔥 MÉTODO: ELIMINAR PRODUCTO (CAMBIAR ESTADO)
    public function eliminar($id)
    {
        // Ejecuta el SP para eliminar (normalmente cambia estado a 0)
        $this->db->query("CALL sp_producto_eliminar(?)", [$id]);
    }
}