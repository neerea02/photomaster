<?php
require_once __DIR__ . '/../entity/ImagenGaleria.php';
require_once __DIR__ . '/../database/QueryBuilder.php';

class ImagenGaleriaRepository extends QueryBuilder{
    public function __construct()
    {
        parent::__construct('imagenes', 'ImagenGaleria');
    }

    public function getCategoria(ImagenGaleria $imagenGaleria): Categoria{
        $repositorioCategoria = new CategoriaRepository();
        return $repositorioCategoria->findById($imagenGaleria->getCategoria());
    }

    /**
     * @param Entity $imagenGaleria 
     * @throws QueryException
     */
    public function save(Entity $imagenGaleria){
        $fnGuardarImagen = function () use ($imagenGaleria){
            $categoria = $this->getCategoria($imagenGaleria);
            $repositorioCategoria = new CategoriaRepository();
            $repositorioCategoria->nuevaImagen($categoria);
            parent::save($imagenGaleria);
        };
        $this->executeTransaction($fnGuardarImagen);
    }
}