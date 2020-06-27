<?php
defined('BASEPATH') or exit('No direct script access allowed');

class compra_ajax extends CI_Controller
{
	private $request;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('compra_model');
		$this->request = json_decode(file_get_contents('php://input'));
	}
	public function myAvatar(Request $request)
	{
		if ($request->hasFile('avatar')) {

			$url = $request->avatar->store('users/avatar');
			//	$userAvatarUpdate = User::find(auth()->id());
		}
		return "Noo Llego una imagen";
	}
	public function recuperar_categoria()
	{
		$categoria = $this->compra_model->listarCategoria();
		echo json_encode($categoria);
	}

	public function recuperar_compra()
	{
		$compra = $this->compra_model->listar();
		echo json_encode($compra);
	}
	public function compra_nueva()
	{
		$this->compra_model->insertar(array(
			'titulo' => $this->request->titulo,
			'descripcion' => $this->request->descripcion,
			'precio' => $this->request->precio,


		));
	}
	public function modificar_compra()
	{
		$this->compra_model->modificar(array(
			'id_compra' => $this->request->id_compra,
			'nombre' => $this->request->titulo,
			'descripcion' => $this->request->descripcion,
			'precio ' => $this->request->precio,
			'imagen' => $this->request->imagen

		));
	}
	public function eliminar_tarea()
	{
		$this->compra_model->eliminar(array(
			'id_compra' => $this->request->id_compra
		));
	}
}
