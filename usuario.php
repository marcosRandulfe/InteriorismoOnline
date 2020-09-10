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
    private $id;
    private $nombre;
    private $passwd;

    /**
     * @param type $nombre
     * @param type $passwd
     */
    public function __construct($id,$nombre, $passwd){
        $this->id=$id;
        $this->nombre = $nombre;
        $this->passwd = $passwd;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

        
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
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
    public function setPasswd($passwd){
        $this->passwd = $passwd;
    }
    
}
