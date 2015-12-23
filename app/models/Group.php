<?php

class Group {

	public $id;
	public $date;
	public $subject;
	public $id_titulacion;
	public $curso;
	public $pisados;

	public static function findById($id) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT A.*, id_titulacion, curso FROM `group` A LEFT JOIN pisado B ON A.id = B.id_group WHERE A.id=? GROUP BY A.id ORDER BY A.date', array($id));

		if ($db->count() > 0) {
			$group = new Group;
			$data = $db->data();
			foreach ($data[0] as $key => $value){
	        	$group->{$key} = $value;
	    	}

	    	$group->pisados = Pisado::findByIdGroup($group->id);

	    	return $group;
		} else {
			return NULL;
		}
	}

	public static function findByNia($nia, $all = false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT A.*, id_titulacion, curso FROM `group` A LEFT JOIN pisado B ON A.id = B.id_group WHERE B.nia=? GROUP BY A.id ORDER BY A.date DESC', array($nia));
		$data = $db->data();

		$groups = array();
		foreach($data as $row){
			$group = new Group;
			foreach($row as $key => $value){
	        	$group->{$key} = $value;
	        }
			if(!$group->isClose() || $all) {
				$groups[] = $group;
			}
    	}

		return $groups;
	}

	public static function findByIdTitulacion($id_titulacion, $all = false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT A.*, id_titulacion, curso FROM `group` A LEFT JOIN pisado B ON A.id = B.id_group WHERE B.id_titulacion=? GROUP BY A.id ORDER BY A.date DESC', array($id_titulacion));
		$data = $db->data();

		$groups = array();
		foreach($data as $row){
			$group = new Group;
			foreach($row as $key => $value){
	        	$group->{$key} = $value;
	        }
			if(!$group->isClose() || $all) {
				$groups[] = $group;
			}
    	}

		return $groups;
	}

	public static function findByCurso($curso, $id_titulacion, $all = false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT A.*, id_titulacion, curso FROM `group` A LEFT JOIN pisado B ON A.id = B.id_group WHERE B.curso=? AND B.id_titulacion=? GROUP BY A.id ORDER BY A.date DESC', array($curso,$id_titulacion));
		$data = $db->data();

		$groups = array();
		foreach($data as $row){
			$group = new Group;
			foreach($row as $key => $value){
	        	$group->{$key} = $value;
	        }
			if(!$group->isClose() || $all) {
				$groups[] = $group;
			}
    	}

		return $groups;
	}

	// DEPRECATED
	// public static function findAll() {
	// 	$db = new DB(SQL_DB_PISADO);
	// 	$db->run('SELECT A.*, id_titulacion, curso FROM `group` A LEFT JOIN pisado B ON A.id = B.id_group GROUP BY A.id ORDER BY A.date');
	// 	$data = $db->data();

	// 	$groups = array();
	// 	foreach($data as $row){
	// 		$group = new Group;
	// 		foreach($row as $key => $value){
	//         	$group->{$key} = $value;
	//         }
	//         $groups[] = $group;
 	//    }

	// 	return $groups;
	// }

	public static function findByCentro($centro, $all = false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT A.*, B.id_titulacion, B.curso FROM `group` A LEFT JOIN pisado B ON A.id = B.id_group INNER JOIN delegados.titulaciones C ON B.id_titulacion = C.id_titulacion WHERE C.id_centro = ? GROUP BY A.id ORDER BY A.date DESC', array($centro) );
		$data = $db->data();

		$groups = array();
		foreach($data as $row){
			$group = new Group;
			foreach($row as $key => $value){
	        	$group->{$key} = $value;
	        }
			if(!$group->isClose() || $all) {
				$groups[] = $group;
			}
    	}

		return $groups;
	}

	public function save() {
		$db = new DB(SQL_DB_PISADO);
		$query = $db->run('INSERT INTO `group` (subject,date) VALUES (?,NOW())', array($this->subject));
		if ($query) {
			$this->id = $db->lastId();
			return true;
		} else {
			return false;
		}
	}

	public function delete() {
		$db = new DB(SQL_DB_PISADO);
		return $db->run('DELETE FROM `group` WHERE `id`='.$this->id);
	}

	public function getNameTitulacion() {
		return DBDelegados::findByIdTitulacion($this->id_titulacion);
	}

	public function getOwners() {
		$owners = array();

		foreach ($this->pisados as $pisado) {
			$owners[] = $pisado->nia;
		}

		return $owners;
	}

	public function isClose() {
		$pisado = Pisado::findByIdGroup($this->id,true);

		return count($pisado)==count($this->pisados);
	}

}
