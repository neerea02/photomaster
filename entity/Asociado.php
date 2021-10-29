<?php
class Asociado {

    const RUTA_IMAGENES_INDEX = 'images/index/';
    //....  

    /**
     * Devuelve el path a las imágenes del portfolio
     *
     * @return string
     */

    public function getUrlIndex() : string {
        return self::RUTA_IMAGENES_INDEX . $this->getLogo();
    }

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $description;

    public function __construct(string $nombre, string $logo, string $description){
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->description = $description;
    }

    /**
     * Get the value of nombre
     *
     * @return  string
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @param  string  $nombre
     *
     * @return  self
     */ 
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of logo
     *
     * @return  string
     */ 
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set the value of logo
     *
     * @param  string  $logo
     *
     * @return  self
     */ 
    public function setLogo(string $logo)
    {
        $this->logo = $logo;

        return $this;
    }

        /**
     * Get the value of descripcion
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of descripcion
     *
     * @param  string  $descripcion
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }
}