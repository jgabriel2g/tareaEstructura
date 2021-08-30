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
						$this->Final->get_Anterior()->set_Siguiente(NULL);
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
					$Menasaje = $Menasaje."ID: ".$NE->get_idEditorial()." | Nombre: ".$NE->get_denominacion()."<br>";
					$Lib = $NE->get_abajo();
					while ($Lib != null) {
						$Menasaje = $Menasaje."ID Libro: ".$Lib->get_idLibro()." Nombre: ".$Lib->get_titulo()." Cantidad: ".$Lib->get_cantidad()." Editorial: ".$Lib->get_Pertenecea()."<br>"; 
						$Lib = $Lib->get_abajo();
					}
					$NE = $NE->get_siguiente();
				}
				$Menasaje = $Menasaje;
			}
			return $Menasaje;
		}

		function BuscarLibro($nombreEditorial,$idLibro){
			$NE = $this->BuscarEditorial($nombreEditorial);
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

		function verDetallesLibro($nombreEditorial,$IdLi){
			$Mensaje = "";
			$NL = $this->BuscarLibro($nombreEditorial,$IdLi);
			if ($NL == null) {
				$Mensaje = "Libro no encontrado";
			} else {
				$Mensaje = "<br>"."ID libro: ".$NL->get_idLibro()."<br>"."Titulo: ".$NL->get_titulo()."<br>"."Autor: ".
		$NL->get_autor()."<br>"."Pais: ".$NL->get_pais()."<br>"."Año: ".$NL->get_ano()."<br>"."Cantidad: ".$NL->get_cantidad();
		}
		return $Mensaje;		
		}

		function ActualizarInventario($nombreEditorial,$IdLi,$CA){
			$NL = $this->BuscarLibro($nombreEditorial,$IdLi);
			$NL->get_titulo();
			if($NL == null){
				return false;
			}else{
				$NL->set_cantidad($NL->get_cantidad() + $CA);
				$this->mostrarEditorial();
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
	}
?>