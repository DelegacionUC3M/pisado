<?php

/**
 * ldap_exception.php
 * @version 1.0 July 30th, 2011
 * 
 * @author Alejandro Baldominos Gómez <alexbaldo@gmail.com>
 * 	para Delegación de Estudiantes - Universidad Carlos III de Madrid.
 * @copyright Creative Commons Attribution-ShareAlike 3.0 Unported.
 * 	http://creativecommons.org/licenses/by-sa/3.0/legalcode
 * 	Some rights reserved.
 * 
 * @package Lib
 * @subpackage LDAP
 */

/**
 * LDAP_Exception
 * The exception is thrown when an exception occurs when performing
 * LDAP operations.
 * 
 * @author Alejandro Baldominos Gómez <alexbaldo@gmail.com>  
 */
 class LDAP_Exception extends Exception {
 	
 	// LDAP error codes.
 	static $LDAP_ERRORS = array(
 		// Standard errors.
 		0 => 'LDAP_SUCCESS', 1 => 'LDAP_OPERATIONS_ERROR',
 		2 => 'LDAP_PROTOCOL_ERROR', 3 => 'LDAP_TIMELIMIT_EXCEEDED',
 		4 => 'LDAP_SIZELIMIT_EXCEEDED', 5 => 'LDAP_COMPARE_FALSE',
 		6 => 'LDAP_COMPARE_TRUE', 7 => 'LDAP_STRONG_AUTH_NOT_SUPPORTED',
 		8 => 'LDAP_STRONG_AUTH_REQUIRED', 9 => 'LDAP_PARTIAL_RESULTS',
 		16 => 'LDAP_NO_SUCH_ATTRIBUTE', 17 => 'LDAP_UNDEFINED_TYPE',
 		18 => 'LDAP_INAPPROPIATE_MATCHING', 19 => 'LDAP_CONSTRAINT_VIOLATION',
 		20 => 'LDAP_TYPE_OR_VALUE_EXISTS', 21 => 'LDAP_INVALID_SYNTAX',
 		32 => 'LDAP_NO_SUCH_OBJECT', 33 => 'LDAP_ALIAS_PROBLEM',
 		34 => 'LDAP_INVALID_DN_SYNTAX', 35 => 'LDAP_IS_LEAF',
 		36 => 'LDAP_ALIAS_DEREF_PROBLEM', 48 => 'LDAP_INAPPROPIATE_AUTH',
 		49 => 'LDAP_INVALID_CREDENTIALS', 50 => 'LDAP_INSUFFICIENT_ACCESS',
 		51 => 'LDAP_BUSY', 52 => 'LDAP_UNAVAILABLE', 
 		53 => 'LDAP_UNWILLING_TO_PERFORM', 54 => 'LDAP_LOOP_DETECT',
 		64 => 'LDAP_NAMING_VIOLATION', 65 => 'LDAP_OBJECT_CLASS_VIOLATION',
 		66 => 'LDAP_NOT_ALLOWED_ON_NONLEAF', 67 => 'LDAP_NOT_ALLOWED_ON_RDN',
 		68 => 'LDAP_ALREADY_EXISTS', 69 => 'LDAP_NO_OBJECT_CLASS_MODS',
 		70 => 'LDAP_RESULTS_TOO_LARGE', 80 => 'LDAP_OTHER',
 		81 => 'LDAP_SERVER_DOWN', 82 => 'LDAP_LOCAL_ERROR',
 		83 => 'LDAP_ENCODING_ERROR', 84 => 'LDAP_DECODING_ERROR',
 		85 => 'LDAP_TIMEOUT', 86 => 'LDAP_AUTH_UNKNOWN',
 		87 => 'LDAP_FILTER_ERROR', 88 => 'LDAP_USER_CANCELLED',
 		89 => 'LDAP_PARAM_ERROR', 90 => 'LDAP_NO_MEMORY',
 		
 		// Own errors.
 		100 => 'LDAP_CONNECTION_REQUIRED', 110 => 'LDAP_WRONG_ENTRY_FORMAT');
 	
 	/**
 	 * Default constructor.
 	 * 
	 * @param errno LDAP error code.
 	 */
 	public function __construct ($errno) {
 		parent::__construct(self::$LDAP_ERRORS[$errno], $errno);
 	}
 	
 }