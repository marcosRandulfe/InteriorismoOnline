<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pedido
 *
 * @author marcos
 */
class pedido
{
    private $dni;
    private $numpedido;
    private $nombre;
    private $descripcion;
    private $urls_fotos;
    private $desing_state;
    private $factory_state;
    private $precio;

    public function __construct($dni, $numpedido, $nombre, $descripcion, $urls_fotos, $desing_state, $factory_state, $precio)
    {
        $this->dni = $dni;
        $this->numpedido = $numpedido;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->urls_fotos = $urls_fotos;
        $this->desing_state = $desing_state;
        $this->factory_state = $factory_state;
        $this->precio = $precio;
    }
    
    
    
    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    
    
    public function getDni()
    {
        return $this->dni;
    }

    public function getNumpedido()
    {
        return $this->numpedido;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getUrls_fotos()
    {
        return $this->urls_fotos;
    }

    public function getDesing_state()
    {
        return $this->desing_state;
    }

    public function getFactory_state()
    {
        return $this->factory_state;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function setNumpedido($numpedido)
    {
        $this->numpedido = $numpedido;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setUrls_fotos($urls_fotos)
    {
        $this->urls_fotos = $urls_fotos;
    }

    public function setDesing_state($desing_state)
    {
        $this->desing_state = $desing_state;
    }

    public function setFactory_state($factory_state)
    {
        $this->factory_state = $factory_state;
    }
    
    private function obtenerEstado($estado)
    {
        switch ($estado) {
            case 0:
                return "pediente";
            case 1:
                return "realizado";
            default:
                return "en proceso";
        }
    }
}
