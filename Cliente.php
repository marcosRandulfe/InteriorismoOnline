<?php

require_once 'usuario.php';

class Cliente extends Usuario {

    private $dni;
    private $nombre_completo;
    private $calle;
    private $numero;
    private $letra;

    function __construct($id_usuario,$nombre, $passwd, $dni, $nombre_completo, $calle, $numero, $piso) {
        parent::__construct($id_usuario,$nombre, $passwd);
        $this->dni = $dni;
        $this->nombre_completo = $nombre_completo;
        $this->calle = $calle;
        $this->numero = $numero;
        $this->letra = $piso;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getDni() {
        return $this->dni;
    }

    function getNombre_completo() {
        return $this->nombre_completo;
    }

    function getCalle() {
        return $this->calle;
    }

    function getNumero() {
        return $this->numero;
    }

    function getLetra() {
        return $this->letra;
    }

    function setCliente($cliente): void {
        $this->cliente = $cliente;
    }

    function setDni($dni): void {
        $this->dni = $dni;
    }

    function setNombre_completo($nombre_completo): void {
        $this->nombre_completo = $nombre_completo;
    }

    function setCalle($calle): void {
        $this->calle = $calle;
    }

    function setNumero($numero): void {
        $this->numero = $numero;
    }

    function setLetra($piso): void {
        $this->letra = $piso;
    }

    public static function dniValido($dni) {
            if (strlen($dni) != 9) {
        return false;
    }
    /* Ajustamos las letras especiales "x", "y" y "z" */
    switch(strtolower(substr($dni, 0, 1))) {
        case 'x':
            $dni = '0' + substr($dni, 1);
            break;
        case 'y':
            $dni = '1' + substr($dni, 1);
            break;
        case 'z':
            $dni = '2' + substr($dni, 1);
            break;
        }
    $numero = intval(substr($dni, 0, strlen($dni) - 1)) % 23;
    $letra = substr($dni, strlen($dni) - 1);
    return $letra == substr('TRWAGMYFPDXBNJZSQVHLCKET', $numero, 1);
    }

    public static function validate_email($email_address) {
        if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+
                      ([a-zA-Z0-9\._-]+)+$/", $email_address)) {
            return false;
        }
        return true;
    }

    public static function validarLetra($letra) {
        $resultado = preg_match_all('/[A-Za-z]/', trim($letra));
        if ($resultado == 1) {
            return true;
        }
        return false;
    }

    public function valido() {
        echo "validar letra";
        echo self::validarLetra(trim($this->getLetra()));
        echo "validar dni";
        echo self::dniValido($this->getDni());
        return (self::validarLetra(trim($this->getLetra())) and self::dniValido($this->getDni()));
    }

}
