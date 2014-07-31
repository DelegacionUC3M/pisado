<?php
/**
 * ldap_user.php
 * @version 1.0 July 31th, 2011
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
include_once 'ldap/ldap_exception.php';
/**
 * LDAP_User
 * Represents an LDAP user. This class cannot be directly instantiated, a child
 * (LDAP_Student or LDAP_Professor) must be created instead.
 * 
 * @author Alejandro Baldominos Gómez <alexbaldo@gmail.com> 
 */
class LDAP_User
{
    // Common user fields.
    private $uid; // User identifier.
    private $cn; // User full name.
    private $mail; // User email account.
    private $dn; // User LDAP path.
    private $rol;
    /**
     * Default constructor.
     * 
     * @param $ldap_entry array with the user LDAP entry.
     * 
     * @throws LDAP_Exception if an LDAP error occurs.
     */
    public function __construct ($ldap_entry)
    {
        // Checks that the neccessary fields exist.
        if (! isset($ldap_entry['uid'][0]) ||
         ! isset($ldap_entry['cn'][0]) || ! isset($ldap_entry['mail'][0]) ||
         ! isset($ldap_entry['dn'])) {
            throw new LDAP_Exception(110);
        }
        // Initializes the user fields.
        $this->uid = $ldap_entry['uid'][0];
        $this->cn = $ldap_entry['cn'][0];
        $this->mail = $ldap_entry['mail'][0];
        $this->dn = $ldap_entry['dn'];
    }
    /**
     * Default destructor.
     */
    public function __destruct ()
    {
        // Removes user fields.
        $uid = NULL;
        $cn = NULL;
        $mail = NULL;
    }
    /**
     * Returns the user identifier.
     * 
     * @return user identifier.
     */
    public function getUserId ()
    {
        return $this->uid;
    }
    /**
     * Returns the user full name.
     * 
     * @return user full name.
     */
    public function getUserName ()
    {
        return $this->cn;
    }
    /*
	 * @return A formatted full name with uppercase the first character of each word.
	 */
    public function getUserNameFormatted ()
    {
        return ucwords(mb_strtolower($this->getUserName(), 'UTF-8'));
    }
    /**
     * Returns the user email account.
     * 
     * @return user email account.
     */
    public function getUserMail ()
    {
        return $this->mail;
    }
    /**
     * Returns the LDAP path to the user object.
     * 
     * @return user LDAP path.
     */
    public function getDn ()
    {
        return $this->dn;
    }
    /**
     * @return the $rol
     */
    public function getRol ()
    {
        return $this->rol;
    }
    /**
     * @param field_type $rol
     */
    public function setRol ($rol)
    {
        $this->rol = $rol;
    }    
}
