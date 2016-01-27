<?php

class Group {

	public $id;
	public $date;
	public $subject;
	public $id_titulacion;
	public $curso;
	public $pisados;

	public static function findById($id,$archive=false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT "group".*, id_titulacion, curso FROM "group" LEFT JOIN pisado ON "group".id = pisado.id_group WHERE "group".id=? GROUP BY "group".id ORDER BY "group".date', array($id));

		if ($db->count() > 0) {
			$group = new Group;
			$data = $db->data();
			foreach ($data[0] as $key => $value){
	        	$group->{$key} = $value;
	    	}

	    	$group->pisados = Pisado::findByIdGroup($group->id,$archive);

	    	return $group;
		} else {
			return NULL;
		}
	}

	public static function findByNia($nia, $all = false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT "group".*, MAX(id_titulacion), MAX(curso) FROM "group" LEFT JOIN pisado ON "group".id = pisado.id_group WHERE pisado.nia=? GROUP BY "group".id ORDER BY "group".date DESC', array($nia));
		$data = $db->data();

		$groups = array();
		foreach($data as $row){
			$group = new Group;
			foreach($row as $key => $value){
	        	$group->{$key} = $value;
	        }
			if(!Group::isClose($group->id) || $all) {
				$groups[] = $group;
			}
    	}

		return $groups;
	}

	public static function findByIdTitulacion($id_titulacion, $all = false, $archive = false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT "group".*, id_titulacion, curso FROM "group" LEFT JOIN pisado ON "group".id = pisado.id_group WHERE pisado.id_titulacion=? GROUP BY "group".id ORDER BY "group".date DESC', array($id_titulacion));
		$data = $db->data();

		$groups = array();
		foreach($data as $row){
			$group = new Group;
			foreach($row as $key => $value){
	        	$group->{$key} = $value;
	        }
			if ($archive && Group::isClose($group->id)) {
				$groups[] = $group;
			} else if(!Group::isClose($group->id) || $all) {
				$groups[] = $group;
			}
    	}

		return $groups;
	}

	public static function findByCurso($curso, $id_titulacion, $all = false, $archive = false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT "group".*, id_titulacion, curso FROM "group" LEFT JOIN pisado ON "group".id = pisado.id_group WHERE pisado.curso=? AND pisado.id_titulacion=? GROUP BY "group".id ORDER BY "group".date DESC', array($curso,$id_titulacion));
		$data = $db->data();

		$groups = array();
		foreach($data as $row){
			$group = new Group;
			foreach($row as $key => $value){
	        	$group->{$key} = $value;
	        }
			if ($archive && Group::isClose($group->id)) {
				$groups[] = $group;
			} else if(!Group::isClose($group->id) || $all) {
				$groups[] = $group;
			}
    	}

		return $groups;
	}

	// DEPRECATED
	// public static function findAll() {
	// 	$db = new DB(SQL_DB_PISADO);
	// 	$db->run('SELECT "group".*, id_titulacion, curso FROM "group" A LEFT JOIN pisado ON "group".id = pisado.id_group GROUP BY "group".id ORDER BY "group".date');
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

	public static function findByCentro($centro, $all = false, $archive = false) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT "group".*, MAX(pisado.id_titulacion), MAX(pisado.curso) FROM "group" LEFT JOIN pisado ON "group".id = pisado.id_group GROUP BY "group".id ORDER BY "group".date DESC');
		$data = $db->data();

		$groups = array();
		foreach($data as $row){
			$group = new Group;
			foreach($row as $key => $value){
	        	$group->{$key} = $value;
	        }
			if ($archive && Group::isClose($group->id)) {
				$groups[] = $group;
			} else if(!Group::isClose($group->id) || $all) {
				$groups[] = $group;
			}
    	}

		return $groups;
	}

	public static function isClose($id_group) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT * FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NULL AND pisado.id_group=?', array($id_group));

		return $db->count() == 0;
	}

	public function save() {
		$db = new DB(SQL_DB_PISADO);
		$query = $db->run('INSERT INTO "group" (subject,date) VALUES (?,NOW())', array($this->subject));
		if ($query) {
			$this->id = $db->lastId();
			return true;
		} else {
			return false;
		}
	}

	public function delete() {
		$db = new DB(SQL_DB_PISADO);
		return $db->run('DELETE FROM "group" WHERE "id"='.$this->id);
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

}
