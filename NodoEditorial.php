<?php
class NodoEditorial{
    private $idEditorial;
    private $denominacion;
    private $anterior;
    private $siguiente;
    private $abajo;
    
    //Contructor de la clase Editorial
    function __construct($idEditorial, $denominacion){
        $this->idEditorial = $idEditorial;
        $this->denominacion = $denominacion;
        $this->anterior = null;
        $this->siguiente = null;
        $this->abajo = null;
    }
    
    //IdEditorial
    function get_idEditorial(){
        return $this->idEditorial;
    }
    function set_idEditorial($editorial){
        $this->idEditorial = $editorial;
    }
    //Denominacion
    function get_denominacion(){
        return $this->denominacion;
    }
    function set_demoninacion($denominacion){
        $this->denominacion = $denominacion;
    }
    //Siguente
    function get_Siguiente(){
        return $this->siguiente;
    }
    function set_Siguiente($siguiente){
        $this->siguiente = $siguiente;
    }
    //Anterior
    function get_Anterior(){
        return $this->anterior;
    }
    function set_Anterior($Anterior){
        $this->anterior = $Anterior;
    }
    // abajo
    function get_abajo(){
        return $this->abajo;
    }
    function set_abajo($abajo_primerLib){
        $this->abajo = $abajo_primerLib;
    }
}
        
?>