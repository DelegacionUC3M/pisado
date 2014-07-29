<?php
class Comentario {
	public $id;
	public $id_pisado;
	public $nia;
	public $nombre;
	public $date;
	public $text;

	public static findByIdpisado($id_pis) {
		$db = new DB;
		$db->run('SELECT * FROM pisado WHERE id_pisado=?',array($id_pis));

		$comentarios = array();
		if($db->count == 1) {
			foreach ($db->data() as $key => $value) {
				$comentario = new Comentario;
				$comentario->{$key} = $value;
				$comentarios[] = $comentario;
			}
		} else if($db->data() > 1) {
			foreach ($db->data() as $row) {
				foreach ($row as $key => $value) {
					$comentario = new Comentario;
					$comentarios->{$key} = $value;
					$comentarios[] = $comentarios;
				}
			}
		}

		return $comentarios;
	}

	public save() {
		$db = new DB;
		return $db->run('INSERT INTO comentario (id_pisado, nia, nombre, date, text) VALUES (?, ?, ?, NOW(), ?)'
						, array($id_pidado, $nia, $nombre, $text));
	}
}
