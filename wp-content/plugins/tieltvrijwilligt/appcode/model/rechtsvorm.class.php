<?php

class RechtsVorm extends \Base
{
    private $rechtsVormId;

    /*constructor in basisklasse volstaat*/

    /*set $rechtsVormId
    return true als nt leeg; return false als leeg
    */
    
    public function setRechtsVormId($value)
    {
        if (is_numeric($value))
        {
            $this->rechtsVormId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getRechtsVormId()
    {
        return $this->rechtsVormId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($naam, $info)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call rechtsvorminsert(@pRechtsVormId, :pNaam, :pInfo)');
            $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
                                    
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setRechtsVormId($this->pdo->query('select @pRechtsVormId')->fetchColumn()); 
                $this->feedback="De rechtsvorm {$naam} met id <b> " . $this->getRechtsVormId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De rechtsvorm {$naam} is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure rechtsvorminsert is niet gelukt."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function update($rechtsVormId, $naam, $info)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {

        try
        {
        $preparedStatement=$this->pdo->prepare('call rechtsvormupdate(:pId, :pNaam, :pInfo)');
        $preparedStatement->bindParam(':pId', $rechtsVormId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
        $success = $preparedStatement->execute();

        //$result = $preparedStatement->rowCount();
        if($success)
        {
            $this->feedback =  "Het update statement van rechtsvorm {$rechtsVormId} is uitgevoerd.";
            $result = TRUE;
        }
        else
        {
            $this->feedback = "De rechtsvorm {$rechtsVormId} is niet gewijzigd.";
            $sQLErrorInfo = $preparedStatement->errorInfo();
            $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
            $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
             $this->feedback = "De stored procedure rechtsvormupdate is niet uitgevoerd.";
             $this->errorMessage=$e->getMessage();
             $this->errorCode=$e->getCode();
        }
        $this->close();
        }
        return $result;
    }

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    public function selectRechtsVormById($rechtsVormId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call rechtsvormselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $rechtsVormId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met id = {$rechtsVormId} in de tabel sh_rechtsvormen is(zijn) gevonden.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met id = {$rechtsVormId} gevonden.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure rechtsvormselectbyid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }



    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($rechtsVormId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call rechtsvormdelete(:pId)');
                /*in stored procedure staat pId als parameter; hoeft hier niet idem te zijn*/
                $preparedStatement->bindParam(':pId', $rechtsVormId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "Rechtsvorm {$rechtsVormId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "De rechtsvorm met id = {$rechtsVormId} is niet gevonden en is niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure rechtsvormdelete is niet uitgevoerd.";
                $this->errorMessage = $e->getMessage();
                $this->errorCode = $e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert false bij mislukken; bij slagen een 2dim array*/
    public function selectAll()
    {
        $result=FALSE;

        if($this->connect())
        {
            try
            {
            $preparedStatement=$this->pdo->prepare('call rechtsvormselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle rechtsvormen ingelezen.';
            }
            else
            {
                $this->feedback = 'De tabel rs_rechtsvormen is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure rechtsvormselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    

      
    
}
?>



