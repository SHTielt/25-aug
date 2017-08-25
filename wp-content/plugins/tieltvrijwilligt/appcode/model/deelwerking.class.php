<?php

class Deelwerking extends \Base
{
    private $deelwerkingId;

    /*constructor in basisklasse volstaat*/

    /*set $deelwerkingId
    return true als nt leeg; return false als leeg
    */
    
    public function setDeelwerkingId($value)
    {
        if (is_numeric($value))
        {
            $this->deelwerkingId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getDeelwerkingId()
    {
        return $this->deelwerkingId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($naam, $info, $actief)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call deelwerkinginsert(@pDeelwerkingId, :pNaam, :pInfo, :pActief)');
            $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pActief', $actief, \PDO::PARAM_BOOL);
                         
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setDeelwerkingId($this->pdo->query('select @pDeelwerkingId')->fetchColumn()); 
                $this->feedback="De deelwerking {$naam} met id <b> " . $this->getDeelwerkingId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De deelwerking {$naam} is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure deelwerkinginsert is niet gelukt."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function update($deelwerkingId, $naam, $info, $actief)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {

        try
        {
        $preparedStatement=$this->pdo->prepare('call deelwerkingupdate(:pId, :pNaam, :pInfo, :pActief)');
        $preparedStatement->bindParam(':pId', $deelwerkingId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pActief', $actief, \PDO::PARAM_BOOL);
        $preparedStatement->execute();

        $result = $preparedStatement->rowCount();
        if($result)
        {
            $this->feedback =  "De deelwerking {$deelwerkingId} is gewijzigd.";
            $result = TRUE;
        }
        else
        {
            $this->feedback = "De deelwerking {$deelwerkingId} is niet gewijzigd.";
            $sQLErrorInfo = $preparedStatement->errorInfo();
            $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
            $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
             $this->feedback = "De stored procedure deelwerkingupdate is niet uitgevoerd.";
             $this->errorMessage=$e->getMessage();
             $this->errorCode=$e->getCode();
        }
        $this->close();
        }
        return $result;
    }

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    public function selectDeelwerkingById($deelwerkingId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call deelwerkingselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $deelwerkingId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met id = {$deelwerkingId} in de tabel sh_deelwerkingen is(zijn) gevonden.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met id = {$deelwerkingId} gevonden.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure deelwerkingselectbyid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }



    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($deelwerkingId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call deelwerkingdelete(:pId)');
                $preparedStatement->bindParam(':pId', $deelwerkingId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "Deelwerking {$deelwerkingId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "De deelwerking met id = {$deelwerkingId} is niet gevonden en is niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure deelwerkingdelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call deelwerkingselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle deelwerkingen ingelezen.';
            }
            else
            {
                $this->feedback = 'De tabel sh_deelwerkingen is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure deelwerkingselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    

      
    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    public function selectDeelwerkingByVrijwilligerId($vrijwilligerId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call deelwerkingselectbyvrijwilligerid(:pVrId)');
        $preparedStatement -> bindParam(':pVrId', $vrijwilligerId,  \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met vrijwilligerid = {$vrijwilligerId} gevonden in de tabel sh_deelwerkingen.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met vrijwilligerid = {$vrijwilligerId}.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure deelwerkingselectbyvrijwilligerid is niet uitgevoerd.";
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



