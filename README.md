## Preparacion del entorno
### Cuenta de usuario

Utilizaremos un cloud IDE
	> https://codenvy.com
	
Para crear el usuario podemos utilizar cualquier cuenta asociada o crear una temporal
>	https://https://temp-mail.org/es/
 
### Configuración del contenedor
 
1. Configuramos un nuevo contenedor con el perfil PHP 7.0. Ej wonderland 
2. Incorporamos el repositorio del curso

> https://github.com/roobkit/curso_php.git

Si no lo hemos incorporado antes de crear el contenedor podemos hacerlo desde la terminal con

```	
cd /projects
git clone https://bitbucket.org/roobkit/curso_php.git
```	

### Configuración de los servicios

#### MySQL (BASE DE DATOS)

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



#### Apache2 (WEB)

El repositorio tiene una estructura de directorios básica en la que los documentos públicos están ubicados dentro de la carpeta public por lo que tendremos que decirle al servidor web que empiece a leer desde ahí.

En este caso el archivo de configuración esta en **/etc/apache2/sites-enabled/000-default.conf**

> Si queréis utilizar **nano** como vuestro editor por defecto podéis instalarlo con sudo apt-get install nano

Una vez en el editor modificamos la carpeta del servidor web en las entradas

```
DocumentRoot /projects/curso_php/public
```

> Con **pwd** podéis obtener la ruta de la posición actual en consola

Reiniciamos el servicio

```
sudo /etc/init.d/apache2 restart
```

#### PHP 7.0

PHP ya funciona sin que hagamos nada gracias a que Apache tiene configurado el módulo correspondiente y es capaz de interpretar correctamente los documentos .php .

Sin embargo existen multiples opciones adicionales para personalizar cómo debe funcionar php en nuestra máquina.

En nuestro caso vamos a configurar la carpeta includes dentro del PATH. De esta forma php siempre tendrá en cuenta esta carpeta a la hora de buscar documentos.

Editamos el archivo de configuración  

```
nano /etc/php/7.0/apache2/php.ini
```
y configuramos el *path* y la opción de mostrar errores *display_errors*

Quedando:

```
display_errors = On
include\_path = ".:/php/includes:/home/cabox/workspace/curso_php/includes" 
```

Reiniciamos apache

```
sudo /etc/init.d/httpd restart
```
## Temario del curso
### Tipos
Cuatro tipos escalares:

* boolean
* integer
* float 
* string

Cuatro tipos compuestos:

* array
* object
* callable
* iterable

Dos tipos especiales:

* resource
* NULL

### Variables I
#### Generales
En PHP las variables se representan con un signo de dólar seguido por el nombre de la variable. El nombre de la variable es sensible a minúsculas y mayúsculas.

```
$cima = "Mont Blanc";

```

#### Arrays

Un array en PHP es en realidad un mapa ordenado. Un mapa es un tipo de datos que asocia valores con claves. 

Pueden ser indexados o asociativos

#### Arrays multidimensionales

Los arrays pueden a su vez contener otros arrays formando matrices.

#### Constantes
Una constante es un identificador (nombre) para un valor simple. Como el nombre sugiere, este valor no puede variar durante la ejecución del script (a excepción de las constantes mágicas, que en realidad no son constantes).

Se puede definir una constante usando la función define() o con la palabra reservada const.

```
	define("BICI_CARRETERA","DOGMA F8");
	const BICI_MTB = "SWORKS EPIC";

```

Estas son las principales diferencias entre constantes y variables:

* Las constantes no llevan el signo dólar (\$), como prefijo.
Antes de PHP 5.3, las constantes solo podían ser definidas usando la función define(), y no por simple asignación.
* Las constantes pueden ser definidas y accedidas desde cualquier ámbito sin importar las reglas de acceso de variables.
* Las constantes no pueden ser redefinidas o eliminadas una vez se han definido

#### Constantes predefinidas

| Constante | definicion |
|-----|------|
| \_\_LINE\_\_ | 	El número de línea actual en el fichero. |
| _\_\_FILE\_\_ | 	Ruta completa y nombre del fichero con enlaces  simbólicos resueltos. Si se usa dentro de un include, devolverá el nombre del fichero incluido.|
| \_\_DIR\_\_	| Directorio del fichero. Si se utiliza dentro de un include, devolverá el directorio del fichero incluído. Esta constante es igual que dirname(\_\_FILE\_\_). El nombre del directorio no lleva la barra final a no ser que esté en el directorio root.
| \_\_FUNCTION\_\_	| Nombre de la función.|
| \_\_CLASS\_\_	| Nombre de la clase. El nombre de la clase incluye el namespace declarado en (p.e.j. Foo\Bar). Tenga en cuenta que a partir de PHP 5.4 \_\_CLASS\_\_ también funciona con traits. Cuando es usado en un método trait, \_\_CLASS\_\_ es el nombre de la clase del trait que está siendo utilizado.|
| \_\_TRAIT\_\_ | 	El nombre del trait. El nombre del trait incluye el espacio de nombres en el que fue declarado (p.e.j. Foo\Bar).
| \_\_METHOD\_\_ |	Nombre del método de la clase.|
| \_\_NAMESPACE\_\_	| Nombre del espacio de nombres actual.|

#### Superglobales
Algunas variables predefinidas en PHP son "superglobales", lo que significa que están disponibles en todos los ámbitos a lo largo del script. 

| Superglobal | Definición |
|----|----|
| $GLOBALS | Es un array asociativo que contiene las referencias a todas la variables que están definidas en el ámbito global del script. Los nombres de las variables son las claves del array. |
| $\_SERVER | es un array que contiene información, tales como cabeceras, rutas y ubicaciones de script. Las entradas de este array son creadas por el servidor web. Contiene índices especiales (ver documentación) |
| $\_GET | Un array asociativo de variables pasado al script actual vía parámetros URL. |
| $\_POST | Un array asociativo de variables pasadas al script actual a través del método POST de HTTP |
| $\_FILES | Un array asociativo de elementos subidos al script en curso a través del método POST. |
| $\_COOKIE | Una variable tipo array asociativo de variables pasadas al script actual a través de Cookies HTTP. |
| $\_SESSION | Es un array asociativo que contiene variables de sesión disponibles para el script actual. Los datos se almacenan en el disco del servidor |
| $\_REQUEST | contiene $\_GET, $\_POST y $\_COOKIE. |
| $\_ENV | Información de variables de entorno |

#### Estructuras de control
**Condicionales**

* if
* else + atajos
* switch

**Bucles**

* while
* do-while
* for
* foreach

**Otros**

* continue
* break
* return
* require
* include
* require\_once
* include\_once
* goto
* declare


### Funciones
La función podría ser definida como un conjunto de instrucciones que permiten procesar las variables para obtener un resultado. 

Cada función tiene su propio ámbito. Esto es que todo lo que se genera en una función nace y muere dentro de la función.

Para poder comunicar el ámbito público con el ámbito local de una función utilizamos los **parámetros y retornos**.

### Variables II
#### Ámbitos de las variables
El ámbito de una variable es el contexto dentro del que la variable está definida. La mayor parte de las variables PHP sólo tienen un ámbito simple. Este ámbito simple también abarca los ficheros incluídos y los requeridos. Por ejemplo:

```

<?php
$a = 1;
include 'b.inc';
?>

```

Aquí, la variable \$a estará disponible al interior del script incluido b.inc. Sin embargo, al interior de las funciones definidas por el usuario se introduce un ámbito local a la función. Cualquier variable usada dentro de una función está, por omisión, limitada al ámbito local de la función. Por ejemplo:

```
<?php
$a = 1; /* ámbito global */

function test()
{
    echo $a; /* referencia a una variable del ámbito local */
}

test();
```


### Clases y Objetos

**Una clase** es un conjunto de métodos (funciones) y propiedades (variables) que nos permiten organizar de una forma ordenada componentes de nuestro programa.

**Un objeto** es simplemente un contenedor en el que cargamos el contenido de una clase. A esto se le llama instanciar la clase. 


Por ejemplo en un mismo script pueden existir dos objetos de una misma clase. Un objeto tiene forma de variable \$nombre_objeto.

```
$obj1 = new mi_clase;

$obj2 = new mi_clase;

```

#### Propiedades
> Son las variables utilizadas en todo el ámbito de las clases.

#### Métodos
> Son las funciones que contendrá la clase


#### Creación de clase
 
Para crear una clase utilizamos la palabra `class { }` y dentro creamos nuestros métodos y propiedades al igual que hacemos en el ámbito global.

```
class mi_clase {

	public mi_propiedad = "Angliru";

	public function mi_method(){
	
		echo "hola";
	}
	
}

```

> Las propiedades no llevan $ delante, solo lo lleva el objeto instanciado

#### Métodos mágicos
Existen una serie de métodos reservados que no podemos declarar dentro de ningún objeto. Estos son:

__construct(), __destruct(), __call(), __callStatic(), __get(), __set(), __isset(), __unset(), __sleep(), __wakeup(), __toString(), __invoke(), __set_state(), __clone() y __debugInfo() 

#### Herencias

Una clase (hija) puede extender los métodos de otra clase (padre). Para ello utilizamos la palabra reservada extends. Ej

```
class don_pelayo{
	[...]
}

class reconquista extends don_pelayo {
	[...]
}

```

#### Visibilidad

Los métodos y propiedades pueden tener tres tipos de visibilidad privada, pública y protegida para lo que se utiliza la palabra reservada private, public y protected.

| visibilidad | significado |
|----|----|
| public | Utilizable desde cualquier ámbito |
| private | Utilizable sólo en el ámbito de la propia clase |
| protected | Utilizable solo desde el ambito de la clase **o sus hijos** | 

> Los permisos de visibilidad tienen más que ver con la organización de las clases que con su seguridad. Nos ayudan a saber donde tiene que actuar el método o propiedad en cuestión.

En este ejemplo reconquista podrá usar `lanzar_piedras()` pero no podrá acceder a `afilar()`

```
class don_pelayo{
	public function lanzar_piedras(){
		[...]
	}
	private function afilar(){
		[...]
	}
}

class reconquista extends don_pelayo {
	public function ataque($numero_soldados){
		[...]
	}
}

```


#### Usar una clase en el ámbito global

Para usar sus métodos y propiedades se utiliza la flecha `->` . Ej:

> Podemos decir que la **->** es el separador que nos permite definir en un lado el objeto que queremos usar y en el otro la propiedad o método que vamos a trabajar. `[objeto]->[método o propiedad]`

```
$obj1 = new mi_clase;

$obj1->mi_method();
$obj1->mi_propiedad;

```

Siguiendo el ejemplo anterior sería algo así:

```
$batalla = new reconquista;

$batalla->ataque(10);

```

#### La pseudo variable \$this

Se utiliza dentro de una clase para referirse a sí misma ya que no existe un objeto con el que trabajar. Se sigue la misma sintáxis $this->[propiedad o método]

En el ejemplo anterior `afilar()` era un método privado que solo se podría usar dentro de la propia clase ¿como se puede usar?

```
class don_pelayo{
	public function lanzar_piedras($numero_piedras){
		//antes de lanzar las piedras Pelayín dice que hay que afilarlas 
		$carga = $this->afilar($numero_piedras);
		return($carga);
	}
	private function afilar($trabajo){
		//El que afila las piedras siempre se queda también con 1 de recuerdo
		$entrega=$trabajo-1;
		return($entrega);
	}
}

class reconquista extends don_pelayo {
	public function ataque($numero_soldados){
		//cada soldado puede lanzar 5 piedras
		$piedras=$numero_soldados*5;
		$ataque = $this->lanzar_piedras($piedras);
		return($ataque);
	}
}

$batalla = new reconquista;

$go = $batalla->ataque(10);

echo "\n\nIniciamos la reconquista con {$go} piedras!!! \n\n";
```


