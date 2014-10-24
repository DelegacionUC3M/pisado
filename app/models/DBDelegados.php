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
	 * Find if the user is delegado
	 * 
	 * @return  array with id_titulacion, rol and curso
	 */
	public static function findDelegado($nia) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT personas.id_titulacion, personas.curso, delegados.del_escuela, delegados.del_titulacion, delegados.del_curso, delegados.cargo
					FROM delegados LEFT JOIN personas ON personas.id = delegados.id where personas.nia = ?;', array($nia));
		$data = $db->data();

		if($data[0]['del_escuela'] != 0) {
			$rol = ROL_DELEGADO_ESCUELA;
		} else if($data[0]['del_titulacion'] != 0) {
			$rol = ROL_DELEGADO_TITULACION;
		} else {	//Faltan los casos especiales en que alguien que no es delegado ejerce como tal.
			$rol = ROL_DELEGADO_CURSO;
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
				FROM delegados LEFT JOIN personas ON personas.id = delegados.id
				WHERE personas.id_titulacion = ? AND personas.curso = ?;', array($id_titulacion, $curso));
		$data = $db->data();

		return isset($data) ? $data : null;
	}

	public static function findDelegadosTitulacion($id_titulacion) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT personas.nia, personas.nombre, personas.apellido1 
				FROM delegados LEFT JOIN personas ON personas.id = delegados.id
				WHERE personas.id_titulacion = ? AND delegados.del_titulacion = 1;', array($id_titulacion));
		$data = $db->data();

		return array( array('nombre' => $data[0]['nombre'] . $data[0]['apellido1'],
							'email' => $data[0]['nia'] . '@alumnos.uc3m.es') );
	}

	public static function getTitulaciones() {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT * FROM titulaciones ');
		$data = $db->data();

		return isset($data) ? $data : null;
	}

}
