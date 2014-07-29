PISADO
======

Pisado es una aplicacion para cumplimentar incidencias sobre profesores de forma anónima.

Instalar la libreria de ldap en debian
```bash
$ sudo apt-get install php5-ldap 
```

* Modificar la estructura del pisado (que sea como el pisado autentico: id, nia, correo, fecha, id_tit, curso, id_asg, grupo, nombre del profesor-No obligatorio-, texto).     ····HECHO····
* Nueva tabla con titulaciones (nombre, id_tit).     ····HECHO····
* Comprobar si es delegado, si lo es mostrar el boton de ver pisados.
* Escuela lo ve todo, titulacion ve su titulacion y curso ve su curso. El de curso no ve el contacto.
* Al rellenar pisado enviar pdf con correo al usuario y un correo de aviso a titulacion y curso.
* Posibilidad de poner comentarios en el pisado, tanto el usuario como los delegados. En los delegados que muestre el nombre, correo y titulacion, en el usuario nombre y correo.
* A cada usuario que no sea delegado se le muestran los pisados que ha tramitado.