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
				$this->Final = $nodoEditorialNew;
            }else{
                $this->Final->set_Siguiente($nodoEditorialNew);
                $nodoEditorialNew->set_Anterior($this->Final);
            }
            $this->Final = $nodoEditorialNew;
		}
		

		function BuscarEditorial($denominacion){ //✔
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

		function EditorialVacia($P){//✔
			$editoral_vc = $this->BuscarEditorial($P);
			if($editoral_vc->get_abajo() == null){
				return true;
			}else{
				return false;
			}
		}
		
		function ApuntarFinalLibro($editoral_apuntar){//✔
			$L = $editoral_apuntar->get_abajo();
			while ($L->get_abajo() != null) {
				$L = $L->get_abajo();
			}
			return $L;
		}


		function EliminarEditorial($IdEd){ // no da error pero no se borra de lista
			$P = $this->BuscarEditorial($IdEd);
			if($P == null){
				return false;
			}else{
				if($this->EditorialVacia($P)){
					return false;
				}else{
					if($P == $this->Head){
						if($P->get_Siguiente() == null){
							$this->Head = null;
							$this->Final = null;
						}else{
							$this->Head = $this->get_Siguiente();
							$this->Head->set_Anterior(null);
						}
					}else{
						$P = $P->get_Siguiente();
						if($P == $this->Final){
							$Final = $P->get_Anterior();
						}else{
							$P = $P->get_Anterior();
						}
					}
					$P = null;
					return true;
				}
			}
		}

		function AgregarLibro($Libro,$editorial){//✔
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
		
		function mostrarEditorial(){ //✔
		$NE = $this->Head;
		$Menasaje = "";
		if ($this->Head == null) {
			echo "La lista esta vacia";
		}else{
			while($NE != null){
				$Menasaje = $Menasaje."*Id: ".$NE->get_idEditorial()." Nombre: ".$NE->get_denominacion()."<br>";
				$Lib = $NE->get_abajo();
				while ($Lib != null) {
					$Menasaje = $Menasaje."--ID Libro: ".$Lib->get_idLibro()." Nombre: ".$Lib->get_titulo()." Cantidad: ".$Lib->get_cantidad()." Editorial: ".$Lib->get_Pertenecea()."<br>"; 
					$Lib = $Lib->get_abajo();
				}
				$NE = $NE->get_siguiente();
			}
			$Menasaje = $Menasaje;
		}
		return $Menasaje;
	}

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

		/*function EliminarLibro($LibroaEliminar,$idEd){
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
		}*/

		function EliminarLibro($idLib,$idEd){
			$P = $this->BuscarEditorial($idEd);
			if($P == null){
				return false;
			}else{
				$Libro = $P->get_abajo();
				$Ant = $Libro;
				$Encontrado = false;
				while($Libro != null && $Encontrado == false){
					if($Libro->get_idLibro() == $idLib){
						$Encontrado = true;
					}else{
						$Ant = $Libro;
						$Libro = $Libro->get_abajo();
					}
				}
				if($Libro == null){
					return false;
				}else{
					if($Libro == $P->get_abajo()){
						$P = $Libro->get_abajo();
					}else{
						$Ant = $Libro->get_abajo();
					}
					$Libro = null;
					return true;
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

		function LibrosPorAño($Ano){ //Funciona no se como pero funciona
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

		function LibrosPorEditorial($denominacion){  //Funciona no se como pero funciona
			$Con = 0;
			$Aux = $this->Head;
			//buscar editorial
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

		function ApuntarFinalEditorial($NodoEditorialP){
			$R = $NodoEditorialP->get_abajo();
			while($R->get_abajo() != null){
				$R = $R->get_abajo();
			}
			return $R;
		}

	}
?>