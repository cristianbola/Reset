<?php
require_once 'connect.php';
$conexion = new Conexion();
require_once 'gets.php';
class usuario {
	private $email;
	private $pass;
	private $nom;
	private $ape;
	private $prog;
	private $id;
	
	const TABLA = 'usuario';
	
	public function __construct($email, $pass, $nom, $ape, $prog,$curso) {
		$this->email=$email;
		$this->pass=$pass;
		$this->nom=$nom;
		$this->ape=$ape;
		$this->prog=$prog;
		$this->curso=$curso;
		
	}
	//metodos get
	 public function getEmail() {
      return $this->email;
   }
    public function getPass() {
      return $this->pass;
   }
    public function getNom() {
      return $this->nom;
   }
    public function getApe() {
      return $this->ape;
   }
    public function getProg() {
      return $this->prog;
   }
	
	//metodos set
	
	 public function setEmail($email) {
      $this->email= $email;
   }
    public function setPass($pass) {
      $this->pass = $pass;
   }
    public function setNom($nom) {
      $this->nom = $nom;
   }
    public function setApe($ape) {
      $this->ape = $ape;
   }
    public function setProg($prog) {
      $this->prog = $prog;
   }
   
   public function guardar(){
   $conexion = new Conexion();
   $consulta = $conexion->prepare('INSERT INTO '. self::TABLA .' (email, pass, nombre, apellido, programa,curso,ciudad) VALUES(:email, :pass, :nombre, :apellido, :programa, :curso, 199)');
   $consulta->bindParam(':email', $this->email);
   $consulta->bindParam(':pass', $this->pass);
   $consulta->bindParam(':nombre', $this->nom);
   $consulta->bindParam(':apellido', $this->ape);
   $consulta->bindParam(':programa', $this->prog);
   $consulta->bindParam(':curso', $this->curso);
   $error=$consulta->execute();
   $this->id = $conexion->lastInsertId();
   $conexion = null;
   return $error;
   }
   
   
   public function joinGroup(){
	   
	$conexion = new Conexion();
	$consulta = $conexion->prepare('INSERT INTO usuario_grupo (`id_usuario`, `id_grupos`, `activo`) VALUES(:idUsr, :idGpo, 1)');
	$consulta->bindParam(':idUsr', $this->id );   
	$consulta->bindParam(':idGpo', $this->prog);
	$consulta->execute();
	$consulta1 = $conexion->prepare('INSERT INTO usuario_grupo (`id_usuario`, `id_grupos`, `activo`) VALUES(:idUsr, :idGpo, 1)');
	$consulta1->bindParam(':idUsr', $this->id );   
	$consulta1->bindParam(':idGpo', $this->curso);
	$consulta1->execute();
	
   }
   
 
  
  
	
	
	
	
	} //fin clase usuarios


		

?>