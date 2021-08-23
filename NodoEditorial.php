<?php
class NodoEditorial{
    private $idEditorial;
    private $denominacion;
    private $anterior;
    private $siguiente;
    private $abajo_primerLib_primerLibro;
    
    //Contructor de la clase Editorial
    function __construct($idEditorial, $denominacion){
        $this->idEditorial = $idEditorial;
        $this->denominacion = $denominacion;
        $this->anterior = null;
        $this->siguiente = null;
        $this->abajo_primerLib_primerLib = null;
    }
    
    //IdEditorial
    function get_Editorial(){
        return $this->idEditorial;
    }
    function set_Editorial($editorial){
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
    // abajo_primerLib
    function get_abajo_primerLib(){
        return $this->abajo_primerLib;
    }
    function set_abajo_primerLib($abajo_primerLib){
        $this->abajo_primerLib = $abajo_primerLib;
    }
}
        
?>