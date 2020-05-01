<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author marcos
 */
class Usuario
{

    //put your code here
    private $dni;
    private $nombre;
    private $passwd;
    private $apellidos;
    private $calle;
    private $numero;
    private $piso;
    private $num_tarjeta;

    /**
     *
     * @param type $dni
     * @param type $nombre
     * @param type $passwd
     * @param type $apellidos
     * @param type $calle
     * @param type $numero
     * @param type $piso
     * @param type $num_tarjeta
     */
    public function __construct($dni, $nombre, $passwd, $apellidos, $calle, $numero, $piso, $num_tarjeta)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->passwd = $passwd;
        $this->apellidos = $apellidos;
        $this->calle = $calle;
        $this->numero = $numero;
        $this->piso = $piso;
        $this->num_tarjeta = $num_tarjeta;
    }

    /**
     *
     * @return type
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     *
     * @param type $passwd
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    /**
     *
     * @return type
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     *
     * @return type
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     *
     * @return type
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     *
     * @return type
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     *
     * @return type
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     *
     * @return type
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     *
     * @return type
     */
    public function getNum_tarjeta()
    {
        return $this->num_tarjeta;
    }

    /**
     *
     * @param type $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     *
     * @param type $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     *
     * @param type $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     *
     * @param type $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setPiso($piso)
    {
        $this->piso = $piso;
    }

    /**
     *
     * @param type $num_tarjeta
     */
    public function setNum_tarjeta($num_tarjeta)
    {
        $this->num_tarjeta = $num_tarjeta;
    }

    /**
     *
     * @param type $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public static function dniValido()
    {
        $dni = $this->dni;
        $letra = substr($dni, -1);
        $numeros = substr($dni, 0, -1);
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
            echo 'valido';
        } else {
            echo 'no valido';
        }
    }

    /* public static function validate_email($email_address)
     {
         if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+
                      ([a-zA-Z0-9\._-]+)+$/", $email_address)) {
             return false;
         }
         return true;
     }*/

    public static function validarPiso($piso)
    {
        return preg_match("[A-Z,a-z]", $piso);
    }

    public function valido()
    {
        return (Usuario::validarPiso($this->getPiso()) and Usuario::dniValido($this->getDni()));
    }
}
