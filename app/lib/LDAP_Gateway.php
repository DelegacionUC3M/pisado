<?php
/**
 * ldap_gateway.php
 * @version 1.0 July 30th, 2011
 * 
 * @author Alejandro Baldominos Gómez <alexbaldo@gmail.com>
 * para Delegación de Estudiantes - Universidad Carlos III de Madrid.
 * @copyright Creative Commons Attribution-ShareAlike 3.0 Unported.
 * http://creativecommons.org/licenses/by-sa/3.0/legalcode
 * Some rights reserved.
 * 
 * @package Includes
 */
// REQUIRES
require_once 'ldap/ldap_api.php';
include_once 'ldap/ldap_exception.php';
/**
 * LDAP_Gateway
 * Provides a gateway for LDAP operations.
 * 
 * @author Alejandro Baldominos Gómez <alexbaldo@gmail.com> 
 */
class LDAP_Gateway
{
    // constants from config.php
    static $LDAP_FIELDS = array(LDAP_IDFIELD, LDAP_NAMEFIELD, 
    LDAP_MAILFIELD);
    /**
     * Logins into the LDAP directory.
     * 
     * @param $userid the user id.
     * @param $password the user password.
     * 
     * @return User object if the login is correct, false otherwise.
     * @throws LDAP_Exception if an LDAP error occurs.
     */
    public static function login ($userid, $password)
    {
		# $userid = ldapspecialchars($userid);
		# $password = ldapspecialchars($password);
        // Loads the LDAP Api.
        $ldap_api = new LDAP_Api(LDAP_BASEDN, LDAP_IDFIELD, 
        self::$LDAP_FIELDS);
        // Establishes an LDAP connection.
        $ldap_api->connect(LDAP_HOST);
        // Tries to authenticate to LDAP.
        return $ldap_api->login($userid, $password);
    }
    public static function searchUser ($userid)
    {
        $ldap_api = new LDAP_Api(LDAP_BASEDN, LDAP_IDFIELD, self::$LDAP_FIELDS);
        // Establishes an LDAP connection.
        $ldap_api->connect(LDAP_HOST);
        // Searches for LDAP user.
        $results = $ldap_api->search(
        LDAP_IDFIELD . '=' . $userid, self::$LDAP_FIELDS);
        // The user is not found in the directory.
        if ($results == NULL) {
            return false;
             // The user exists.	
        } else {
            // There should be only one user.
            return new LDAP_User($results[0]);
        }
    }
}
