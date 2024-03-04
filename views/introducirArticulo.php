<?php

    session_start();

    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be creative</title>
    <style>
        body {
            font-family: Calibri, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #DDD;
            /* background-color: #DDD; */
            background-image: url("public/img/newspaperbg.jpg");
            background-repeat: repeat;
            /* background-position: center; */
            background-size: cover;
        }

        h1 {
            font-family: Script Normal;
        }

        header {
            background-color: #666;
            padding: 2px;
            text-align: center;
            color: #ddd;            
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: rgb(161,131,107);
            /* background-color: #FF6347; */
            padding: 10px;
        }
        
        nav a, a {
            text-decoration: none;
        }

        nav a {
            color: #fff;
            /*text-decoration: none;*/
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #555;
            color: yellow;
            /* font-family: Script Normal; */
        }

        a:last-child {
            border: 2px solid orange;
        }

        /* img {
            display: block;
            margin: auto;
        } */
        
        /* li {
            margin: 10px;
        } */
        
        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #DDD;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            border-radius: 5px;
        }
        
        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            margin-bottom: 8px;
        }

        input, textarea {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        footer {
            background-color: #666;
            padding: 5px;
            text-align: center;
            color: #ddd;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        span {
            font-size: 11px;
        }
    </style>
</head>
<body>
    <header>        
        <h1>- The ARTiCLE CREATiViTY -</h1>
        <h4 id="usuario" style="color: orange;"><?= $_SESSION["usuario"] ?></h4>
    </header>
    <nav>
        <a href="sesion">Volver</a>
    </nav>
    <form action="formulario" method="post" >
        Título <input type="text" name="titulo" required/>
        <br>        
        <textarea type="text" rows="15" name="contenido" placeholder="Este artículo trata sobre..." required/></textarea>
        <br>
        Temática 
        <select name="tipoArticulo">
            <option value="alimentacion">Alimentación</option>
            <option value="deporte">Deporte</option>
            <option value="ciencia">Ciencia</option>
            <option value="tecnologia">Tecnología</option>
            <option value="cine">Cine</option>
            <option value="sucesos">Sucesos</option>
        </select>
        <input type="text" name="nombreUsuario" value="<?= $_SESSION["usuario"] ?>" hidden >
        <br>
        <input type="submit" value="Publicar artículo" class="boton"/>
    </form>
<?php include 'templates/footer.php'; ?>