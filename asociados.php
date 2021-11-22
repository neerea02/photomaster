<?php
    $title = "Asociados";
    require_once "./utils/utils.php";
    require_once "./utils/Forms/InputElement.php";
    require_once "./utils/Forms/TextareaElement.php";
    require_once "./utils/Forms/ButtonElement.php";
    require_once "./utils/Forms/FileElement.php";
    require_once "./utils/Forms/FormElement.php";
    require_once "./utils/Forms/custom/MyFormGroup.php";
    require_once "./utils/Forms/custom/MyFormControl.php";
    require_once "./utils/Validator/NotEmptyValidator.php";
    require_once "./utils/Validator/MimetypeValidator.php";
    require_once "./utils/Validator/MaxSizeValidator.php";    
    require_once "./exceptions/FileException.php";
    require_once "./utils/SimpleImage.php";
    require_once "./entity/Asociado.php";
    require_once "./core/App.php";
    require_once "./database/Connection.php";
    require_once "./database/QueryBuilder.php";
    require_once "./repository/AsociadoRepository.php";
    
    $config = require_once 'app/config.php';
    App::bind('config', $config);
    App::bind('connection', Connection::make($config['database']));


    $repositorio = new AsociadoRepository();

    $info = $urlImagen = "";

    $nombre = new InputElement('text');
    $nombre
     ->setName('nombre')
     ->setId('nombre')
     ->setValidator(new NotEmptyValidator('El nombre es obligatorio', true));
    $nombreWrapper = new MyFormControl($nombre, 'Nombre', 'col-xs-12');

    $description = new TextareaElement();
    $description
     ->setName('descripcion')
     ->setId('descripcion');
    $descriptionWrapper = new MyFormControl($description, 'Descripción', 'col-xs-12');

    $fv = new MimetypeValidator(['image/jpeg', 'image/jpg', 'image/png'], 'Formato no soportado', true);
    $fv->setNextValidator(new MaxSizeValidator(2 * 1024 * 1024, 'El archivo no debe exceder 2M', true));

    $file = new FileElement();
    $file
      ->setName('imagen')
      ->setId('imagen')
      ->setValidator($fv);

    $labelFile = new LabelElement('Imagen', $file);

    $b = new ButtonElement('Send');
    $b->setCssClass('pull-right btn btn-lg sr-button');

    $form = new FormElement('', 'multipart/form-data');
    $form
    ->setCssClass('form-horizontal')
    ->appendChild($labelFile)
    ->appendChild($file)
    ->appendChild($nombreWrapper)
    ->appendChild($descriptionWrapper)
    ->appendChild($b);

    if ("POST" === $_SERVER["REQUEST_METHOD"]) {
        $form->validate();
        if (!$form->hasError()) {
          try {
            $file->saveUploadedFile(Asociado::RUTA_IMAGENES_ASOCIADO);  
              // Create a new SimpleImage object
              $simpleImage = new \claviska\SimpleImage();
              $simpleImage
              ->fromFile(Asociado::RUTA_IMAGENES_ASOCIADO . $file->getFileName())  
              ->resize(50, 50)
              ->toFile(Asociado::RUTA_IMAGENES_ASOCIADO . $file->getFileName());

              //Grabamos en la base de datos
              $urlImagen = Asociado::RUTA_IMAGENES_ASOCIADO . $file->getFileName();
              $asociado = new Asociado($nombre->getValue(), $file->getFileName(), $description->getValue());
              $repositorio->save($asociado);
              $info = 'Asociado enviado correctamente'; 
              $form->reset();
            
          }catch(Exception $err) {
              $form->addError($err->getMessage());
              $imagenErr = true;
          }
        }else{
          
        }
    }    
    include("./views/asociados.view.php");