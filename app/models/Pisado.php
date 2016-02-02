<?php

class Pisado {

	public $id;
	public $nia;
	public $email;
	public $autor;
	public $date;
	public $id_titulacion;
	public $id_group;
	public $asignatura;
	public $curso;
	public $grupo;
	public $profesor;
	public $texto;

	public static function findById($id) {
		$db = new DB(SQL_DB_PISADO);
			$db->run('SELECT pisado.* FROM pisado WHERE pisado.id=?', array($id));

		if ($db->count() > 0) {
			$pisado = new Pisado;
			$data = $db->data();
			foreach ($data[0] as $key => $value){
	        	$pisado->{$key} = $value;
	    	}

	    	return $pisado;
		} else {
			return NULL;
		}
	}

	public static function findByNia($nia, $archive = false) {
		$db = new DB(SQL_DB_PISADO);
		if ($archive) {
			$db->run('SELECT pisado.* FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NOT NULL AND pisado.nia=? AND pisado.id_group IS NOT NULL ORDER BY pisado.date DESC', array($nia));
		} else {
			$db->run('SELECT pisado.* FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NULL AND pisado.nia=? AND pisado.id_group IS NULL ORDER BY pisado.date DESC', array($nia));
		}
		$data = $db->data();

		$pisados = array();
		foreach($data as $row){
			$pisado = new Pisado;
			foreach($row as $key => $value){
	        	$pisado->{$key} = $value;
	        }
	        $pisados[] = $pisado;
    	}

		return $pisados;
	}

	public static function findByIdTitulacion($id_titulacion, $archive = false) {
		$db = new DB(SQL_DB_PISADO);
		if ($archive) {
			print_r('archivo');
			$db->run('SELECT pisado.* FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NOT NULL AND pisado.id_titulacion=? AND pisado.id_group IS NOT NULL ORDER BY pisado.date DESC', array($id_titulacion));
		} else {
			print_r('no archivo');
			$db->run('SELECT pisado.* FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NULL AND pisado.id_titulacion=? AND pisado.id_group IS NULL ORDER BY pisado.date DESC', array($id_titulacion));
		}
		$data = $db->data();
		var_dump($data);
		$pisados = array();
		foreach($data as $row){
			$pisado = new Pisado;
			foreach($row as $key => $value){
	        	$pisado->{$key} = $value;
	        }
	        $pisados[] = $pisado;
    	}

		return $pisados;
	}

	public static function findByIdGroup($id_group, $archive = false) {
		$db = new DB(SQL_DB_PISADO);
		if ($archive) {
			$db->run('SELECT pisado.* FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NOT NULL AND pisado.id_group=? ORDER BY pisado.date DESC', array($id_group));
		} else {
			$db->run('SELECT pisado.* FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NULL AND pisado.id_group=? ORDER BY pisado.date DESC', array($id_group));
		}
		$data = $db->data();

		$pisados = array();
		foreach($data as $row){
			$pisado = new Pisado;
			foreach($row as $key => $value){
	        	$pisado->{$key} = $value;
	        }
	        $pisados[] = $pisado;
    	}

		return $pisados;
	}

	public static function findByCurso($curso,$id_titulacion, $archive = false) {
		$db = new DB(SQL_DB_PISADO);
		if ($archive) {
			$db->run('SELECT pisado.* FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NOT NULL AND pisado.curso=? AND pisado.id_titulacion=? AND pisado.id_group IS NULL ORDER BY pisado.date DESC', array($curso,$id_titulacion));
		} else {
			$db->run('SELECT pisado.* FROM pisado LEFT JOIN archive ON pisado.id = archive.id_pisado WHERE archive.id IS NULL AND pisado.curso=? AND pisado.id_titulacion=? AND pisado.id_group IS NULL ORDER BY pisado.date DESC', array($curso,$id_titulacion));
		}
		$data = $db->data();

		$pisados = array();
		foreach($data as $row){
			$pisado = new Pisado;
			foreach($row as $key => $value){
	        	$pisado->{$key} = $value;
	        }
	        $pisados[] = $pisado;
    	}

		return $pisados;
	}

	// DEPRECATED
	// public static function findAll() {
	// 	$db = new DB(SQL_DB_PISADO);
	// 	$db->run('SELECT * FROM pisado WHERE id_group IS NULL ORDER BY id_titulacion,date');
	// 	$data = $db->data();

	// 	$pisados = array();
	// 	foreach($data as $row){
	// 		$pisado = new Pisado;
	// 		foreach($row as $key => $value){
	//         	$pisado->{$key} = $value;
	//         }
	//         $pisados[] = $pisado;
 	// 	}

	// 	return $pisados;
	// }

	public static function findByCentro($centro, $archive = false) {
		$db = new DB(SQL_DB_PISADO);
		if ($archive) {
			$db->run('SELECT A.* FROM pisado A LEFT JOIN archive C ON A.id = C.id_pisado WHERE C.id IS NOT NULL AND A.id_group IS NOT NULL ORDER BY A.date DESC');
			//$db->run('SELECT A.* FROM pisado A INNER JOIN delegados.titulaciones B ON A.id_titulacion = B.id_titulacion LEFT JOIN archive C ON A.id = C.id_pisado WHERE C.id IS NOT NULL AND B.id_centro=? AND A.id_group IS NULL ORDER BY A.date DESC', array($centro));
		} else {
			$db->run('SELECT A.* FROM pisado A LEFT JOIN archive C ON A.id = C.id_pisado WHERE C.id IS NULL AND A.id_group IS NULL ORDER BY A.date DESC');
			//$db->run('SELECT A.* FROM pisado A INNER JOIN delegados.titulaciones B ON A.id_titulacion = B.id_titulacion LEFT JOIN archive C ON A.id = C.id_pisado WHERE C.id IS NULL AND B.id_centro=? AND A.id_group IS NULL ORDER BY A.date DESC', array($centro));
		}
		$data = $db->data();

		$pisados = array();
		foreach($data as $row){
			$pisado = new Pisado;
			foreach($row as $key => $value){
	        	$pisado->{$key} = $value;
	        }
	        $pisados[] = $pisado;
    	}

		return $pisados;
	}

	public function save() {
		$db = new DB(SQL_DB_PISADO);
		$query = $db->run('INSERT INTO pisado (nia,email,date,autor,id_titulacion,curso,asignatura,grupo,profesor,texto,id_group) VALUES (?,?,NOW(),?,?,?,?,?,?,?,NULL)', array($this->nia,$this->email,$this->autor,$this->id_titulacion,$this->curso,$this->asignatura,$this->grupo,$this->profesor,$this->texto));
		if ($query) {
			$this->id = $db->lastId('pisado');
			return true;
		} else {
			return false;
		}
	}

	public function update() {
		$db = new DB(SQL_DB_PISADO);
		return $db->run('UPDATE pisado SET id_group=? WHERE id=?', array($this->id_group,$this->id));
	}

	public function getNameTitulacion() {
		return DBDelegados::findByIdTitulacion($this->id_titulacion);
	}

}
