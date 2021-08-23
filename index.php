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

    </section>

    <section class="Editoriales">
        <div class="mostrar_Editorial">
            <?php
                $Mensaje = $_SESSION["multilista"]->mostrarEditorial();
                echo "$Mensaje";
            ?>
        </div>
    </section>

</body>

</html>