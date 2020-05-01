<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelo3d
 *
 * @author marcos
 */
class modelo3d
{
    //put your code here
    private $diseño;
    private $articulo;
    private $modelo;
    private $version;
    
    public function __construct($diseño, $articulo, $modelo, $version)
    {
        $this->diseño = $diseño;
        $this->articulo = $articulo;
        $this->modelo = $modelo;
        $this->version = $version;
    }
    public function getDiseño()
    {
        return $this->diseño;
    }

    public function getArticulo()
    {
        return $this->articulo;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setDiseño($diseño)
    {
        $this->diseño = $diseño;
    }

    public function setArticulo($articulo)
    {
        $this->articulo = $articulo;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }
}
