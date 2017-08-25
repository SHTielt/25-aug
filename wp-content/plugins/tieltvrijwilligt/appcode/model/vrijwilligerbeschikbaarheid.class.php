<?php

class VrijwilligerBeschikbaarheid extends \Base
{
    private $vrijwilligerBeschikbaarheidId;

    /*constructor in basisklasse volstaat*/

    /*set $vrijwilligerBeschikbaarheidId
    return true als nt leeg; return false als leeg
    */
    public function setVrijwilligerBeschikbaarheidId($value)
    {
        if (is_numeric($value))
        {
            $this->vrijwilligerBeschikbaarheidId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getVrijwilligerBeschikbaarheidId()
    {
        return $this->vrijwilligerBeschikbaarheidId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($vrId, $bsbId, $vrbsbInfo)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call vrijwilligerbeschikbaarheidinsert(@pVrijwilligerBeschikbaarheidId, :pVrijwilligerId, :pBeschikbaarheidId, :pVrBsbInfo)');
            $preparedStatement->bindParam(':pVrijwilligerId', $vrId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pBeschikbaarheidId', $bsbId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pVrBsbInfo', $vrbsbInfo, \PDO::PARAM_STR, 255); 
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setVrijwilligerBeschikbaarheidId($this->pdo->query('select @pVrijwilligerBeschikbaarheidId')->fetchColumn()); 
                $this->feedback="De vrijwilligerbeschikbaarheid met id <b> " . $this->getVrijwilligerBeschikbaarheidId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De vrijwilligerbeschikbaarheid is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure vrijwilligerbeschikbaarheidinsert is niet geslaagd."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    
    
    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    
    public function selectVrijwilligerBeschikbaarheidById($vrijwilligerBeschikbaarheidId)
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
        $preparedStatement -> bindParam(':pId', $vrijwilligerBeschikbaarheidId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} row(s) with id = {$vrijwilligerBeschikbaarheidId} in the table VrijwilligerBeschikbaarheid has been found.";
        }
        else //retourneert lege array
        {
               $this->feedback = "No rows with id = {$vrijwilligerBeschikbaarheidId} found.";
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
    public function delete($vrijwilligerBeschikbaarheidId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call vrijwilligerbeschikbaarheiddelete(:pId)');
                $preparedStatement->bindParam(':pId', $vrijwilligerBeschikbaarheidId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "Record vrijwilligerbeschikbaarheid {$vrijwilligerBeschikbaarheidId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "Record vrijwilligerbeschikbaarheid met id = {$vrijwilligerBeschikbaarheidId} is niet gevonden en niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure vrijwilligerbeschikbaarheiddelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call vrijwilligerbeschikbaarheidselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle vrijwilligerbeschikbaarheids gelezen.';
            }
            else
            {
                $this->feedback = 'De tabel vrijwilligerbeschikbaarheids is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure vrijwilligerbeschikbaarheidselectall is niet uitgevoerd.";
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
            $this->feedback = "{$preparedStatement->rowCount()} row(s) with id = {$memberId} in the table VrijwilligerBeschikbaarheid has been found.";
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



