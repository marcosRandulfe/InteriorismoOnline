<?php
require_once './usuario.php';
/**
 * Description of producto
 *
 * @author marcos
 */
class Productor extends Usuario{
    
    private $infotpv;
    private $direccion;

    function __construct($nombre, $passwd,$infotpv, $direccion) {
        parent::__construct($nombre, $passwd);
        $this->infotpv = $infotpv;
        $this->direccion = $direccion;
    }
    
    function getInfotpv() {
        return $this->infotpv;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function setInfotpv($infotpv): void {
        $this->infotpv = $infotpv;
    }

    function setDireccion($direccion): void {
        $this->direccion = $direccion;
    }

}
