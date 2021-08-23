<?php
	include("NodoEditorial.php");
	include("NodoLibro.php");
	class MultiListas{

		private $Head;
		private $Final;

		function __construct(){
			$this->Head = null;
			$this->Final = null;
		}

		function AgregarEditorial(%nodoEditorialNew){
			if($this->Head == null){
				$this->Head = $nodoEditorialNew;
			}else{
				$this->Final->set_Siguiente($nodoEditorialNew);
				$nodoEditorialNew->set_Anterior($this->Final);
			}
			$this->Final = $nodoEditorialNew;
		}

		function BuscarEditorial($idEditorial){
			$P = $this->Head;
			$Encontrado = false;
			while($P != null && $Encontrado == false){
				if($P->get_Editorial() == $idEditorial){
					$Encontrado = true;
				}else{
					$P = $P->get_Siguiente();
				}
			}
			return $P;
		}

		function EditorialVacia($nodoEditorialP){
			//recorrer la editorial hacia abajo para saber si tiene o no libros
			if($P->get_Abajo() == null){
				return true;
			}else{
				return false;
			}
		}

		function ApuntarFinalEditorial($P){
			$R = $P->get_Abajo();
			while ($R->get_Abajo() != null) {
				$R = $R->get_Abajo();
			}
			return $R;
		}

		function VisualizarLibrosEditorial(){
			
		}

		function EliminarEditorial(){
			
		}

		function AgregarLibro(){
			
		}

		function BuscarLibro(){
			
		}

		function EliminarLibro(){
			
		}

		function verDetallesLibro($IdEd,$IdLi){
			$Mensaje = "";
			$NL = new NodoLibro();
			$NL = $NL->BuscarLibro($IdEd,$IdLi);
			if ($NL == null) {
				// code...
				$Mensaje = "Libro no encontrado";
			} else {
				// code...
				$Mensaje = $Mensaje."ID libro: ".$NL->get_idLibro()."<br>"."Titulo: ".$NL->get_titulo()."<br>"."Autor: ".
				$NL->get_autor()."<br>"."Pais: ".$NL->get_pais()."<br>"."Año: ".$NL->get_ano()."<br>"."Cantidad: ".$NL->get_cantidad();
			}
			return $Mensaje;
			
		}

		function ActualizarInventario($IdEd,$IdLi,$CA){
			$P = False;
			$NL = new NodoLibro();
			$NL = $NL->BuscarLibro($IdEd,$IdLi);
			if ($NL==null) {
				// code...
				$P = False;
			} else {
				$NL->get_cantidad() = $NL->get_cantidad() + $CA;
				$P = true; 
			}
			return $P;
			
		}

		function LibrosPorAño(){
			
		}

		function LibrosPorEditorial(){
			
		}




	}


?>