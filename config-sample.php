<?php

/* Define ABSPATH as this files directory. */
define( 'ABSPATH', dirname(__FILE__) . '/' );

/* Roles mas privilegios = un numero mas grande. */
define('ROL_DELEGADO_CURSO', 10);
define('ROL_DELEGADO_TITULACION', 50);
define('ROL_DELEGADO_CENTRO', 100);

/* Centros */
define('CCSSJJ', 1);
define('EPS', 2);

// LDAP Parameters
define('LDAP_HOST', '');
define('LDAP_BASEDN', '');
define('LDAP_IDFIELD', '');
define('LDAP_NAMEFIELD', '');
define('LDAP_MAILFIELD', '');
define('LDAP_MAILALIASFIELD', '');
date_default_timezone_set('Europe/Madrid');

/* SQL Parameters */
define('SQL_HOST', 'localhost');
define('SQL_DB_PISADO', 'pisado');
define('SQL_DB_DELEGADOS', 'delegados');
define('SQL_PASSWD', 'pisado');
define('SQL_USER', 'pisado');
define('SQL_PORT', 3306);
