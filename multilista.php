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

		function verDetallesLibro(){
			
		}

		function ActualizarLibro(){
			
		}

		function LibrosPorAño(){
			
		}

		function LibrosPorEditorial(){
			
		}




	}


?>