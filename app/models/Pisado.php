<?php

class Pisado {

	public $id;
	public $nia;
	public $email;
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
			foreach($db->data() as $key => $value){
	        	$pisado->{$key} = $value;
	    	}

	    	return $pisado;
		} else {
			return NULL;
		}
	}

	public static function findByNia($nia) {
		$db = new DB;
		$db->run('SELECT * FROM pisado WHERE nia=? ORDER BY date', array($nia));
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
		$db->run('SELECT * FROM pisado WHERE id_titulacion=? ORDER BY date', array($id_titulacion));
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
		$db->run('SELECT * FROM pisado WHERE curso=? AND id_titulacion=? ORDER BY date', array($curso,$id_titulacion));
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
		$db->run('SELECT * FROM pisado ORDER BY id_titulacion,date');
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
		return $db->run('INSERT INTO pisado (nia,email,date,id_titulacion,curso,asignatura,grupo,profesor,texto) VALUES (?,?,NOW(),?,?,?,?,?,?)', array($this->nia,$this->email,$this->id_titulacion,$this->curso,$this->asignatura,$this->grupo,$this->profesor,$this->texto));
	}

	public function getNameTitulacion() {
		// get titulacion from id titulacion
		$tit = '';
		switch($this->id_titulacion) {
			case 1: $tit = 'Grado en Ingenieria Informatica'; break;
			default: $tit = 'No se ha encontrado esa titulacion'; break;
		}
		return $tit;
	}

}