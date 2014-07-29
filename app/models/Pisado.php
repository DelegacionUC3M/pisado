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

		$pisado = new Pisado;
		foreach($db->data() as $key => $value){
        	$pisado->{$key} = $value;
    	}

    	return $pisado;
	}

}