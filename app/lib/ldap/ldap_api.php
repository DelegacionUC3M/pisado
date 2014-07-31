<?php

/**
 * ldap_api.php
 * @version 1.0 July 30th, 2011
 * 
 * @author Alejandro Baldominos Gómez <alexbaldo@gmail.com>
 * para Delegación de Estudiantes - Universidad Carlos III de Madrid.
 * @copyright Creative Commons Attribution-ShareAlike 3.0 Unported.
 * http://creativecommons.org/licenses/by-sa/3.0/legalcode
 * Some rights reserved.
 * 
 * @package Lib
 * @subpackage LDAP
 */

// REQUIRES AND INCLUDES
require_once ABSPATH . 'app/lib/ldap_user.php';
include_once ABSPATH . 'app/lib/ldap/ldap_exception.php';

/**
 * LDAP_Api
 * Provides an interface for LDAP interaction.
 * The functionalities which are provided are:
 * - Connection.
 * - Login.
 * - Search.
 * 
 * @author Alejandro Baldominos Gómez <alexbaldo@gmail.com> 
 */
class LDAP_Api {
	
	// LDAP properties.
	private $ldap_basedn;
	private $ldap_idfield;
	private $ldap_fields;
	
	// LDAP connection.
	private $ldap_con;
	
	/**
	 * Default constructor.
	 * 
	 * @param $ldap_basedn the base DN for the directory.
	 * @param $ldap_idfield the field which contains the user identifier.
	 * @param $ldap_fields user usefull fields.
	 */
	public function __construct($ldap_basedn, $ldap_idfield, $ldap_fields) {
		
		// Initializes the LDAP connection to NULL.
		$this->ldap_con = NULL;
		
		// Initializes the LDAP properties.
		$this->ldap_basedn = $ldap_basedn;
		$this->ldap_idfield = $ldap_idfield;
		$this->ldap_fields = $ldap_fields;
	}
	
	/**
	 * Default destructor.
	 */
	function __destruct() {
		
		// An LDAP connection is established.
		if ($this->ldap_con != NULL) {
			// Closes the LDAP connection.
			$this->disconnect ();
		}
		
		// Removes properties.
		$this->ldap_basedn = NULL;
		$this->ldap_idfield = NULL;
	}
	
	/**
	 * Establishes a connection with an LDAP server.
	 * 
	 * @param $hostname the LDAP server hostname or IP.
	 * @param $port the LDAP server port 
	 * (optional - by default 389).
	 * 
	 * @return true if the connection is established correctly, false otherwise.
	 */
	public function connect($hostname, $port = 389) {
		
		// Connects to LDAP server.
		$this->ldap_con = ldap_connect ( $hostname, $port ) or die ( "Could not connect to" );
		
		// A connection is established.
		if ($this->ldap_con != NULL) {
			// Sets LDAP properties.
			ldap_set_option ( $this->ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3 );
			ldap_set_option ( $this->ldap_con, LDAP_OPT_REFERRALS, 0 );
			
			return true;
		
		// Failed to connect.	
		} else {
			return false;
		}
	}
	
	/**
	 * Closes the established connection with the LDAP server.
	 * 
	 * @throws LDAP_Exception if a connection to the LDAP server is not established 
	 * or an LDAP error occurs.
	 */
	public function disconnect() {
		
		// A connection to an LDAP server is not established.
		if ($this->ldap_con == NULL) {
			throw new LDAP_Exception ( 100 );
		}
		
		// Closes the LDAP connection.
		ldap_close ( $this->ldap_con );
		
		// Removes the connection references.
		$this->ldap_con = NULL;
	}
	
	/**
	 * Logins into the LDAP directory.
	 * 
	 * @param $userid the user id.
	 * @param $password the user password.
	 * 
	 * @return User object if the login is correct, false otherwise.
	 * @throws LDAP_Exception if a connection to the LDAP server is not established 
	 * or an LDAP error occurs.
	 */
	public function login($userid, $password) {
		
		// A connection to an LDAP server is not established.
		if ($this->ldap_con == NULL) {
			throw new LDAP_Exception ( 100 );
		}
		
		// Searches for LDAP user.
		$results = $this->search ( $this->ldap_idfield . '=' . $userid, $this->ldap_fields );

		// The user is not found in the directory.
		if ($results == NULL) {
			return false;
		
		// The user exists.	
		} else {
			// There should be only one user.
			$user = new LDAP_User ( $results [0] );
			
			// Authenticates to the LDAP server.
			$bind = @ldap_bind ( $this->ldap_con, $user->getDn (), $password );
			
			// Returns the login status.
			return ($bind) ? $user : false;
		}
	}
	
	/**
	 * Performs a search in the LDAP directory.
	 * 
	 * @param $query the search query.
	 * @param $attributes the required LDAP attributes (optional).
	 * 
	 * @return an array with the found LDAP entries, NULL if there are no results.
	 * @throws LDAP_Exception if a connection to the LDAP server is not established 
	 * or an LDAP error occurs.
	 */
	public function search($query, $attributes = array()) {
		
		// A connection to an LDAP server is not established.
		if ($this->ldap_con == NULL) {
			throw new LDAP_Exception ( 100 );
		}
		
		// Performs the search.
		$results = ldap_search ( $this->ldap_con, $this->ldap_basedn, $query, $attributes, 0, 1 );
		
		// An error occurs while searching and no results can be obtained.
		$errno = ldap_errno ( $this->ldap_con );
		if ($results == null && $errno > 0) {
			throw new LDAP_Exception ( $errno );
		}
		
		// Results are found.
		if (ldap_count_entries ( $this->ldap_con, $results ) > 0) {
			// The entries are obtained and returned as an array.
			$entries = ldap_get_entries ( $this->ldap_con, $results );
			
			// An error occurred, but results could be obtained.
			if ($errno > 0) {
				$entries ['error'] = new LDAP_Exception ( $errno );
			}
			
			return $entries;
		
		// If there are no results, returns NULL.
		} else {
			return NULL;
		}
	}

}