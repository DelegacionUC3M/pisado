<?php
class ComentarioPisado {
	public $id;
	public $id_pisado;
	public $nia;
	public $nombre;
	public $date;
	public $text;

	public static function findByIdpisado($id_pis) {
		$db = new DB;
		$db->run('SELECT * FROM comentario_pisado WHERE id_pisado=? ORDER BY date',array($id_pis));
		$data = $db->data();

		$comentarios = array();

		foreach ($data as $row) {
			$comentario = new ComentarioPisado;
			
			foreach ($row as $key => $value) {
				$comentario->{$key} = $value;
			}
			
			$comentarios[] = $comentario;
		}

		return $comentarios;
	}

	public function save() {
		$db = new DB;
		return $db->run('INSERT INTO comentario_pisado (id_pisado, nia, nombre, date, text) VALUES (?, ?, ?, NOW(), ?)', array($this->id_pisado, $this->nia, $this->nombre, $this->text));
	}
}
