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
		$db->run('SELECT * FROM pisado WHERE id=?', array($id));

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

	public static function findByNia($nia) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT * FROM pisado WHERE nia=? AND id_group=0 ORDER BY date', array($nia));
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

	public static function findByIdTitulacion($id_titulacion) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT * FROM pisado WHERE id_titulacion=? AND id_group=0 ORDER BY date', array($id_titulacion));
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

	public static function findByIdGroup($id_group) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT * FROM pisado WHERE id_group=? ORDER BY date', array($id_group));
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

	public static function findByCurso($curso,$id_titulacion) {
		$db = new DB(SQL_DB_PISADO);
		print_r($curso, $id_titulacion);
		$db->run('SELECT * FROM pisado WHERE curso=? AND id_titulacion=? AND id_group=0 ORDER BY date', array($curso,$id_titulacion));
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
	// 	$db->run('SELECT * FROM pisado WHERE id_group=0 ORDER BY id_titulacion,date');
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

	public static function findByCentro($centro) {
		$db = new DB(SQL_DB_PISADO);
		$db->run('SELECT A.* FROM pisado A INNER JOIN delegados.titulaciones B ON A.id_titulacion = B.id_titulacion WHERE B.id_centro = ? ORDER BY A.id_titulacion, A.date ', array($centro));
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
		$query = $db->run('INSERT INTO pisado (nia,email,date,autor,id_titulacion,curso,asignatura,grupo,profesor,texto,id_group) VALUES (?,?,NOW(),?,?,?,?,?,?,?,0)', array($this->nia,$this->email,$this->autor,$this->id_titulacion,$this->curso,$this->asignatura,$this->grupo,$this->profesor,$this->texto));
		if ($query) {
			$this->id = $db->lastId();
			return true;
		} else {
			return false;
		}
	}

	public function update() {
		$db = new DB(SQL_DB_PISADO);
		return $db->run('UPDATE pisado SET id_group=? WHERE id='.$this->id, array($this->id_group));
	}

	public function getNameTitulacion() {
		return DBDelegados::findByIdTitulacion($this->id_titulacion);
	}

}
