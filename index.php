<?php
    include("multilista.php");
    session_start();
    if(!isset($_SESSION["multilista"])){
        $_SESSION["multilista"] = new multilista;
        echo'<script> alert("INTEGRANTES: Nelson Morales - Jesus Garcia - Yan De La Torre");
        alert("Se estan implementando Cookies");        
        </script>';
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700&display=swap" rel="stylesheet">
    <title>Multilistas Biblioteca</title>
</head>

<body>
    <div class="header">
        <h1>Biblioteca de Multilistas</h1>
    </div>
    <div class="wrapper">
        <div class="Fila">
            <div class="Columnas">
                <div class="Columna_1">
    <section class="Formulario de Editorial">
        <div class="agregare_ditorial">
            <h4>Agregar Editorial</h4>
            <form action="index.php" method="post">
                <span>Agregar id Editorial</span>
                <input type="text" name="Agregar_id_Editorial" class="texto">
                <br>
                <br>
                <span>Agregar Denominacion</span>
                <input type="text" name="Agregar_denominacion" class="texto">
                <input type="submit" value="Agregar Editorial" class="boton">
            </form>
            <br><hr>
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
            <h4>Buscar Editorial</h4>
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
                        echo "<br>El elemento encontrado es: ".$B->get_denominacion()." Con Id: ".$B->get_idEditorial();
                    }else{
                        echo "<br> El elemento No fue Encontrado";
                    }
                }
            ?>
            <br><hr>
        </div>
        <div class="verificar_vacio">
            <h4>Verificar Vacio</h4>
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
                        echo "<br>Esta Editorial esta vacia";
                    }else{
                        echo "<br>La editorial tiene al menos un libro";
                    }
                }
            ?>
            <br><hr>
        </div>
    </section>
    
    <section class="Formulario de libros">
        <h4>Agregar Libro</h4>
        <div class="registrar_libr">
            <form action="index.php" method="post">
                <span>Id Libro</span>
                <input type="text" name="add_id_lib" class="texto">
                <span>Nombre Libro</span>
                <input type="text" name="add_titulo" class="texto">
                <br>
                <br>
                <span>Nombre Autor</span>
                <input type="text" name="add_autor" class="texto">
                <span>Pais</span>
                <input type="text" name="add_pais" class="texto">
                <br>
                <br>
                <span>Año</span>
                <input type="text" name="add_ano" class="texto">
                <span>Cantidad</span>
                <input type="text" name="add_cantidad" class="texto">
                <br>
                <br>
                <span>A que libreria lo desea Agregar</span>
                <input type="text" name="Select_edit" class="texto">
                <input type="submit" value="Agregar Libro" class="boton">
            </form>
            <br><hr>
        </div>
        <div class="agergar_libro">
            <?php
                if (isset($_POST["add_id_lib"])) {
                    $NL = new NodoLibro($_POST["add_id_lib"],$_POST["add_titulo"],$_POST["add_autor"],$_POST["add_pais"],$_POST["add_ano"],$_POST["add_cantidad"],$_POST["Select_edit"]);
                    $_SESSION["multilista"]->AgregarLibro($NL,$_POST["Select_edit"]);
                }
            ?>
        </div>
        <div class="eliminar_libr">
            <hr>
            <h4>Eliminar Libro</h4>
            <form action="index.php" method="post">
                <span>Id Libro</span>
                <input type="text" name="eliminar_id_lib" class="texto">
                <br><br>
                <span>Nombre Editorial</span>
                <input type="text" name="eliminar_id_edi" class="texto">
                <input type="submit" value="Eliminar Libro" class="boton">
            </form>

        </div>
        <div class="eliminar_libro">
            <?php
                if (isset($_POST["eliminar_id_edi"])) {
                    $_SESSION["multilista"]->EliminarLibro($_POST["eliminar_id_lib"],$_POST["eliminar_id_edi"]);
                }
            ?>
            <br>
        </div>
        <div class="Eliminar_editorial">
            <h4>Eliminar Editorial</h4>
            <form action="index.php" method="post">
                <span>Ingrese el nombre de la editorial a eliminar</span>
                <input type="text" name="eliminar_editorial" class="texto">
                <input type="submit" value="eliminar editorial" class="boton">
            </form>
        </div>
    </section>
    </div>
</div>
    <div class="Columnas">
        <div class="Columna_2">
            <div class="eliminando_editorial">
            <?php
                if(isset($_POST["eliminar_editorial"])){
                    $_SESSION["multilista"]->EliminarEditorial($_POST["eliminar_editorial"]);
                }
            ?>
        </div>
        <div class="Agregado_de_libros">
            <?php
                if (isset($_POST["Actualizar_inventario"])){
                    $_SESSION["multilista"]->ActualizarInventario($_POST["nombre_editorial"],$_POST["id_Libro"],$_POST["nuevo_valor"]);
                }
            ?>
        </div>
        
        
            <h1>Biblioteca</h1>
            <section class="Mostrar_section">
                <div class="Mostrar">
                    <?php
                    $Mensaje = $_SESSION["multilista"]->mostrarEditorial();
                    echo "$Mensaje";
                    ?>
                </div>
            </section>
            <div class="Libro_a_buscar">
            <br><hr>
                <h4>Buscar Libro</h4>
                <form action="index.php" method="post">
                    <span>Ingrese el ID del libro:</span>
                    <input type="text" name="Buscar_libro" class="texto">
                    <br>
                    <br>
                    <span>Ingrese el nombre del editorial:</span>
                    <input type="text" name="encontrar_editorial" class="texto">
                    <input type="submit" value="Buscar Nodo" class="boton">
            </form>
            <div class="busqueda_libro">
            <?php
                if(isset($_POST["Buscar_libro"])){
                    $Z = $_SESSION["multilista"]->BuscarLibro($_POST["encontrar_editorial"], $_POST["Buscar_libro"]);
                    if ($Z != null) {
                        echo "<br> El elemento encontrado es: ".$Z->get_titulo()."; Con Id: ".$Z->get_idLibro().", Cantidad:".$Z->get_cantidad();
                    }else{
                        echo "<br> El elemento No fue Encontrado";
                    }
                }
            ?>
            <br><hr>
        </div>
        <div class="Ver detalles">
            <h4>Ver detalles</h4>
            <form action="index.php" method="post">
                <span>Ver detalles libro: </span>
                <span>ID del libro:</span>
                <input type="text" name="hallar_libro" class="texto">
                <br>
                <br>
                <span> Nombre del editorial:</span>
                <input type="text" name="hallar_editorial" class="texto">
                <input type="submit" value="Buscar nodo" class="boton">
            </form>
        </div>
        <div class="ver_detalles">
            <?php
                if(isset($_POST["hallar_libro"])){
                    $Z = $_SESSION["multilista"]->verDetallesLibro($_POST["hallar_editorial"], $_POST["hallar_libro"]);
                    if ($Z != null) {
                        echo "<br> El elemento encontrado es: ".$Z;
                    }else{
                        echo "<br> El elemento No fue Encontrado";
                    }
                }
            ?>
        </div>
        <br><hr>
        <div class="Buscar_Libros_por_año">
            <h4>Libros por año</h4>
            <form action="index.php" method="POST">
                <span>Año por el cual quiere ver la cantidad de libros</span>
                <input type="number" name="año" required>
                <input type="submit" name="FiltrarAño" value="ver">
            </form>
            <div class="Libros_años">
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
                </div>
            <br>
        </div>
        <div class="Buscar_libros_por_editorial">
            <h4>Ver libros Por editorial</h4>
            <form action="index.php" method="POST">
                <span>Nombre editorial a la quiere ver la cantidad libros</sp>
                <input type="text" name="editorial" required>
                <input type="submit" name="FiltrarEditorial" value="ver">

            </form>
            <div class="Libros_editorial">
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
            </div>
            <br><hr>
            <div class="Actualizar_Inventario">
            <h4>Actualizar Inventario</h4>
            <form action="index.php" method="post">
                <span>Id del Libro</span>
                <input type="text" name="id_Libro">
                <br><br>
                <span>Nombre Editorial</span>
                <input type="text" name="nombre_editorial">
                <br><br>
                <span>Agregar/Retirar del inventario</span>
                <input type="number" name="nuevo_valor" placeholder="Positivo agregar/Negativo retirar">
                <input type="submit" name="Actualizar_inventario" value="Actualizar" onclick="location.reload()"/>
            </form>
        </div>
        </div>
        </div>
    </div>
</div>
</div>
</div>
    <hr>
    <footer>
        <p>Grupo - integrantes:
            <a href="https://aulavirtual.cuc.edu.co/moodle/user/profile.php?id=149989" target="_blank" rel="noopener noreferrer">@Jesus Garcia</a> - <a href="https://aulavirtual.cuc.edu.co/moodle/user/profile.php?id=149267" target="_blank" rel="noopener noreferrer">@Nelson Morales</a> - <a href="https://aulavirtual.cuc.edu.co/moodle/user/profile.php?id=151565" target="_blank" rel="noopener noreferrer">@Yan De la Torre</a></p>
    </footer>
    </p>
</body>

</html>