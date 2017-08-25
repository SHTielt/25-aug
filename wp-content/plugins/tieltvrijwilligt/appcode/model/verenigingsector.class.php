<?php

class VerenigingSector extends \Base
{
    private $verenigingSectorId;

    /*constructor in basisklasse volstaat*/

    /*set $verenigingSectorId
    return true als nt leeg; return false als leeg
    */
    public function setVerenigingSectorId($value)
    {
        if (is_numeric($value))
        {
            $this->verenigingSectorId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getVerenigingSectorId()
    {
        return $this->verenigingSectorId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($verId, $secId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call verenigingsectorinsert(@pVerenigingSectorId, :pVerenigingId, :pSectorId)');
            $preparedStatement->bindParam(':pVerenigingId', $verId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pSectorId', $secId, \PDO::PARAM_INT, 11);
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setVerenigingSectorId($this->pdo->query('select @pVerenigingSectorId')->fetchColumn()); 
                $this->feedback="De verenigingsector met id <b> " . $this->getVerenigingSectorId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De verenigingsector is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure verenigingsectorinsert is niet geslaagd."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    
    
    //retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function selectVerenigingSectorById($verenigingSectorId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call verenigingsectorselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $verenigingSectorId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} row(s) with id = {$verenigingSectorId} in the table sh_verenigingsectoren has been found.";
        }
        else //retourneert lege array
        {
               $this->feedback = "No rows with id = {$verenigingSectorId} found.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "The stored procedure verenigingsectorselectbyid has not been executed.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }
    


    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($verenigingSectorId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call verenigingsectordelete(:pId)');
                $preparedStatement->bindParam(':pId', $verenigingSectorId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "Record verenigingsector {$verenigingSectorId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "Record verenigingsector met id = {$verenigingSectorId} is niet gevonden en niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure verenigingsectordelete is niet uitgevoerd.";
                $this->errorMessage = $e->getMessage();
                $this->errorCode = $e->getCode();
            }
            $this->close();
        }
        return $result;
    }


    

    /*retourneert false bij mislukken; bij slagen een 2dim array*/
    /*
    public function selectAll()
    {
        $result=FALSE;

        if($this->connect())
        {
            try
            {
            $preparedStatement=$this->pdo->prepare('call verenigingsectorselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle verenigingsectoren gelezen.';
            }
            else
            {
                $this->feedback = 'De tabel sh_verenigingsectoren is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure verenigingsectorselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    */

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen 
    public function selectSectorenByVerenigingId($verenigingId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call SelectSectorenByVerenigingId(:pVerId)');
        $preparedStatement -> bindParam(':pVerId', $verenigingId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} row(s) met id = {$verenigingId} in de tabel sh_verenigingsectoren werd gevonden.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met id = {$verenigingId} found.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "The stored procedure SelectSectorenByVerenigingId has not been executed.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }
    
//retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function selectVerenigingBySectorId($sectorId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call VerenigingSectorSelectVerenigingBySectorId(:pSectorId)');
        $preparedStatement -> bindParam(':pSectorId', $sectorId,  \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met sectorid = {pSectorId} gevonden in de tabel sh_sectoren.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met sectorid = {$sectorId}.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "de stored procedure VerenigingSectorSelectVerenigingBySectorId is niet uitgevoerd.";
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



