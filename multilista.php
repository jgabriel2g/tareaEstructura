<?php
	include("NodoEditorial.php");
	include("NodoLibro.php");
	class multilista{

		private $Head;
		private $Final;
		private $Abajo;
		private $LibroFinal;

		function __construct(){
			$this->Head = null;
			$this->Final = null;
			$this->Abajo = null;
			$this->LibroFinal = null;
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

		function EditorialVacia($P){
			//recorrer la editorial hacia abajo para saber si tiene o no libros
			$Q = $this->Abajo;
			if($Q->get_denominacion() == $P){
				if($Q->get_abajo_primerLib() == null){
					return true;
				}else{
					return false;
				}
			}
		}
		
		function ApuntarFinalLibro(){
			$R = $this->Abajo;
			while ($R != null) {
				$this->LibroFinal = $R;
			}
			return $this->LibroFinal;
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

		function AgregarLibro($Libro,$editorial){
			$editoral_add = $this->BuscarEditorial($editorial);
			if ($editoral_add == $editorial){
				if ($this->EditorialVacia($editoral_add)) {
					$this->Abajo = $Libro;
					$this->Abajo->set_abajo_primerlib($Libro);
				}else {
					$this->ApuntarFinalLibro();
					$this->LibroFinal->set_abajo($Libro);
				}
				$this->LibroFinal = $libro;
			}
		}

		function VisualizarLibrosEditorial(){
			$Corredor = $this->Abajo;
			$Mensaje = "";
			if ($this->Abajo = null) {
				return null;
			}else{
				while ($Corredor !=null) {
					$Mensaje = $Mensaje."--- id: ".$Corredor->get_idLibro()." nombre: ".$Corredor->get_titulo()." Autor: ".$Corredor->get_autor()."<br>";
					$Corredor = $Corredor->get_abajo();
				}
				return $Mensaje;
			}
		}

		function BuscarLibro($idLibro,$idEd){
			$NE = BuscarEditorial($idEd);
			if ($NE = null) {
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

		// function verDetallesLibro($IdEd,$IdLi){
		// 	$Mensaje = "";
		// 	$NL = BuscarLibro($IdEd,$IdLi);
		// 	if ($NL == null) {
		// 		$Mensaje = "Libro no encontrado";
		// 	} else {
		// 		$Mensaje = "ID libro: ".$NL->get_idLibro()."<br>"."Titulo: ".$NL->get_titulo()."<br>"."Autor: ".
		// 		$NL->get_autor()."<br>"."Pais: ".$NL->get_pais()."<br>"."Año: ".$NL->get_ano()."<br>"."Cantidad: ".$NL->get_cantidad();
		// 	}
		// 	return $Mensaje;
			
		// }

		// function ActualizarInventario($IdEd,$IdLi,$CA){
		// 	$P = False;
		// 	$NL = BuscarLibro($IdEd,$IdLi);
		// 	if ($NL==null) {
		// 		$P = False;
		// 	} else {
		// 		$NL->get_cantidad() = $NL->get_cantidad() + $CA;
		// 		$P = true; 
		// 	}
		// 	return $P;
			
		// }

		function LibrosPorAño(){
			
		}

		function LibrosPorEditorial(){
			
		}
	}
?>