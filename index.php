<?php
    include("multilista.php");
    session_start();
    if(!isset($_SESSION["multilista"])){
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
        background-color: #58D68D;
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
        <!--Eliminar editorial-->
        <div class="Eliminar_editorial">
            <form action="index.php" method="post">
                <span>Ingrese Id del editorial a eliminar</span>
                <input type="text" name="eliminar_editorial" class="texto">
                <input type="submit" value="eliminar" class="boton">
            </form>
        </div>

        <div class="eliminando_editorial">
            <?php
                if(isset($_POST["eliminar_editorial"])){
                    $H = $_SESSION["multilista"]->EliminarEditorial($_POST["eliminar_editorial"]);
                    echo "Editorial eliminada";
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
                <span>A que libreria lo desea Agregar</span>
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
        <hr>
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
        <!--Eliminar libro-->
        <div class="eliminar_libr">
            <hr>
            <form action="index.php" method="post">
                <span>Eliminar libro</span>
                <span>Id Editorial</span>
                <input type="text" name="eliminar_id_edi" class="texto">
                <span>Id Libro</span>
                <input type="text" name="eliminar_id_lib" class="texto">
                <input type="submit" value="Eliminar Libro" class="boton">
            </form>

        </div>
        <div class="eliminar_libro">
            <?php
                if (isset($_POST["eliminar_id_edi"])) {
                    //$NL = new NodoEditorial($_POST["eliminar_id_edi"],$_POST["eliminar_id_lib"]);
                    $_SESSION["multilista"]->EliminarLibro($_POST["eliminar_id_lib"],$_POST["eliminar_id_edi"]);
                    echo "Libro eliminado";
                }
            ?>
        </div>

    </section>
    <hr>
    <hr>
    <section>
        <form action="" method="POST">
            <label>Ingrese el año por el cual quiere ver la cantidad de libros</label>
            <input type="number" name="año" required>
            <input type="submit" name="FiltrarAño" value="ver">
            <?php
                    if (isset($_POST["FiltrarAño"])){
                        $año = $_REQUEST['año'];
                        $cantidad = $_SESSION['multilista']->LibrosPorAño($año);
                        if ($cantidad > 0) {
                            echo("<p>La cantidad de libros publicados en el año $año es $cantidad</p>");    
                        } else {
                             echo("<p>No hay ningún libro publicado en el año $año</p>");
                        }
                    }
                ?>
        </form>
    </section>

    <hr>
    <section>
        <form action="" method="POST">
            <label>Ingrese el nombre de la editorial por el cual quiere ver sus libros</label>
            <input type="text" name="editorial" required>
            <input type="submit" name="FiltrarEditorial" value="ver">
            <?php
                    if (isset($_POST["FiltrarEditorial"])){
                        $editorial = $_REQUEST['editorial'];
                        $cantidad = $_SESSION['multilista']->LibrosPorEditorial($editorial);
                        if ($cantidad > 0) {
                            echo("<p>La cantidad de libros publicados en la editorial $editorial es $cantidad</p>");
                        } else {
                            echo("<p>No hay ningún libro publicado en la editorial $editorial</p>");
                        }
                    }
                ?>
        </form>
    </section>

    <section class="Mostrar">
        <div class="Mostrar">
            <?php
                $Mensaje = $_SESSION["multilista"]->mostrarEditorial();
                echo "$Mensaje";
            ?>
        </div>
    </section>

</body>

</html>