<?php
    include("multilista.php");
    session_start();
    if(isset($_SESSION["multilista"]) == false){
        $_SESSION["multilista"] = new multilista;
        echo'<script> alert("Se estan implemtentando Cookies"); </script>';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        color: white;
        background-color: black;
        font-size: 30px
    }
    </style>
    <title>Multilistas Biblioteca</title>
</head>

<body>
    <div class="header">
        <h1>Biblioteca de Multilistas</h1>
    </div>
    <hr>
    <section class="Formulario de Editorial">
        <div class="agregare_ditorial">
            <form action="index.php" method="post">
                <span>Agregar id Editorial</span>
                <input type="text" name="Agregar_id_Editorial" class="texto">
                <span>Agregar Denominacion</span>
                <input type="text" name="Agregar_denominacion" class="texto">
                <input type="submit" value="Agregar Editorial" class="boton">
            </form>
        </div>
        <div class="alcanamiento_editorial">
            <?php
                if (isset($_POST["Agregar_id_Editorial"], $_POST["Agregar_denominacion"])) {
                    $N = new NodoEditorial($_POST["Agregar_id_Editorial"],$_POST["Agregar_denominacion"]);
                    $_SESSION["multilista"]->AgregarEditorial($N);
                }
            ?>
        </div>
        <div class="Editorial_a_buscar">
            <form action="index.php" method="post">
                <span>Buscar Editorial</span>
                <input type="text" name="Buscar_editorial" class="texto">
                <input type="submit" value="Buscar Nodo" class="boton">
            </form>
        </div>
        <div class="busqueda_editorial">
            <?php
                if(isset($_POST["Buscar_editorial"])){
                    $B = $_SESSION["multilista"]->BuscarEditorial($_POST["Buscar_editorial"]);
                    if ($B != null) {
                        echo "<br> El elemento encontrado es: ".$B->get_denominacion()." Con Id: ".$B->get_idEditorial()."<hr>";
                    }else{
                        echo "<br> El elemento No fue Encontrado"."<hr>";
                    }
                }
            ?>
        </div>
        <div class="verificar_vacio">
            <form action="index.php" method="post">
                <span>Verificar Si la editorial Esta Vacia</span>
                <input type="text" name="ver_vacio" class="texto">
                <input type="submit" value="Ver si esta vacio" class="boton">
            </form>
        </div>
        <div class="Editoral_Vacia">
            <?php
                if(isset($_POST["ver_vacio"])){
                    $S = $_SESSION["multilista"]->EditorialVacia($_POST["ver_vacio"]);
                    if ($S) {
                        echo "<hr>Esta Editorial esta vacia";
                    }else{
                        echo "<hr>La editorial tiene al menos un libro";
                    }
                }
            ?>
        </div>
    </section>
    <hr>
    <!-- NO FUNCIONA EL AGREGAR Y MOSTRAR LIRBO -->
    <section class="Formulario de libros">
        <h4>Agergar Libro</h4>
        <div class="registrar_libr">
            <hr>
            <form action="index.php" method="post">
                <span>Id Libro</span>
                <input type="text" name="add_id_lib" class="texto">
                <span>Nombre Libro</span>
                <input type="text" name="add_titulo" class="texto">
                <span>Nombre Autor</span>
                <input type="text" name="add_autor" class="texto">
                <span>Pais</span>
                <input type="text" name="add_pais" class="texto">
                <span>Año</span>
                <input type="text" name="add_ano" class="texto">
                <span>Cantidad</span>
                <input type="text" name="add_cantidad" class="texto">
                <span>A que liberia lo desea Agregar</span>
                <input type="text" name="Select_edit" class="texto">
                <input type="submit" value="Agregar Libro" class="boton">
            </form>

        </div>
        <div class="agergar_libro">
            <?php
                if (isset($_POST["add_id_lib"])) {
                    $NL = new NodoLibro($_POST["add_id_lib"],$_POST["add_titulo"],$_POST["add_autor"],$_POST["add_pais"],$_POST["add_ano"],$_POST["add_cantidad"],$_POST["Select_edit"]);
                    $_SESSION["multilista"]->AgregarLibro($NL,$_POST["Select_edit"]);
                }
            ?>
        </div>
        <div class="Libro_a_buscar">
            <form action="index.php" method="post">
                <span>Buscar Libro: </span>
                <span>Ingrese el ID del libro:</span>
                <input type="text" name="Buscar_libro" class="texto">
                <span>Ingrese el ID del editorial:</span>
                <input type="text" name="encontrar_editorial" class="texto">
                <input type="submit" value="Buscar Nodo" class="boton">
            </form>
        </div>
        <div class="busqueda_libro">
            <?php
                if(isset($_POST["Buscar_libro"])){
                    $Z = $_SESSION["multilista"]->BuscarLibro($_POST["Buscar_libro"], $_POST["encontrar_editorial"]);
                    if ($Z != null) {
                        echo "<br> El elemento encontrado es: ".$Z->get_titulo()." Con Id: ".$Z->get_idLibro()."<hr>";
                    }else{
                        echo "<br> El elemento No fue Encontrado"."<hr>";
                    }
                }
            ?>
        </div>
    </section>
    <hr>
    <section class="Mostrar">
        <div class="Mostrar">
            <?php
                $Mensaje = $_SESSION["multilista"]->mostrarEditorial();
                echo "$Mensaje";
                $Mensaje = $_SESSION["multilista"]->VisualizarLibrosEditorial();
                echo "$Mensaje";
            ?>
        </div>
    </section>
</body>

</html>