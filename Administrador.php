<?php
/**
 * Description of Administrador
 *
 * @author marcos
 */
require_once './usuario.php';
class Administrador extends Usuario{
  private  $roles ="";
  
  public function __construct($id,$nombre,$passwd,$roles) {
      parent::__construct($id, $nombre, $passwd);
      $this->roles = $roles;
  }

  public function getRoles() {
      return $this->roles;
  }

  public function setRoles($roles): void {
      $this->roles = $roles;
  }


  
}
