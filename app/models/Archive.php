<?php

class Archive {

	public $id;
	public $pisado;
	public $date;

	public static function findById($id) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT id, id_pisado, `date` FROM `archive` WHERE id = ?', array($id));

		if ($db->count() > 0) {
			$archive = new Archive;
			$data = $db->data();
			foreach ($data[0] as $key => $value){
                if ($key != 'id_pisado') {
                    $archive->{$key} = $value;
                } else {
                    $archive->pisado = Pisado::findByID($value);
                }
	    	}

	    	return $archive;
		} else {
			return NULL;
		}
	}

	public static function findByPisado($pisado_id) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT id, id_pisado, `date` FROM `archive` WHERE id_pisado = ?', array($pisado_id));
		$data = $db->data();

        if ($db->count() > 0) {
			$archive = new Archive;
			$data = $db->data();
			foreach ($data[0] as $key => $value){
                if ($key != 'id_pisado') {
                    $archive->{$key} = $value;
                } else {
                    $archive->pisado = Pisado::findByID($value);
                }
	    	}

	    	return $archive;
		} else {
			return NULL;
		}
	}

	public static function findByDate($date) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT id, id_pisado, `date` FROM `archive` WHERE date = ?', array($date));
		$data = $db->data();

		$archives = array();
		foreach($data as $row){
			$archive = new Archive;
			foreach($row as $key => $value){
                if ($key != 'id_pisado') {
                    $archive->{$key} = $value;
                } else {
                    $archive->pisado = Pisado::findByID($value);
                }
	        }
	        $archives[] = $archive;
    	}

		return $archives;
	}

	public function save() {
		$db = new DB(SQL_DB_PISADO);
		$query = $db->run('INSERT INTO `archive` (id_pisado,date) VALUES (?,NOW())', array($this->pisado->id));
		if ($query) {
			$this->id = $db->lastId();
			return true;
		} else {
			return false;
		}
	}

	public function delete() {
		$db = new DB(SQL_DB_PISADO);
		return $db->run('DELETE FROM `archive` WHERE `id`= ?', array($this->id));
	}

}
