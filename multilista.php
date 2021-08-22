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

		}

		function BuscarEditorial($idEditorial){

		}

		function EditorialVacia($nodoEditorialP){
			$P = $this->Head;
			$Encontrado = false;
			//recorrer lista principal y posicionarme en la editorial
			while($P != null && $Encontrado == false){
				if($P == null){
					return "Lista principal Vacia";
				}else if($P->get_Editorial() == $nodoEditorialP){
					//recorrer la editorial hacia abajo para saber si tiene o no libros
					if($P->get_Abajo() == null){
						return true;
					}else{
						return false;
					}
				}else{
					$P = $P->get_Siguiente();
				}
			}
		}

		function visualizarEditoriales(){

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