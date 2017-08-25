<?php

class VrijwilligerInteresse extends \Base
{
    private $vrijwilligerInteresseId;

    /*constructor in basisklasse volstaat*/

    /*set $vrijwilligerInteresseId
    return true als nt leeg; return false als leeg
    */
    public function setVrijwilligerInteresseId($value)
    {
        if (is_numeric($value))
        {
            $this->vrijwilligerInteresseId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getVrijwilligerInteresseId()
    {
        return $this->vrijwilligerInteresseId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($vrId, $intId, $vrintInfo)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call vrijwilligerinteresseinsert(@pVrijwilligerInteresseId, :pVrijwilligerId, :pInteresseId, :pVrIntInfo)');
            $preparedStatement->bindParam(':pVrijwilligerId', $vrId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pInteresseId', $intId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pVrIntInfo', $vrintInfo, \PDO::PARAM_STR, 255); 
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setVrijwilligerInteresseId($this->pdo->query('select @pVrijwilligerInteresseId')->fetchColumn()); 
                $this->feedback="De vrijwilligerinteresse met id <b> " . $this->getVrijwilligerInteresseId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De vrijwilligerinteresse is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure vrijwilligerinteresseinsert is niet geslaagd."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    
    
    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    
    public function selectVrijwilligerInteresseById($vrijwilligerInteresseId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call projectmemberselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $vrijwilligerInteresseId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} row(s) with id = {$vrijwilligerInteresseId} in the table VrijwilligerInteresse has been found.";
        }
        else //retourneert lege array
        {
               $this->feedback = "No rows with id = {$vrijwilligerInteresseId} found.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "The stored procedure projectmemberselectbyid has not been executed.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }
    


    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($vrijwilligerInteresseId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call vrijwilligerinteressedelete(:pId)');
                $preparedStatement->bindParam(':pId', $vrijwilligerInteresseId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "Record vrijwilligerinteresse {$vrijwilligerInteresseId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "Record vrijwilligerinteresse met id = {$vrijwilligerInteresseId} is niet gevonden en niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure vrijwilligerinteressedelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call vrijwilligerinteresseselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle vrijwilligerinteresses gelezen.';
            }
            else
            {
                $this->feedback = 'De tabel vrijwilligerinteresses is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure vrijwilligerinteresseselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen 
    public function selectProjectsByMemberId($memberId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call SelectProjectsByMemberId(:pMemberId)');
        $preparedStatement -> bindParam(':pMemberId', $memberId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} row(s) with id = {$memberId} in the table VrijwilligerInteresse has been found.";
        }
        else //retourneert lege array
        {
               $this->feedback = "No rows with id = {$memberId} found.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "The stored procedure SelectProjectsByMemberId has not been executed.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }
    

    
}
?>



