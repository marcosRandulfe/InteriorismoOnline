<?php
require_once('usuario.php');
require_once('Cliente.php');
require_once('./Productor.php');
require_once('pedido.php');

class Bd {
    
    private $db;
    private const host="localhost";
    private const user="usuario";
    private const passwd="abc123.";
    private const name="CARPINTERIA";
    private const NOMBRE_USUARIO="nombre";
    private const DNI_USUARIO="dni";
    private const PASSWD_USUARIO="passwd";
    private const APELLIDOS_USUARIO="apellidos";
    private const CALLE="calle";
    private const NUMERO="numero";
    private const PISO ="piso";

    private function comprobarError($resultado){
        if ($resultado==true and $resultado!=null) {
            error_log("Inserción realizada con éxito");
        } else {
            error_log("Error: ".$this->db->error);
            throw new Exception($this->db->error);
        }
   }
   
   private function escaparString($string){
       return $this->db->real_escape_string($string);
   }

    public function __construct()
    {
        $this->db= mysqli_connect(Bd::host, Bd::user, Bd::passwd, Bd::name);
        if ($this->db->connect_errno) {
            echo "Fallo de base de datos".$this->db->connect_error;
        }
        $this->db->set_charset('utf-8');
    }

    /**
        *
        * @param type $usuario
        * @param type $passwd
        * @return boolean
        */
    public function validUser($usuario, $passwd){
        $sql= "SELECT * FROM usuarios WHERE (nombre='".$this->escaparString($usuario)."' AND passwd='".$this->escaparString($passwd)."');";
        error_log("sql_usuario_valido: ".$sql);
        $resultado=$this->db->query($sql);
        if ($resultado!=false && mysqli_num_rows($resultado)>0) {
            $fila = $resultado->fetch_assoc();
            $usuario= new Usuario(
                $fila['id'],
                $fila['nombre'],
                $fila['passwd']
            );
            return $usuario;
        }
        return false;
    }

    /**
      *
      * @param type Cliente
      */
    //consulta: INSERT INTO usuarios VALUES('DNI','PASSWD','NOMBRE','APELLIDOS','CALLE',44,'B','5UIO252548048');
    public function crearCliente($usuario){
        /* @var $usuario Cliente*/
        try{
        $sql ="INSERT INTO usuarios (nombre,passwd) VALUES('".$usuario->getNombre()."','".$usuario->getPasswd()."')";
        $this->comprobarError($this->db->query($sql));
        $id_usuario=$this->db->insert_id;
        $sql =
        "INSERT INTO clientes VALUES('".
            $this->db->insert_id."','".
            $usuario->getDni()."','".
            $usuario->getNombre_completo()."','".
            $usuario->getCalle()."','".
            $usuario->getNumero()."','".
            $usuario->getLetra()."')";
          
          $resultado=$this->db->query($sql);
          $this->comprobarError($resultado);
        } catch (Exception $e){
            return false;
        }
        $usuario->setId($id_usuario);
        return $usuario;
    }

    public function getPedidos($id_usuario){
        require_once('pedido.php');
        $pedidos =[];
        /*@var $resultado  msqli_result */
        $resultado = $this->db->query("SELECT * FROM pedidos WHERE(id_usuario='".$id_usuario."');");
        while ($row = $resultado->fetch_assoc()) {
            $num_pedido=$row['num_pedido'];
            $result_fotos=$this->db->query("SELECT * FROM fotos_cliente WHERE(num_pedido='".$num_pedido."')");
            $fotos=[];
            while($fila_foto= $result_fotos->fetch_assoc()){
                $fotos[]=$fila_foto['url_foto'];
            }
            
            $pedidos[]= new pedido(
                $row['num_pedido'],
                $row['id_usuario'],
                $row['id_productor'],
                $row['nombre'],
                $row['descripcion'],
                $row['desing_state'],
                $row['factory_state'],
                $row['ruta_modelo'],
                $row['precio'],    
                $fotos);
        }
        return $pedidos;
    }

    public function crearPedidos($usuario,$pedido){
        /* @var $pedido pedido*/
        /* @var $usuario Usuario*/
        $query="INSERT INTO pedidos (id_usuario, nombre, descripcion) VALUES('".
                $usuario->getId()."','".
                $pedido->getNombre()."','".
                $pedido->getDescripcion()."');";
        echo $query;
        $resultado=$this->db->query($query);
        $this->comprobarError($resultado);
//        $result=$this->db->query("SELECT MAX(num_pedido) AS num_pedidos FROM pedidos;");
//        $row = $result->fetch_assoc();
        $num_pedidos = $this->db->insert_id;
        foreach ($pedido->getUrls_fotos() as $urlFoto){
            $query ="INSERT INTO fotos_cliente (num_pedido,url_foto) VALUES ('"
                    .$num_pedidos."','".$urlFoto."')";
            $this->db->query($query);
           // $resultado=$this->comprobarError($resultado);
        }
    }

    public function close()
    {
        $this->db->close();
    }
  /*
   *
   */
   public function comprobarNombreUsuario($nombre){
       $sql =$this->db->real_escape_string('SELECT nombre FROM USUARIOS WHERE nombre= '.$nombre);
       $result=$this->db->query($sql);
       if($result != null && $result->num_rows){
           return true;
       }
       return false;
   }
   
   /*
    * @var $usuario Usuario
    * */
   public function getCliente($usuario){
       $sql ='SELECT * FROM USUARIOS WHERE (id= '.$this->escaparString($usuario->getId()).')';
       /* @var $result mysqli_result*/
       $result=$this->db->query($sql);
       if($result != null && $result->num_rows>0){
           $fila= $result->fetch_assoc();
           return new Cliente(
                   $usuario->getNombre(),
                   $usuario->getPasswd(),
                   $fila['dni'],
                   $fila['nombre_completo'],
                   $fila['calle'],
                   $fila['nombre_completo'],
                   $fila['calle'],
                   $fila['numero'],
                   $fila['piso']
                   );
       }
       return false;
   }
   
   /*
    * @var $usuario Usuario
    * */
   public function getFotos($num_pedido){
       $fotos=[];
       $sql ='SELECT * FROM fotos_cliente WHERE num_pedido='.$this->escaparString($num_pedido).')';
       /* @var $result mysqli_result*/
       $result=$this->db->query($sql);
       if($result != null && $result->num_rows>0){
           while ($fila=$result->fetch_assoc()){
               $fotos[]=$fila['url_foto'];
           }
       }
       return $fotos;
  }
  
  public function comprobarAdmin($usuario, $passwd){
      require_once './Administrador.php';
       $fotos=[];
       $sql ="SELECT * FROM usuarios U INNER JOIN admins A ON U.id=A.id WHERE(U.nombre='".
               $this->escaparString($usuario)."' AND U.passwd='".$this->escaparString($passwd)
               ."')";
       /* @var $result mysqli_result*/
       $result=$this->db->query($sql);
       if($result != null && $result->num_rows>0){
           $fila = $result->fetch_assoc();
           return new Administrador($fila['id'],$fila['nombre'],$fila['passwd'], $fila['roles']);
       }
       return false;
  }
  
  public function listarUsuarios(){
      /* @var $result msqli_result*/
      $usuarios=[];
      $result= $this->db->query('SELECT * FROM usuarios WHERE id>3;'); 
      while($fila=$result->fetch_assoc()){
          $usuarios[]= new Usuario($fila['id'], $fila['nombre'], $fila['passwd']);
      }
      return $usuarios;
  }
    
  public function eliminarUsuario($id_usuario){
      $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
      $this->comprobarError($this->db->query("DELETE FROM pedidos WHERE(id_usuario='".$id_usuario."');"));
      $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
      $this->comprobarError($this->db->query("DELETE FROM clientes WHERE(id='".$id_usuario."');"));
      $this->comprobarError($this->db->query("DELETE FROM usuarios WHERE(id='".$id_usuario."');")); 
 
  }
 
     public function getPedido($num_pedido){
        require_once('pedido.php');
        /*@var $resultado  msqli_result */
        $resultado = $this->db->query("SELECT * FROM pedidos WHERE(num_pedido='".$num_pedido."');");
        $row = $resultado->fetch_assoc(); 
            $result_fotos=$this->db->query("SELECT * FROM fotos_cliente WHERE(num_pedido='".$num_pedido."')");
            $fotos=[];
            while($fila_foto= $result_fotos->fetch_assoc()){
                $fotos[]=$fila_foto['url_foto'];
            }
            $pedido= new pedido(
                $row['num_pedido'],
                $row['id_usuario'],
                $row['id_productor'],
                $row['nombre'],
                $row['descripcion'],
                $row['desing_state'],
                $row['factory_state'],
                $row['ruta_modelo'],
                $row['precio'],    
                $fotos);
        return $pedido;
    }
    
      public function comprobarProductor($usuario, $passwd){
      require_once './Administrador.php';
       $fotos=[];
       $sql ="SELECT * FROM usuarios U INNER JOIN productores A ON U.id=A.id WHERE(U.nombre='".
               $this->escaparString($usuario)."' AND U.passwd='".$this->escaparString($passwd)
               ."')";
       /* @var $result mysqli_result*/
       $result=$this->db->query($sql);
       if($result != null && $result->num_rows>0){
           return true;
       }
       return false;
  }
  
      public function getAllPedidos(){
        require_once('pedido.php');
        $pedidos =[];
        /*@var $resultado  msqli_result */
        $resultado = $this->db->query("SELECT * FROM pedidos;");
        while ($row = $resultado->fetch_assoc()) {
            $num_pedido=$row['num_pedido'];
            $result_fotos=$this->db->query("SELECT * FROM fotos_cliente WHERE(num_pedido='".$num_pedido."')");
            $fotos=[];
            while($fila_foto= $result_fotos->fetch_assoc()){
                $fotos[]=$fila_foto['url_foto'];
            }
            
            $pedidos[]= new pedido(
                $row['num_pedido'],
                $row['id_usuario'],
                $row['id_productor'],
                $row['nombre'],
                $row['descripcion'],
                $row['desing_state'],
                $row['factory_state'],
                $row['ruta_modelo'],
                $row['precio'],
                $fotos);
        }
        return $pedidos;
    }
    
    public function updatePedido($idPedido,$ruta_modelo,$precio){
        $update="UPDATE pedidos SET desing_state='1', factory_state='1', ruta_modelo='".
                        $ruta_modelo."', precio='".$precio."' WHERE num_pedido='".$idPedido."';";
        $this->comprobarError($this->db->query($update));
    }
 

}
?>
