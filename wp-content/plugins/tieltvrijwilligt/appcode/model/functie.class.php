<?php

class Functie extends \Base
{
    private $functieId;

    /*constructor in basisklasse volstaat*/

    /*set $functieId
    return true als nt leeg; return false als leeg
    */
    
    public function setFunctieId($value)
    {
        if (is_numeric($value))
        {
            $this->functieId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getFunctieId()
    {
        return $this->functieId; 
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
            $preparedStatement = $this->pdo->prepare('call functieinsert(@pFunctieId, :pNaam, :pInfo)');
            $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
                                    
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setFunctieId($this->pdo->query('select @pFunctieId')->fetchColumn()); 
                $this->feedback="De functie {$naam} met id <b> " . $this->getFunctieId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De functie {$naam} is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure functieinsert is niet gelukt."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function update($functieId, $naam, $info)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {

        try
        {
        $preparedStatement=$this->pdo->prepare('call functieupdate(:pId, :pNaam, :pInfo)');
        $preparedStatement->bindParam(':pId', $functieId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
        $preparedStatement->execute();

        $result = $preparedStatement->rowCount();
        if($result)
        {
            $this->feedback =  "De functie {$functieId} is gewijzigd.";
            $result = TRUE;
        }
        else
        {
            $this->feedback = "De functie {$functieId} is niet gewijzigd.";
            $sQLErrorInfo = $preparedStatement->errorInfo();
            $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
            $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
             $this->feedback = "De stored procedure functieupdate is niet uitgevoerd.";
             $this->errorMessage=$e->getMessage();
             $this->errorCode=$e->getCode();
        }
        $this->close();
        }
        return $result;
    }

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    public function selectFunctieById($functieId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call functieselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $functieId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met id = {$functieId} in de tabel sh_functies is (zijn) gevonden.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met id = {$functieId} gevonden.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure functieselectbyid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }



    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($functieId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call functiedelete(:pId)');
                /*in stored procedure staat pId als parameter; hoeft hier niet idem te zijn*/
                $preparedStatement->bindParam(':pId', $functieId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "De functie {$functieId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "De functie met id = {$functieId} is niet gevonden en is niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure functiedelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call functieselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle functies ingelezen.';
            }
            else
            {
                $this->feedback = 'De tabel sh_functies is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure functieselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    

      
    
}
?>



