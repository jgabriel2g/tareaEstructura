<?php
class NodoLibro{
    private $pertenecea;
    private $idLibro;
    private $titulo;
    private $autor;
    private $pais;
    private $ano;
    private $cantidad;
    private $abajo;
    
    function __construct($id,$titulo,$autor,$pais,$ano,$cantidad,$pertenecea){
        $this->idLibro = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->pais = $pais;
        $this->ano = $ano;
        $this->cantidad = $cantidad;
        $this->pertenecea = $pertenecea;
    }

    // A que editorial pertenece
    function get_Pertenecea(){
        return $this->pertenecea;
    }
    function set_Pertenecea($pertenecea){
        $this->pertenecea = $pertenecea;
    }
    //id_Libro
    function get_idLibro(){
        return $this->idLibro;
    }
    function set_idLibro($idLibro){
        $this->idLibro = $idLibro;
    }
    //Titulo
    function get_titulo(){
        return $this->titulo;
    }
    function set_titulo($titulo){
        $this->titulo = $titulo;
    }
    //Autor
    function get_autor(){
        return $this->autor;
    }
    function set_autor($autor){
        $this->autor = $autor;
    }
    //pais
    function get_pais(){
        return $this->pais;
    }
    function set_pais($pais){
        $this->pais = $pais;
    }
    //año
    function get_ano(){
        return $this->ano;
    }
    function set_ano($ano){
        $this->ano = $ano;
    }
    //Cantidad
    function get_cantidad(){
        return $this->cantidad;
    }
    function set_cantidad($cantidad){
        $this->cantidad = $cantidad;
    }
    //Apuntador
    function get_abajo(){
        return $this->abajo;
    }
    function set_abajo($abajo){
        $this->abajo = $abajo;
    }
}
?>