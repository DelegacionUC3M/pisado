<?php

/* Define ABSPATH as this files directory. */
define( 'ABSPATH', dirname(__FILE__) . '/' );

/* Roles mas privilegios = un numero mas grande. */
define('ROL_DELEGADO_CURSO', 10);
define('ROL_DELEGADO_TITULACION', 50);
define('ROL_DELEGADO_ESCUELA', 100);

// LDAP Parameters
define('LDAP_HOST', 'ldaps://ldap.uc3m.es');
define('LDAP_BASEDN', 'ou=Alumnos,ou=Gente,o=Universidad Carlos III,c=es');
define('LDAP_IDFIELD', 'uid');
define('LDAP_NAMEFIELD', 'cn');
define('LDAP_MAILFIELD', 'mail');
define('LDAP_MAILALIASFIELD', 'uc3mcorreoalias');
date_default_timezone_set('Europe/Madrid');

/* SQL Parameters */
define('SQL_HOST', 'locahost');
define('SQL_DB', 'pisado');
define('SQL_DB_PISADO', 'pisado');
define('SQL_DB_DELEGADOS', 'pisado');
define('SQL_PASSWD', 'root');
define('SQL_USER', 'root');
define('SQL_PORT', 3306);
