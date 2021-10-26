<?php
    $title = "Galeria";
    require_once "./utils/utils.php";

    /*
        Inicializar SIEMPRE todas las variables usadas en el controlador y la vista 
    */

    $info = $description = $urlImagen = "";
    $descriptionError = $imagenErr = $hayErrores = false;
    $errores = [];

    if ("POST" === $_SERVER["REQUEST_METHOD"]){
        //Nunca confiar en que llegan todos los datos!!
        if (empty($_POST)){
            $errores[] = "Se ha producido un error al procesar el formulario";
            $imagenErr = true;
        }

        //Si ya ha habido algún error, no continuamos procesando!
        if (!$imagenErr){
            $description = sanitizeInput(($_POST["description"] ?? ""));

            //Ahora hacer las comprobaciones
            if (empty($description)){
                $errores[] = "La descripcion es obligatoria";
                $descriptionError = true;
            }

        }

        //En este caso, vamos a procesar la imagen moviendola a otro sitio
        if (isset($_FILES['imagen']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK)){
            //Limitar tamaño del archivo
            if ($_FILES['imagen']['size'] > (2 * 1024 * 1024)){
                $errores[] = "El archivo no puede superar los 2MB";
                $imagenErr = true;
            }

            //Comprobar el mime type 
            $extensions = array("image/jpeg", "image/jpg", "image/png");

            if (false === in_array($_FILES['imagen']['type'], $extensions)){
                $errores[] = 'Extension no permitida, solo son validos archivos jpg o png';
                $imagenErr = true;
            }

            if (!$imagenErr){
                //Si no hay ningun error, moverlo a la carpeta de la galeria
                if (false === move_uploaded_file($_FILES['imagen']['tmp_name'], "images/index/gallery/". $_FILES['imagen']['name'])){
                    $errores[] = "Se ha producido un error al mover la imagen";
                    $imagenErr = true;
                }
            }
        }else{
            $errores[] = "Se ha producido un error. Codigo de error: " . $_FILES['imagen']['error'];
            $imagenErr = true;
        }

        if (sizeOf($errores) > 0){
            $hayErrores = true;
        }

        //Si sigue sin haber errores
        if (!$hayErrores){
            $info = "Imagen enviada correctamente";
            $urlImagen = 'images/index/gallery/' . $_FILES['imagen']['name'];
            //Reseteamos los datos del formulario
            $description = "";
        }else{
            $info = "Datos erroneos";
        }
    }

    include("./views/galeria.view.php");