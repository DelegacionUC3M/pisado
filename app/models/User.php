<?php

class User extends LDAP_User {
	
	public function getTitulacion() {
		$ldap = explode(',', $this->user_domain);
		$titulacion = str_replace("ou=",'',$ldap[1]);
		return ucwords (strtolower($titulacion));
	}
	
}