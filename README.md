##Preparacion del entorno
###Cuenta de usuario

* Utilizaremos un cloud IDE

> https://codeanywhere.com
	
* Para crear el usuario podemos utilizar cualquier cuenta asociada o crear una temporal

> https://https://temp-mail.org/es/
 
###Configuración del contenedor
 
1. Creamos un nuevo contenedor con el perfil PHP 7.0 asignándole cualquier nombre
2. Descargamos el repositorio de código del curso


```	
git clone git@bitbucket.org:roobkit/curso_php.git 
cd curso_php
```	

###Configuración de los servicios

####BASE DE DATOS

Lo primero es cargar una base de datos inicial de ejemplo para el curso. Para ello utilizaremos mysql

```
sudo mysql < ./sql/almacen.sql
```

Otra posibilidad es ejecutar el documento desde phpmyadmin pero para ello deberíamos tenerlo en local.

A phpmyadmin se accede lanzando la web del contenedor en **[url]/phpmyadmin**

Por defecto el usuario root no tiene constraseña, podemos ponérsela utilizando la sentancia

```
mysql -u root -e "SET PASSWORD=PASSWORD('hello');"
```

####WEB

El repositorio tiene una estructura de directorios básica en la que los documentos públicos están ubicados dentro de la carpeta public por lo que tendremos que decirle al servidor web que empiece a leer desde ahí.

En este caso el archivo de configuración esta en **/etc/httpd/conf/httpd.conf**

> Si queréis utilizar **nano** como vuestro editor por defecto podéis instalarlo con yum install nano

Una vez en el editor modificamos la carpeta del servidor web en las entradas

* DocumentRoot "/home/cabox/workspace/curso_php/public"
* \<Directory "/home/cabox/workspace/curso_php/public">

> Con **pwd** podéis obtener la ruta de la posición actual en consola

Reiniciamos el servicio

```
sudo /etc/init.d/httpd restart
```

####PHP

PHP ya puede funcionar gracias a que apache tiene configurado el módulo correspondiente de php y es capaz de interpretar correctamente los documentos .php .

Sin embargo existen multiples opciones adicionales para personalizar cómo debe funcionar php en nuestra máquina.

En nuestro caso vamos a configurar la carpeta includes dentro del PATH. De esta forma php siempre tendrá en cuenta esta carpeta a la hora de buscar documentos.

Editamos el archivo de configuración que esta en **/etc/php.ini** y configuramos el path y la opción de mostrar errores display_errors

Quedando:

```
display_errors = On
include\_path = ".:/php/includes:/home/cabox/workspace/curso_php/includes" 
```

Reiniciamos apache

```
sudo /etc/init.d/httpd restart
```




