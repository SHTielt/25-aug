<?php
class Base extends \Feedback
{

protected $pdo;
protected $rowCount;


public function __construct()
{
    \Feedback::__construct();
}


public function connect()
{
    $result=FALSE;
    try
    {
        $connectionString = 'mysql:host=localhost:3306;dbname=sociaalhuis';
        $userName="root";
        $password="";
        $this->pdo = new \PDO($connectionString, $userName, $password);
        $this->feedback = 'Met databank verbonden.';
        $result=TRUE;
                      
    }
    catch(\PDOException $e)
    {
        $this->feedback='Niet met databank verbonden.';
        $this->errorMessage=$e->getMessage();
        $this->errorCode=$e->getCode();
    }
    return $result;
}


//close methode sluit de databankverbinding
public function close()
{
    $this->pdo=NULL;
}

}

?>


