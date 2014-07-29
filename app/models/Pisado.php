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
		$db->run('SELECT * FROM pisado WHERE nia=?', array($nia));

		$pisados = array();
		if ($db->count() > 1) {

			foreach($db->data() as $row){
				foreach($row as $key => $value){
					$pisado = new Pisado;
		        	$pisado->{$key} = $value;
		        	$pisados[] = $pisado;
		        }
	    	}

	    	return $pisados;
		} else if ($db->count() > 1) {
			return NULL;
		}
	}

}