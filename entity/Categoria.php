<?php
require_once __DIR__ . '/Entity.php';

class Categoria extends Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var int
     */
    private $numImagenes;

    public function __construct(string $nombre = '', int $numImagenes = 0)
    {
        // parent::__construct();
        $this->id = null;
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }

    //Setters y getters

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getNumImagenes()
    {
        return $this->numImagenes;
    }

    public function setNumImagenes(int $numImagenes)
    {
        $this->numImagenes = $numImagenes;
        return $this;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'numImagenes' => $this->getNumImagenes()
        ];
    }
}