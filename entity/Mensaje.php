<?php
require_once __DIR__ . '/Entity.php';

class Mensaje extends Entity
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
     * @var string
     */
    private $apellidos;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string 
     */
    private $email;

    /**
     * @var string
     */
    private $texto;

    public function __construct(string $nombre = '', string $apellidos = '', string $asunto = '', string $email = '', string $texto = '')
    {
        // parent::__construct();
        $this->id = null;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->asunto = $asunto;
        $this->email = $email;
        $this->texto = $texto;
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

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos){
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getAsunto()
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto)
    {
        $this->asunto = $asunto;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email = $email;
        return $this;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function setTexto (string $texto){
        $this->texto = $texto;
        return $this;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'asunto' => $this->getAsunto(),
            'email' => $this->getEmail(),
            'texto' => $this->getTexto()
        ];
    }
}