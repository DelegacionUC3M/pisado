<?php
class Comentario {
	public $id;
	public $id_pisado;
	public $nia;
	public $nombre;
	public $date;
	public $text;

	public static function findByIdpisado($id_pis) {
		$db = new DB;
		$db->run('SELECT * FROM comentario WHERE id_pisado=?',array($id_pis));

		$data = $db->data();

		$comentarios = array();
		foreach ($data as $row) {
			$comentario = new Comentario;
			
			foreach ($row as $key => $value) {
				$comentario->{$key} = $value;
			}
			
			$comentarios[] = $comentarios;
		}

		return $comentarios;
	}

	public function save() {
		$db = new DB;
		return $db->run('INSERT INTO comentario (id_pisado, nia, nombre, date, text) VALUES (?, ?, ?, NOW(), ?)', array($id_pidado, $nia, $nombre, $text));
	}
}
