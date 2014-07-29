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
	private $role;

	public function __construct($nia,$name,$email,$dn) {
		$this->nia = $nia;
		$this->name = $name;
		$this->email = $email;

		// Check in the database of delegados
		// Get role.
		// Get id of titulacion
		// Get curso

		$ldap = explode(',', $dn);
        $titulacion = str_replace("ou=",'',$ldap[1]);
        $this->titulacion = ucwords(strtolower($titulacion));
	}

}