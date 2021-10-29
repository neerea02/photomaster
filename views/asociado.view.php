<?php
    include __DIR__ . "/partials/inicio-doc.part.php";
    include __DIR__ . "/partials/nav.part.php";
?>

<div id="asociados">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>Asociados</h1>
            <hr>
			<?php 
				include __DIR__ . "/partials/show-messages.part.php";
			?>

	       <form class="form-horizontal" action="/asociados.php" method="POST" enctype="multipart/form-data">
	       	  <div class="form-group">
	       	  	<div class="col-xs-12">
					<label class="label-control" for="imagen">Imagen</label>
					<input class="form-control-file" type="file" name="imagen">
	       	  	</div>
	       	  </div>
	       	  <div class="form-group">
	       	  	<div class="col-xs-12">
                    <label class="label-control" for="nombre">Nombre</label>
					<textarea class="form-control" name="nombre" id="nombre"><?= $nombre;?></textarea>
                    <label class="label-control" for="description">Descripcion</label>
					<textarea class="form-control" name="description" id="description"><?= $description;?></textarea>
					<button class="pull-right btn btn-lg sr-button">ENVIAR</button>
	       	  	</div>
	       	  </div>
	       </form>
	    </div>
    </div>
</div>   

<?php
  include __DIR__ . "/partials/fin-doc.part.php";
?>