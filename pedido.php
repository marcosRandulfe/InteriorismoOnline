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
    private $numpedido;
    private $id_usuario;
    private $id_productor;
    private $nombre;
    private $descripcion;
    private $desing_state;
    private $factory_state;
    private $ruta_modelo;
    private $precio;
    private $urls_fotos;
    
    
    public function __construct($numpedido, $id_usuario, $id_productor, $nombre, $descripcion, $desing_state, $factory_state, $ruta_modelo, $precio, $urls_fotos) {
        $this->numpedido = $numpedido;
        $this->id_usuario = $id_usuario;
        $this->id_productor = $id_productor;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->desing_state = $desing_state;
        $this->factory_state = $factory_state;
        $this->ruta_modelo = $ruta_modelo;
        $this->precio = $precio;
        $this->urls_fotos = $urls_fotos;
    }


    

    
    public function getNumpedido() {
        return $this->numpedido;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getId_productor() {
        return $this->id_productor;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getDesing_state() {
        return $this->desing_state;
    }

    public function getFactory_state() {
        return $this->factory_state;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getUrls_fotos() {
        return $this->urls_fotos;
    }

    public function setNumpedido($numpedido): void {
        $this->numpedido = $numpedido;
    }

    public function setId_usuario($id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

    public function setId_productor($id_productor): void {
        $this->id_productor = $id_productor;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setDesing_state($desing_state): void {
        $this->desing_state = $desing_state;
    }

    public function setFactory_state($factory_state): void {
        $this->factory_state = $factory_state;
    }

    public function setPrecio($precio): void {
        $this->precio = $precio;
    }

    public function setUrls_fotos($urls_fotos): void {
        $this->urls_fotos = $urls_fotos;
    }

    public function getRuta_modelo() {
        return $this->ruta_modelo;
    }

    public function setRuta_modelo($ruta_modelo): void {
        $this->ruta_modelo = $ruta_modelo;
    }

        
    private function obtenerEstado($estado){
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
