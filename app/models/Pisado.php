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

	public static findById($id) {
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

	public static findByNia($nia) {
		$db = new DB;
		$db->run('SELECT * FROM pisado WHERE nia=? ORDER BY date', array($nia));

		$pisados = array();
		if ($db->count() > 1) {
			foreach($db->data() as $row){
				foreach($row as $key => $value){
					$pisado = new Pisado;
		        	$pisado->{$key} = $value;
		        	$pisados[] = $pisado;
		        }
	    	}
		} else if ($db->count() == 1) {
			foreach($db->data() $key => $value){
				$pisado = new Pisado;
	        	$pisado->{$key} = $value;
	        	$pisados[] = $pisado;
	    	}
		}

		return $pisados;
	}

	public static findByIdTitulacion($id_titulacion) {
		$db = new DB;
		$db->run('SELECT * FROM pisado WHERE id_titulacion=? ORDER BY date', array($id_titulacion));

		$pisados = array();
		if ($db->count() > 1) {
			foreach($db->data() as $row){
				foreach($row as $key => $value){
					$pisado = new Pisado;
		        	$pisado->{$key} = $value;
		        	$pisados[] = $pisado;
		        }
	    	}
		} else if ($db->count() == 1) {
			foreach($db->data() as $key => $value){
				$pisado = new Pisado;
	        	$pisado->{$key} = $value;
	        	$pisados[] = $pisado;
	    	}
		}

		return $pisados;
	}

	public static findByCurso($curso,$id_titulacion) {
		$db = new DB;
		$db->run('SELECT * FROM pisado WHERE curso=? AND id_titulacion=? ORDER BY date', array($curso,$id_titulacion));

		$pisados = array();
		if ($db->count() > 1) {
			foreach($db->data() as $row){
				foreach($row as $key => $value){
					$pisado = new Pisado;
		        	$pisado->{$key} = $value;
		        	$pisados[] = $pisado;
		        }
	    	}
		} else if ($db->count() == 1) {
			foreach($db->data() as $key => $value){
				$pisado = new Pisado;
	        	$pisado->{$key} = $value;
	        	$pisados[] = $pisado;
	    	}
		}

		return $pisados;
	}

	public static findAll() {
		$db = new DB;
		$db->run('SELECT * FROM pisado ORDER BY id_titulacion,date');

		$pisados = array();
		if ($db->count() > 1) {
			foreach($db->data() as $row){
				foreach($row as $key => $value){
					$pisado = new Pisado;
		        	$pisado->{$key} = $value;
		        	$pisados[] = $pisado;
		        }
	    	}
		} else if ($db->count() == 1) {
			foreach($db->data() as $key => $value){
				$pisado = new Pisado;
	        	$pisado->{$key} = $value;
	        	$pisados[] = $pisado;
	    	}
		}

		return $pisados;
	}

	public save() {
		$db = new DB;
		return $db->run('INSERT INTO pisado (nia,correo,date,id_titulacion,curso,asignatura,grupo,profesor,texto) VALUES (?,?,NOW(),?,?,?,?,?,?)', array($this->nia,$this->email,$this->id_titulacion,$this->curso,$this->asignatura,$this->grupo,$this->profesor,$this->texto));
	}

}