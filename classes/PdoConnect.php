<?php

class PdoConnect {

    private $HOST;
    private $DB;
    private $USER;
    private $PASS;
    private const CHARSET = 'utf8';

    protected static $_instance;

    protected $DSN;
    protected $OPD;
    public $PDO;

    private function __construct(){
        require_once "pdoconfig.php";

        $this->HOST = $HOST;
        $this->DB = $DB;
        $this->USER = $USER;
        $this->PASS = $PASS;

        $this->DSN = "mysql:host=". $this->HOST . ";dbname=" . $this->DB . ";charset=". self::CHARSET;
        
        $this->OPD = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        );

        $this->PDO = new PDO($this->DSN, $this->USER, $this->PASS, $this->OPD);
    }

    public static function getInstance(){

        if (self::$_instance === null) 
            self::$_instance = new self;
        
        return self::$_instance;
    }

    public function prepare($sql) {
        return $this->PDO->prepare($sql);
    }
    private function __clone(){}
    private function __wakeup(){}
}

?>