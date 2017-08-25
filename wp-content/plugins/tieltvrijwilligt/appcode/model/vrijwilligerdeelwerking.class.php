<?php

class VrijwilligerDeelwerking extends \Base
{
    private $vrijwilligerDeelwerkingId;

    /*constructor in basisklasse volstaat*/

    /*set $vrijwilligerDeelwerkingId
    return true als nt leeg; return false als leeg
    */
    public function setVrijwilligerDeelwerkingId($value)
    {
        if (is_numeric($value))
        {
            $this->vrijwilligerDeelwerkingId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getVrijwilligerDeelwerkingId()
    {
        return $this->vrijwilligerDeelwerkingId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($vrId, $dwId, $vrdwInfo)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call vrijwilligerdeelwerkinginsert(@pVrijwilligerDeelwerkingId, :pVrijwilligerId, :pDeelwerkingId, :pVrDwInfo)');
            $preparedStatement->bindParam(':pVrijwilligerId', $vrId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pDeelwerkingId', $dwId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pVrDwInfo', $vrdwInfo, \PDO::PARAM_STR, 255); 
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setVrijwilligerDeelwerkingId($this->pdo->query('select @pVrijwilligerDeelwerkingId')->fetchColumn()); 
                $this->feedback="De vrijwilligerdeelwerking met id <b> " . $this->getVrijwilligerDeelwerkingId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De vrijwilligerdeelwerking is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure vrijwilligerdeelwerkinginsert is niet geslaagd."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    
    
    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    
    public function selectVrijwilligerDeelwerkingById($vrijwilligerDeelwerkingId)
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
        $preparedStatement -> bindParam(':pId', $vrijwilligerDeelwerkingId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} row(s) with id = {$vrijwilligerDeelwerkingId} in the table VrijwilligerDeelwerking has been found.";
        }
        else //retourneert lege array
        {
               $this->feedback = "No rows with id = {$vrijwilligerDeelwerkingId} found.";
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
    public function delete($vrijwilligerDeelwerkingId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call vrijwilligerdeelwerkingdelete(:pId)');
                $preparedStatement->bindParam(':pId', $vrijwilligerDeelwerkingId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "Record vrijwilligerdeelwerking {$vrijwilligerDeelwerkingId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "Record vrijwilligerdeelwerking met id = {$vrijwilligerDeelwerkingId} is niet gevonden en niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure vrijwilligerdeelwerkingdelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call vrijwilligerdeelwerkingselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle vrijwilligerdeelwerkings gelezen.';
            }
            else
            {
                $this->feedback = 'De tabel vrijwilligerdeelwerkings is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure vrijwilligerdeelwerkingselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen 
    //te wissen
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
            $this->feedback = "{$preparedStatement->rowCount()} row(s) with id = {$memberId} in the table VrijwilligerDeelwerking has been found.";
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



