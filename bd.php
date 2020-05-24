<?php
require_once('usuario.php');
require_once('pedido.php');

class Bd
{
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
    private const NUM_TARJ="num_tarjeta";

    private function comprobarError($resultado){
        if ($resultado==true) {
            echo "Inserción realizada con éxito";
        } else {
            echo "Error: ".$this->db->error;
        }
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
    public function validUser($usuario, $passwd)
    {
        $sql= "SELECT * FROM usuarios WHERE (nombre='".$usuario."' AND passwd='". $passwd ."');";
        echo $sql;
        //$sql = $this->bd->mysqli_real_escape_string($sql);
        $resultado=$this->db->query($sql);
        echo var_dump($resultado);
        if (mysqli_num_rows($resultado)>0) {
            $fila = $resultado->fetch_assoc();
            return new Usuario(
                $fila['dni'],
                $fila['nombre'],
                $fila['passwd'],
                $fila['apellidos'],
                $fila['calle'],
                $fila['numero'],
                $fila['piso'],
                $fila['num_tarjeta']
            );
        }
        return false;
    }

    /**
      *
      * @param type Usuario
     *
      */
    //consulta: INSERT INTO usuarios VALUES('DNI','PASSWD','NOMBRE','APELLIDOS','CALLE',44,'B','5UIO252548048');
    public function crearUsuario($usuario)
    {
        /* @var $usuario Usuario*/
        $sql ="INSERT INTO usuarios (nombre,passwd) VALUES('".$usuario->getNombre()."','".$usuario->getPasswd()."')";
        $this->comprobarError($this->db->query($sql));
        $sql =
        "INSERT INTO clientes VALUES('".
            $this->db->insert_id."','".
            $usuario->getDni()."','".
            $usuario->getNombre()." ".$usuario->getApellidos()."','".
            $usuario->getCalle()."','".
            $usuario->getNumero()."','".
            $usuario->getPiso()."','".
            $usuario->getNum_tarjeta()."')";
          echo "<br/>$sql<br/>";
          $this->comprobarError($this->db->query($sql));
    }

    public function getPedidos(){
        require_once('pedido.php');
        $pedidos =[];
        /*@var $resultado  msqli_result */
        $resultado = $this->db->query("SELECT * FROM pedidos;");
        while ($row = $resultado->fetch_assoc()) {
            $pedidos[]= new pedido(
                $row['dni'],
                $row['num_pedido'],
                $row['nombre'],
                $row['descripcion'],
                null,
                $row['desing_state'],
                $row['factory_state'],
                $row['precio']
                );
        }
        return $pedidos;
    }

    public function crearPedidos($pedido)
    {
        /* @var $pedido pedido*/
        $query="INSERT INTO pedidos (dni,nombre, descripcion, desing_state, factory_state, precio) VALUES('".
                $pedido->getDni()."','".
                $pedido->getNombre()."','".
                $pedido->getDescripcion()."','".
                $pedido->getDesing_state()."','".
                $pedido->getFactory_state()."','".
                $pedido->getPrecio()
                ."');";
        /*  echo '<br/>';
          echo $query;*/
        $this->db->query($query);
        /*  if ($this->db->errno) {
              echo $this->db->error;
          }*/
        $result=$this->db->query("SELECT MAX(num_pedido) AS num_pedidos FROM pedidos;");
        /* if ($this->db->errno) {
             echo $this->db->error;
         }*/
        $row = $result->fetch_assoc();
        $num_pedidos = $row['num_pedidos'];
        $query ="INSERT INTO fotos_cliente (dni_usuario,num_pedido,url_foto,num_foto) VALUES ('".$pedido->getDni()
                ."','".$num_pedidos."','".$pedido->getUrls_fotos()[0]."','1')";
        /*echo "<br/>";
        echo $query;
        echo "<br/>";
         *
         */
        $this->db->query($query);

        /*  if ($this->db->errno) {
              echo $this->db->error;
          }*/
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




}
