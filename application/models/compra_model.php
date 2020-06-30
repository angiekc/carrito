<?php
defined('BASEPATH') or exit('No direct script access allowed');

class usuario_model extends CI_Model

{
	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	public function listarCategoria()
	{
		return $this->db
			->select('id_categoria, nombre_categoria')
			->from('categoria')
			->get()
			->result();
	}
	public function insertar($data)
	{
		$this->db->insert('productos', array(
			'titulo' => $data['titulo'],
			'descripcion' => $data['descripcion'],
			'precio' => $data['precio'],
			'imagen' => $data['imagen'],

		));
	}
	public function modificar($data)
	{
		$this->db->where('id_producto', $data['id_producto']);
		$this->db->update('productos', array(
			'titulo' => $data['titulo'],
			'descripcion' => $data['descripcion'],
			'precio' => $data['precio'],
			'imagen' => date('imagen'),
		));
	}
	public function listar()
	{
		return $this->db->select('t.id_producto, t.nombre, t.descripcion, t.precio,t.imagen, c.id_categoria, c.nombre nombre_categoria')
			->from('productos t')
			->join('categoria c', 'c.id_categoria = t.id_categoria')
			->where('nombre_categoria', null)
			->order_by('c.id_categoria')
			->get()
			->result();
	}
	public function eliminar($data)
	{
		$this->db->where('id_producto', $data['id_producto'])
			->update('productos', array(
				'nombre_categoria' => $data('nombre_categoria')
			));
	}
}
