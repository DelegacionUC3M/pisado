<?php

class Pisado {

	public $id;
	public $nia;
	public $email;
	public $autor;
	public $date;
	public $id_titulacion;
	public $asignatura;
	public $curso;
	public $grupo;
	public $profesor;
	public $texto;

	public static function findById($id) {
		$db = new DB;
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
		$db = new DB;
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
		$db = new DB;
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
		$db = new DB;
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
		$db = new DB;
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

	public static function findAll() {
		$db = new DB;
		$db->run('SELECT * FROM pisado WHERE id_group=0 ORDER BY id_titulacion,date');
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
		$db = new DB;
		return $db->run('INSERT INTO pisado (nia,email,date,autor,id_titulacion,curso,asignatura,grupo,profesor,texto) VALUES (?,?,NOW(),?,?,?,?,?,?,?)', array($this->nia,$this->email,$this->autor,$this->id_titulacion,$this->curso,$this->asignatura,$this->grupo,$this->profesor,$this->texto));
	}

	public function getNameTitulacion() {
		return DBDelegados::findByIdTitulacion($this->id_titulacion);
	}

}
