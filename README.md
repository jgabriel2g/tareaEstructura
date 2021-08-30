# MultiListas Bilioteca

Primeramente, se Crearon los nodos los cuales posen los siguiente atributos:

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

**LA CLASE MULTILISTA ES LA QUE POSEE LOS MÉTODOS EN SU ANTERIOR. **
La clase Multilista al ser iniciada, al estar trabajando con nodos debes de especificar que nodos queremos traernos la clase, en este caso como vamos a manipular los dos incluimos los dos:

```php
<?php
	include("NodoEditorial.php");
	include("NodoLibro.php");
```

**SU FUNCIÓN ES OBTENER LOS MÉTODOS O FUNCIONES DE SUS NODOS HIJOS**

#### creación de Variables y constructor para manipular

Para manipular los nodos usamos 3 Variables.

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

Agregar editorial recibe un nodo por parámetro este nodo será ingresado posteriormente mediante el constructor de editorial.

###### PASOS

1. Creamos un condicional que verifique si en la posición 0 del nodo existe ya un nodo, en caso de que no exista, este será igual a Null y por consecuencia el nodo que se está agregando al momento, tomará su lugar.
2. En caso de no ser Null esto significa que el Nodo 0 ya posee una posición aginada, por lo que se procede a Agregarlo a Final y anterior tomara el valor del Actual Final "Antes de actualizarse"

> Final Siempre será el último nodo ingresado. Cuando nodo[0] == null; el nuevo nodo agregado tomará su lugar, es decir [0] = Head & Final

#### Buscar Editorial

```php
function BuscarEditorial($denominacion){
	$P = $this->Head;
        $Encontrado = False;
            while ($P != null && $Encontrado == False){
                if ($P->get_denominacion() == $denominacion){
                    $Encontrado = true;
                }else{
                    $P = $P->get_Siguiente();
                }
            }
        return $P;
        }
```

Su función es BUSCAR las editoriales agregadas. Este método nos será útil a la hora de realizar las funciones respectivas para el`Nodo_Libro();`

###### PASOS

1. Por parámetros se le asigna el valor mediante por el cual se desea buscar la editorial, en este caso es la `$denominación`, es decir, el Nombre de la editorial.
2. Se declara un booleano el cual cambiará a true cuando el nodo que estamos buscando sea encontrado.
3. Se realiza el recorrido de las editoriales, se le asignará el valor a la editorial mediante el método siguiente y una vez encontrado esta variable será retornada y posteriormente impresa en la interfaz.

#### Editorial vacía y apuntador Final

```php
function EditorialVacia($P){
			$editoral_vc = $this->BuscarEditorial($P);
			if($editoral_vc->get_abajo() == null){
				return true;
			}else{
			return false;
			}
		}

		function ApuntarFinalLibro($editoral_apuntar){
			$L = $editoral_apuntar->get_abajo();
			while ($L->get_abajo() != null) {
				$L = $L->get_abajo();
			}
			return $L;
		}
```

La función de **editorial vacía** es 'avisar' de cuando una editorial se encuentra vacía, es decir sin libros almacenados, esto lo hace mediante un recorrido de abajo.

> Abajo es apuntador de la editorial, su función es apuntar al primer libro almacenado.

Si Encuentra que abajo es `Null` Retornará `true` dando a entender que se encuentra vacía, en otro caso retornará `false` dando por supuesto a entender que esta no está vacía.

**Apuntar libro final**, Su función es, como su nombre lo indica, apuntar al último libro de una editorial, esto lo hace mediante el recorrido de abajo, pero esta vez del apuntador de libro, el recorrido se realizará hasta que encuentre un valor Null, apenas lo encuentre dejará de hacer el recorrido y tomará el valor del ultimo valor estudiando, una vez recibido lo retorna.

#### Eliminar Editorial
```php
function EliminarEditorial($NombreEditorial){
            $Editorial = $this->BuscarEditorial($NombreEditorial);
            if($Editorial == NULL){
                return false;
            }else{
                if ($Editorial === $this->Head) {
                    if($Editorial->get_Siguiente() == NULL){
                        $this->Head = NULL;
                        $this->Final = NULL;
                    }else{
                        $this->Head = $this->Head->get_Siguiente();
                        $this->Head->set_Anterior(NULL);
                    }
                }else{ 
                    if($Editorial === $this->Final){
                        $this->Final = $Editorial->get_Anterior();
                    }else{
                        $Auxiliar = $Editorial->get_Anterior();
                        $Auxiliar->set_Siguiente($Editorial->get_Siguiente());
                    }
                }
                $Editorial = NULL;
                return true;
            }
        }
```
Su función es eliminar una editorial entera, incluyendo los libros que se encuentran almacenados en ella, esto lo hace mediante el recorrido de la editorial.

En caso de que la editorial ingresada sea la principal se realizara la primera condición, en otro caso se realizará la segunda.


#### Agregar Libro

```php
function AgregarLibro($Libro,$editorial){
			$editoral_add = $this->BuscarEditorial($editorial);
			if ($editoral_add!=null) {
				if($this->EditorialVacia($editoral_add->get_denominacion())){
					$editoral_add->set_abajo($Libro);
				}else{
					$LibroFinal =$this->ApuntarFinalLibro($editoral_add);
					$LibroFinal->set_abajo($Libro);
				}
			}else{
				echo "La Editorial donde desea ingresar el libro no exite";
			}
		}
```

Su función es agregar un libro, esto lo hace mediante el análisis de dos atributos, el `$Libro` y la `$editorial`, se realiza de este modo ya que el libro será el nodo que agregaremos la editorial la dirección a la que agregaremos el libro.

###### Pasos

1. Se busca la editorial mediante el método `BuscarEditorial()` anteriormente mencionado.
1. Ser verifica que la editorial exista y una vez estudiado se procede a almacenar el libro; Si la editorial esta vacía, este tomará la primera posición, en caso de que no:
1. Se buscara mediante el método `ApuntarFinalLibro()` el último libro de la editorial y el nuevo será agregado debajo de este y por ultimo
1. El libro agregado tomará el valor de Final.

#### Mostrar editorial

```php
function mostrarEditorial(){
		$NE = $this->Head;
		$Menasaje = "";
		if ($this->Head == null) {
			echo "La lista esta vacia";
		}else{
			while($NE != null){
				$Menasaje = $Menasaje."*Id: ".$NE->get_idEditorial()
				." Nombre: ".$NE->get_denominacion()."<br>";
				$Lib = $NE->get_abajo();
				while ($Lib != null) {``
					$Menasaje = $Menasaje."--ID Libro: ".$Lib->get_idLibro()
					." Nombre: ".$Lib->get_titulo()." Cantidad: ".$Lib->get_cantidad()
					." Editorial: ".$Lib->get_Pertenecea()."<br>";
					$Lib = $Lib->get_abajo();
				}
				$NE = $NE->get_siguiente();
			}
			$Menasaje = $Menasaje;
		}
		return $Menasaje;
	}
```

Su función es mostrar mediante la interfaz las editoriales y los nodos que se encuentran dentro de esta misma esto lo hace de la siguiente manera:

###### Pasos

1. A `$NE` se le asigna el valor de la primera editorial (`Head`).
1. En caso de que `Head` sea igual a `Null` Significa que no se ha registrado ninguna editorial por lo que retornará que la lista se encuentra vacía.
1. En caso de que no esté vicia revisara que `$NE` La cual almacena la primera editorial; Si la editorial no está vacía entonces imprimirá el nombre de la editorial y su ID.
1. Se crea la variable `$Lib` que obtendrá el primer libro el cual posteriormente será estudiado.
1. Si `$Lib` Es diferente de `Null` se retornara la información del libro, en caso de que este vacía pasara a estudiar la siguiente editorial.

#### Buscar Libro

```php
function BuscarLibro($idEd,$idLibro){
		$NE = $this->BuscarEditorial($idEd);
			if ($NE == null) {
				return "La editorial No exite";
			}else{
				$Aux = $NE->get_abajo();
				$Encontrado = false;
				while ($Aux != null && $Encontrado == false) {
					if($Aux->get_idLibro()==$idLibro){
						$Encontrado = true;
					}else{
						$Aux = $Aux->get_abajo();
					}
				}
				return $Aux;
			}
		}
```

Su función es buscar un libro he imprimir este mismo con la id, esto lo hace mediante el recorrido de los libros asignados a una editorial especifica dada por el usuario.

> Funciona de igual forma que el método `BuscarEditorial().`

Realiza un recorrido de `Abajo` y una vez encuentre el libro retorna sus valores.

#### Eliminar Libro
```php
public function EliminarLibro($IdLibro, $NombreEditorial){
        $P = $this->BuscarEditorial($NombreEditorial);
        if ($P == null) {
            return false;
        } else {
            $Q = $P->get_abajo();
            $Ant = $Q;
            $Encontrado = false;
            while ($Q != null && $Encontrado == false) {
                if ($Q->get_idLibro() == $IdLibro) {
                    $Encontrado = true;
                } else {
                    $Ant = $Q;
                    $Q = $Q->get_abajo();
                }
            }
            if ($Q == null) {
                return false;
            } else {
                if ($Q === $P->get_abajo()) {
                    $P->set_abajo($Q->get_abajo());
                } else {
                    $Ant->set_abajo($Q->get_abajo());
                }
                $Q = null;
                return true;
            }
        }
    }
```
Su función es eliminar el libro de una editorial específica, esto lo hace recibiendo por parámetros el libro que desea eliminar seguido de la editorial a la que pertenece, una vez obtenido se realiza el recorrido para encontrar el respectivo libro en la editorial y una vez encontrado se eliminara tomando su lugar el que estaba después de él y en caso de que el siguiente sea nulo por su lugar se asignara valor `Null`

#### Ver detalles del libro

```php
function verDetallesLibro($IdEd,$IdLi){
			$Mensaje = "";
			$NL = $this->BuscarLibro($IdEd,$IdLi);
			if ($NL == null) {
				$Mensaje = "Libro no encontrado";
			} else {
				$Mensaje = "<br>"."ID libro: ".$NL->get_idLibro().
				"<br>"."Titulo: ".$NL->get_titulo()."<br>"."Autor: ".
		 		$NL->get_autor()."<br>"."Pais: ".$NL->get_pais()."<br>".
				"Año: ".$NL->get_ano()."<br>"."Cantidad: ".$NL->get_cantidad();
		 	}
		 	return $Mensaje;
		}
```

Su función es mostrar cada detalle del libro esto lo hace obteniendo el libro que quiere estudiar mediante el método `BuscarLibro()` que fue previamente analizado.

#### Actualizar Inventario
```php
function ActualizarInventario($nombreEditorial,$IdLi,$CA){
			$NL = $this->BuscarLibro($nombreEditorial,$IdLi);
			$NL->get_titulo();
			if($NL == null){
				return false;
			}else{
				$NL->set_cantidad($NL->get_cantidad() + $CA);
				return true;
			}
		}
```
Su función es actualizar el inventario de un libro en específico en una librería específica, esto lo hace recibiendo por parámetro la cantidad que se desea agregar al libro, el cual fue previamente asignado por el usuario, una vez obtenido se toma la cantidad inicial y se le suma lo nuevo
> En caso de ser un número mayor se suma, si es un número negativo este se restará.

#### Libros por año

```php
function LibrosPorAño($Ano){
			$Cont = 0;
			$Aux = $this->Head;
			while($Aux != null){
				$Aux2 = $Aux->get_abajo();
				while($Aux2 != null){
					if($Aux2->get_ano() == $Ano){
						$Cont = $Cont + 1;
					}
					$Aux2 = $Aux2->get_abajo();
				}
				$Aux = $Aux->get_Siguiente();
			}
			return $Cont;
		}
```

Su función es mostrar cuantos libros están registrados el mismo año en diferentes editoriales, esto lo hace mediante la creación de un contador `$Cont` el cual aumenta un valor cada vez que Encuentra un libro en el que su año coincide con el año ingresado por el usuario.

> Es importante inicializar la variable contadora en 0 para evitar fallos en el conteo

#### Libros por editorial

```php
function LibrosPorEditorial($denominacion){
		$Con = 0;
		$Aux = $this->Head;
			while($Aux != null){
				if($Aux->get_denominacion() == $denominacion){
					if($Aux->get_abajo() != null){
						$abajo = $Aux->get_abajo();
						while ($abajo != NULL) {
						 	$Con++;
							$abajo = $abajo->get_abajo();
						}
					}
				}
				$Aux = $Aux->get_Siguiente();
			}
			return $Con;
		}
```

El funcionamiento es el mismo que por año, su función es mostrar por pantalla cuantos libros se encuentran registrados en una editorial, esto lo hace mediante el estudio de le editorial ingresada por un usuario una vez está ingresada, empieza a realizar el recorrido hacia abajo y a cada libro que lee a `$Cont` Se le asigna un valor más.

Create By [Cmrales26](https://github.com/Cmrales26)🤨 [jgabriel2g](https://github.com/jgabriel2g)😎 [Ydelator](https://github.com/Ydelator)😐.

README written by [Cmrales26](https://github.com/Cmrales26)🤨
