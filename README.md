# MultiListas Bilioteca

Primeramente se Crearon los nodos los cuales possen los siguiente atributos:

```php
class NodoLibro{
    private $pertenecea;
    private $idLibro;
    private $titulo;
    private $autor;
    private $pais;
    private $ano;
    private $cantidad;
    private $abajo;
    }
```

```php
class NodoEditorial{
    private $idEditorial;
    private $denominacion;
    private $anterior;
    private $siguiente;
    private $abajo_primerLib;
}
```

POSEE SUS RESPECTIVOS CONSTRUCTORES Y POR OTRA PARTE SUS SETS AND GETS.

## Clase Multilista (Metodos)

**LA CLASE MULTILISTA ES LA QUE POSEE LOS METODOS EN SU INTERIOR.**
La clase Multilista al ser iniciada, al estrar trabjando con nodos debes de espeficiar que nodos queremos traernos la clase, en este caso como vamos a manipular los dos incluimos los dos:

```php
<?php
	include("NodoEditorial.php");
	include("NodoLibro.php");
```

**SU FUNION ES OBTENER LOS METODOS O FUNCIONES DE SUS NODOS HIJOS**

#### Creacion de Variables y contrusctor para manipular

Para manipular los nodos usamos 3 Varibales.

> 1. Cabecera (Head).
> 2. Final:"Hace referencia a el ultimo nodo de la lista Editorial (Lista principal).
> 3. Abajo el cual nos señara cual es el nodo (libro) que va debajo de cada editorial.

```php
	class multilista{

		private $Head;
		private $Final;
		private $Abajo;

		function __construct(){
			$this->Head = null;
			$this->Final = null;
			$this->Abajo = null;
		}
```

## METODOS

| Editorial          | Libro                  |
| ------------------ | ---------------------- |
| Agregar Editorial  | Agregar Libro          |
| Mostrar Editorial  | Visualizar Libro       |
| Buscar Editorial   | Buscar Libro           |
| Editorial Vacia    | ELiminar Libro         |
| Apuntador Final    | Ver detalles del Libro |
| Eliminar Editorial | Actulizar Inventario   |
| -                  | Libros Por año         |
| -                  | Libros por editorial   |

### IMPLEMENTACION

#### Agregar Editorial:

```php
function AgregarEditorial($nodoEditorialNew){
			if ($this->Head == null){
                $this->Head = $nodoEditorialNew;
            }else{
                $this->Final->set_Siguiente($nodoEditorialNew);
                $nodoEditorialNew->set_Anterior($this->Final);
            }
            $this->Final = $nodoEditorialNew;
		}
```

Agregar editorial recibe un nodo por parametro este nodo será ingresado posteriomente mediante el constructor de editorial.

###### PASOS

1. Creamos un condicional que verifique si en la posicion 0 del nodo existe ya un nodo, en caso de que no exista, este será igual a null y por conseciencia el nodo que se esta agregando al momento, tomará su lugar.
2. En caso de no ser null esto signica que el Nodo 0 ya posee una posicion aginada, por lo que se procede a Agregarlo a Final y anterior tomara el valor del Actual Final "Antes de atulizarce"

> Final Siempre será el ultimo nodo ingresado. Cuando nodo[0] == null; el nuevo nodo agregado tomará su luhar, es decir [0] = Head & Final

#### Mostrar Editorial:

```php
function mostrarEditorial(){
			$Corredor = $this->Head;
			$Mensaje = "";
			if ($this->Head == null) {
				return null;
			}else{
				while ($Corredor !=null) {
					$Mensaje = $Mensaje."*Id : ".$Corredor->get_idEditorial()." Nombre : ".$Corredor->get_denominacion()."<br>";
					$Corredor = $Corredor->get_Siguiente();
				}
			}
			return "La lista es: <br> $Mensaje";
		}
```

Su funcion es Mostrar en la interfaz Los Nodos Agregados:

###### PASOS

1.
