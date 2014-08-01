<?php

class User {

	public $nia;
	public $name;
	public $email;
	public $titulacion;

	public $isDelegado = false;
	// id_titulacion (DB of delegados) differs from titulacion (LDAP)
	public $id_titulacion;
	public $curso;
	public $rol = 0;

	public function __construct($nia,$name,$email,$dn) {
		$this->nia = $nia;
		$this->name = $name;
		$this->email = $email;

		// Check in the database of delegados
		// Get rol.
		// Get id of titulacion
		// Get curso
			$this->id_titulacion = 1; $this->rol = 10; $this->curso = 1; $this->isDelegado = true;
		// 

		$ldap = explode(',', $dn);
        $titulacion = str_replace("ou=",'',$ldap[1]);
        $this->titulacion = ucwords(strtolower($titulacion));
	}

	public static function findDestinatarios($curso,$id_titulacion) {
		$db = new DB;
		$db->run("SELECT nia FROM /*DBdelegados.Personas*/ WHERE curso=? AND id_titulacion=?", array($curso,$id_titulacion));

		$destinatarios = array();
		foreach($db->data() as $nia){
	        $destinatarios[] = $nia;
		}
		$db->run("SELECT nia FROM /*DBdelegados.Personas*/ INNER JOIN /*DBdelegados.Delegados*/ ON id_titulacion=?
			AND del_titulacio", array($id_titulacion)); //Convertir a correo
		foreach ($db->data() as $nia) {
			$destinatarios[] = $nia;
		}

		return $destinatarios;
	}

	public function isDelegadoEscuela() {
		return $this->rol >= ROL_DELEGADO_ESCUELA;
	}

	public function isDelegadoTitulacion() {
		return $this->rol >= ROL_DELEGADO_TITULACION;
	}

	public function isDelegadoCurso() {
		return $this->rol >= ROL_DELEGADO_CURSO;
	}

}
