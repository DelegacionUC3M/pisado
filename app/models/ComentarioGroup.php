<?php
class ComentarioGroup {
	public $id;
	public $id_group;
	public $nia;
	public $nombre;
	public $date;
	public $text;

	public static function findByIdgroup($id_pis) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT * FROM comentario_group WHERE id_group=? ORDER BY date',array($id_pis));
		$data = $db->data();

		$comentarios = array();

		foreach ($data as $row) {
			$comentario = new ComentarioGroup;
			
			foreach ($row as $key => $value) {
				$comentario->{$key} = $value;
			}
			
			$comentarios[] = $comentario;
		}

		return $comentarios;
	}

	public function save() {
		$db = new DB(SQL_DB_PISADO);
		return $db->run('INSERT INTO comentario_group (id_group, nia, nombre, date, text) VALUES (?, ?, ?, NOW(), ?)', array($this->id_group, $this->nia, $this->nombre, $this->text));
	}
}
