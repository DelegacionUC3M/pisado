<?php

class DBDelegados {

	/**
	 * Get nombre of titulacion
	 * @return $data is an string or null
	 */
	public static function findByIdTitulacion($id) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT name FROM study WHERE id_study = ?', array($id));
		$data = $db->data();
		if ($db->count() == 1) {
			return $data[0]['name'];
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
		$db->run('SELECT id_study FROM study WHERE name = ?', array($nombre));
		$data = $db->data();

		if ($db->count() == 1) {
			return $data[0]['id_study'];
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
		$db->run('SELECT id_school FROM study WHERE id_study = ?', array($id_titulacion));
		$data = $db->data();

		if ($db->count() == 1) {
			return $data[0]['id_school'];
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
		$db->run('SELECT person.id_study, person.course, delegate.school, delegate.study, delegate.course
                FROM delegate LEFT JOIN person ON person.id_person = delegate.id_delegate
                WHERE person.nia=?;', array($nia));
		$data = $db->data()[0];
		
		if (isset($data)) {
		    if($data['school'] > 0) {
		    	$rol = ROL_DELEGADO_CENTRO;	
		    } else if($data['study'] > 0) {
		    	$rol = ROL_DELEGADO_TITULACION;
		    } else if($data['course'] > 0) {
		    	$rol = ROL_DELEGADO_CURSO;
		    } else {
		    	$rol = ROL_JUNTA_CLAUSTRO;
		    }

			return array('id_titulacion' => $data['id_study'], 'rol' => $rol, 'curso' => $data['course']);
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
		$db->run('SELECT person.nia, person.name, personas.surname 
				FROM delegate LEFT JOIN person ON person.id_person = delegate.id_delegate
				WHERE person.id_study = ? AND person.course = ? AND delegate.course=1;', array($id_titulacion, $curso));
		$data = $db->data();

		return isset($data) ? $data : null;
	}

	public static function findDelegadosTitulacion($id_titulacion) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT person.nia, person.name, person.surname 
				FROM delegate LEFT JOIN person ON person.id_person = delegate.id_delegate
				WHERE person.id_study=? AND delegate.study=1;', array($id_titulacion));
		$data = $db->data();

		return isset($data) ? $data : null;
	}

	public static function getTitulaciones() {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT * FROM study');
		$data = $db->data();

		return isset($data) ? $data : null;
	}

}
