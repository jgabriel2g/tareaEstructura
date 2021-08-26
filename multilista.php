<?php
	include("NodoEditorial.php");
	include("NodoLibro.php");
	class multilista{

		private $Head;
		private $Final;

		function __construct(){
			$this->Head = null;
			$this->Final = null;
		}

		function AgregarEditorial($nodoEditorialNew){ //✔
			if ($this->Head == null){
                $this->Head = $nodoEditorialNew;
            }else{
                $this->Final->set_Siguiente($nodoEditorialNew);
                $nodoEditorialNew->set_Anterior($this->Final);
            }
            $this->Final = $nodoEditorialNew;
		}
		
		function mostrarEditorial(){ //✔
		$NE = $this->Head;
        if ($this->Head == null) {
            return "No se encuentrar Registradas Editoriales";
        } else {
            while ($NE != null) {
                echo "ID : ".$NE->get_idEditorial()." Editorial : ".$NE->get_denominacion()."<br>";
                if ($NE->get_abajo_primerLib() != null) {
                    $A = $NE-> get_abajo_primerLib();
                    echo "--ID : ".$A->get_idLibro()." Titulo : ".$A-> get_titulo()." Editorial : ".$A->get_Pertenecea()."<br>";
                    while ($A->get_abajo() != null) {
                       echo "--ID : ".$A->get_idLibro()." Titulo : ".$A-> get_titulo()." Editorial : ".$A->get_Pertenecea()."<br>";
                        $A = $A->get_abajo();
                    }
                }
                $NE = $NE->get_Siguiente();
            }
        }
	}

		function BuscarEditorial($idEditorial){ //✔
			$P = $this->Head;
            $Encontrado = False;
            while ($P != null && $Encontrado == False){
                if ($P->get_denominacion() == $idEditorial){
                    $Encontrado = true;
                }else{
                    $P = $P->get_Siguiente();
                }
            }
        	return $P;
        }

		function EditorialVacia($P){//✔
			$editoral_vc = $this->BuscarEditorial($P);
			if($editoral_vc->get_abajo_primerLib() == null){
				return true;
			}else{
				return false;
			}
		}
		
		function ApuntarFinalLibro($editoral_apuntar){//✔
			$L = $editoral_apuntar->get_abajo_primerLib();
			while ($L->get_abajo() != null) {
				$L = $L->get_abajo();
			}
			return $L;
		}


		function EliminarEditorial($eliminacion){
			$Aux = $this->Head;
        	$Anterior = $Aux;
        	$Encontrado = false;
        	$eliminado = false;
			while ($Aux != null && $Encontrado == false) {
            if($Aux->get_Editorial() == $eliminacion){
                $Encontrado = true;
            }else{
                $Anterior = $Aux;
                $Aux = $Aux->getSig();
            }
        }
        if ($Aux == null) {
            $eliminado = false;
        }else{
            if ($Aux==$this->Head) {
                $this->Head = $this->Head->get_Siguiente();
                if ($Aux == $this->Final) {
                    $this->Final=null;
                }
            }else{
                $Anterior->setSig($Aux->get_Siguiente());
                if ($Aux == $this->Final) {
                    $this->Final = $Anterior;
                }
            }
            $Aux = null;
            $eliminado = true;
        }
		}

		function AgregarLibro($Libro,$editorial){//✔
			$editoral_add = $this->BuscarEditorial($editorial);
			if ($editoral_add!=null) {
				if($this->EditorialVacia($editoral_add->get_denominacion())){
					$editoral_add->set_abajo_primerLib($Libro);
				}else{
					$LibroFinal =$this->ApuntarFinalLibro($editoral_add);
					$LibroFinal->set_abajo($Libro);
				}
			}else{
				echo "La Editorial donde desea ingresar el libro no exite";
			}
		}

		function BuscarLibro($idEd,$idLibro){
			$NE = $this->BuscarEditorial($idEd);
			if ($NE == null) {
				return "La editorial No exite";
			}else{
				$Aux = $this->abajo;
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

		function EliminarLibro($LibroaEliminar,$idEd){
			$NE = BuscarEditorial($idEd);
			if ($NE = null) {
				return "La editorial No exite";
			}else{
				$libros = $this->abajo;
				$Anterior = $libros;
				$Encontrado = false;
				$eliminado = false;
				while ($libros != null && $Encontrado == false) {
					if ($libros->get_idLibro() == $LibroaEliminar) {
						$Encontrado = true;
					}else{
						$Anterior = $libros;
						$libros = $libros->get_abajo();
					}
					if ($libros == null) {
						$eliminado = false;
					}else{
						if ($libros ==$this->abajo) {
							$this->abajo = $this->abajo->get_abajo();
							if ($libros == $this->LibroFinal) {
								$this->LibroFinal = null;
							}else{
								$Anterior->set_abaj();
								if ($libros == $this->LibroFinal) {
									$this->LibroFinal = $Anterior;
								}
							}
							$libros = null;
							$eliminado = true;
						}
						return $eliminado;
					}
				}
			}
			
		}

		function verDetallesLibro($IdEd,$IdLi){
			$Mensaje = "";
			$NL = $this->BuscarLibro($IdLi,$IdEd);
			if ($NL == null) {
				$Mensaje = "Libro no encontrado";
			} else {
				$Mensaje = "ID libro: ".$NL->get_idLibro()."<br>"."Titulo: ".$NL->get_titulo()."<br>"."Autor: ".
		 		$NL->get_autor()."<br>"."Pais: ".$NL->get_pais()."<br>"."Año: ".$NL->get_ano()."<br>"."Cantidad: ".$NL->get_cantidad();
		 	}
		 	return $Mensaje;
				
		}

		function ActualizarInventario($IdEd,$IdLi,$CA){
			$NL = $this->BuscarLibro($IdLi, $IdEd);
			if($NL == null){
				return false;
			}else{
				$NL->set_cantidad($NL->get_cantidad() + $CA);
				return true;
			}			
		}

		function LibrosPorAño($Ano){
			$Cont = 0;
			$Aux = $this->Head;
			$Aux2 = $Aux;
			//buscar libros con el año
			//recorrer editoriales
			while($Aux != null){
				while($Aux2 != null){					
					if($Aux2->get_ano() == $Ano){
						$Cont = $Cont + 1;
						$Aux2 = $Aux2->get_abajo();
					}else{
						$Aux2 = $Aux2->get_abajo();
					}
				}
				$Aux = $Aux->getSig();
			}
			return "Hay ".$Cont." Libros del año ".$Ano;
		}

		function LibrosPorEditorial($denominacion){
			$Con = 0;
			$Aux = $this->Head;
			//buscar editorial
			if($Aux == null){
				return "Lista de editoriales vacia";
			}else{
				while($Aux != null){
					if($Aux->get_denominacion() == $denominacion){
						$Aux2 = $Aux;
						if($this->EditorialVacia($denominacion)){
							return "Editorial vacia";
						}else{
							while($Aux2 != null){
								$Cont = $Cont + 1;
								$Aux2 = $Aux2->get_abajo();
							}
							return "La editorial ".$denominacion." tiene ".$Cont." libros";
						}
					}else{
						return "Editorial no encontrada";
					}
				}
			}
		}
	}
?>