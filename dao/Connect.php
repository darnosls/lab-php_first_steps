<?php
class Connect extends PDO
{
	private $conn = null;
    public function __construct($file)
    {
    	try{
	        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');

	        $dns = $settings['database']['driver'] .':host=' . $settings['database']['host'] .
	        ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
	        ';dbname=' . $settings['database']['schema'];

	        $dbh = parent::__construct($dns, $settings['database']['username'], $settings['database']['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	        $this->conn = $dbh;
	        return $this->conn;

	    }catch(PDOException $e){
	    	//throw new MyDatabaseException( $e->getMessage( ) , (int)$e->getCode( ) );
			echo 'Conexão falhou. Erro: '.(int)$e->getCode();
			return false;
		}

    }

    //aqui é criado um objeto de fechamento da conexão
		function __destruct(){
			$this->conn = NULL;
		}
}
?>
