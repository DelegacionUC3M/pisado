<?php

class DBDelegados {

	/**
	 * Get nombre of titulacion
	 * @return $data is an string or null
	 */
	public static function findByIdTitulacion($id) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT nombre FROM titulaciones WHERE id_titulacion = ?', array($id));
		$data = $db->data();
		if ($db->count() == 1) {
			return $data[0]['nombre'];
		} else {
			return null;
		}

	}

	/**
	 * Get id of titulacion
	 * @return $data is an integer or null
	 */
	public static function findByNameTitulacion($nombre) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT id_titulacion FROM titulaciones WHERE nombre = ?', array($nombre));
		$data = $db->data();

		if ($db->count() == 1) {
			return $data[0]['id_titulacion'];
		} else {
			return null;
		}

	}

	/**
	 * Get id of centro of the titulacion
	 * @return $data is an integer or null
	 */
	public static function getCentroByIdTitulacion($id_titulacion) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT id_centro FROM titulaciones WHERE id_titulacion = ?', array($id_titulacion));
		$data = $db->data();

		if ($db->count() == 1) {
			return $data[0]['id_centro'];
		} else {
			return null;
		}

	}

	/**
	 * Find if the user is delegado
	 * 
	 * @return  array with id_titulacion, rol and curso
	 */
	public static function findDelegado($nia) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT id, id_titulacion, curso FROM personas WHERE nia = ?;', array($nia));
		$data = $db->data();
		//get delegadoCurso
		$db->run('SELECT id FROM delegadosCurso WHERE id = ?;', array($data[0]['id']));
		$delCurso = $db->data();
		//get delegadoCentro
		$db->run('SELECT id FROM delegadosCentro WHERE id = ?;', array($data[0]['id']));
		$delCentro = $db->data();
		//get delegadoTitulacion
		$db->run('SELECT id FROM delegadosTitulacion WHERE id = ?;', array($data[0]['id']));
		$delTitulacion = $db->data();
		
		if($delCentro[0] != null) {
			$rol = ROL_DELEGADO_CENTRO;	
		} else if($delTitulacion[0] != null) {
			$rol = ROL_DELEGADO_TITULACION;
		} else if($delCurso[0] != null) {	//Faltan los casos especiales en que alguien que no es delegado ejerce como tal.
			$rol = ROL_DELEGADO_CURSO
		} else {
			$rol = null;
		}

		if ($db->count() == 1) {
			return array('id_titulacion' => $data[0]['id_titulacion'], 'rol' => $rol, 'curso' => $data[0]['curso']);
		} else {
			return null;
		}
	}

	/**
	 * Find all delegates
	 * 
	 * @return  array with delegates
	 */
	public static function findDelegadosCurso($id_titulacion,$curso) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT personas.nia, personas.nombre, personas.apellido1 
				FROM delegadosCurso LEFT JOIN personas ON personas.id = delegadosCurso.id
				WHERE personas.id_titulacion = ? AND personas.curso = ?;', array($id_titulacion, $curso));
		$data = $db->data();

		return isset($data) ? $data : null;
	}

	public static function findDelegadosTitulacion($id_titulacion) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT personas.nia, personas.nombre, personas.apellido1 
				FROM delegadosTitulacion LEFT JOIN personas ON personas.id = delegadosTitulacion.id
				WHERE personas.id_titulacion = ?;', array($id_titulacion));
		$data = $db->data();

		return isset($data) ? $data : null;
	}

	public static function getTitulaciones() {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT * FROM titulaciones ');
		$data = $db->data();

		return isset($data) ? $data : null;
	}

}
