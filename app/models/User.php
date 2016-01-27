<?php

class User {

	public $nia;
	public $name;
	public $email;
//	public $titulacion;

	public $isDelegado = false;
	// id_titulacion (DB of delegados) differs from titulacion (LDAP)
	public $id_titulacion;
	public $curso = null;
	public $rol = null;
	public $centro = null;

	public function __construct($nia,$name,$email,$dn) {
		$this->nia = $nia;
		$this->name = $name;
		$this->email = $email;

		$delegado = DBDelegados::findDelegado($this->nia);
		var_dump($delegado);
		if ($delegado['rol'] != null) {
			$this->isDelegado = true;
			$this->id_titulacion = $delegado['id_titulacion'];
			$this->rol = $delegado['rol'];
			$this->curso = $delegado['curso'];
			$this->centro = DBDelegados::getCentroByIdTitulacion($this->id_titulacion);
		} else {
			$dn = explode(',', $dn);
        		$titulacion = str_replace("ou=",'',$dn[1]);
        		$titulacion = ucwords(strtolower($titulacion));
        	
			$this->isDelegado = false;
			$this->id_titulacion = DBDelegados::findByNameTitulacion($titulacion);
		}

	}

	public static function findDestinatarios($curso,$id_titulacion) {
		$delegados = array_merge(DBDelegados::findDelegadosCurso($id_titulacion,$curso), DBDelegados::findDelegadosTitulacion($id_titulacion));

		$destinatarios = array();
		foreach ($delegados as $delegado){
	        $destinatarios[] = $delegado['email'];
		}

		return $destinatarios;
	}

	public function isDelegadoCentro() {
		return $this->rol >= ROL_DELEGADO_CENTRO;
	}

	public function isDelegadoTitulacion() {
		return $this->rol >= ROL_DELEGADO_TITULACION;
	}

	public function isDelegadoCurso() {
		return $this->rol >= ROL_DELEGADO_CURSO;
	}

}
