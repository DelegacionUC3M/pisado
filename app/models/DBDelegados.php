<?php

class DBDelegados {

	/**
	 * Get nombre of titulacion
	 */
	public static function findByIdTitulacion($id) {
	//	$db = new DB();
	//	$db->run();

	//	if ($db->count() == 1) {
			return 'Grado en Ingeniería Informática';
	//	} else {
	//		return null;
	//	}

	}

	/**
	 * Get id of titulacion
	 */
	public static function findByNameTitulacion($nombre) {
	//	$db = new DB();
	//	$db->run();

	//	if ($db->count() == 1) {
			return 1;
	//	} else {
	//		return null;
	//	}

	}

	/**
	 * Find if the user is delegado
	 * 
	 * @return  array with id_titulacion, rol and curso
	 */
	public static function findDelegado($nia) {
	//	$db = new DB();
	//	$db->run();

	//	if ($db->count() == 1) {
	//		return array('id_titulacion' => 1, 'rol' => 50, 'curso' => 50);
	//	} else {
			return null;
	//	}
	}

	public static function findDelegadosCurso($id_titulacion,$curso) {

	}

	public static function findDelegadosTitulacion($id_titulacion) {
		return array( array('nombre' => 'Axel Blanco', 'email' => '100318425@alumnos.uc3m.es') );
	}

	public static function getTitulaciones() {
		return array( array('id_titulacion' => 1, 'nombre' => 'Grado en Ingeniería Informática'), array('id_titulacion' => 2, 'nombre' => 'Grado en Ingeniería BIomédica') );
	}

}