<?php

class Sector extends \Base
{
    private $sectorId;

    /*constructor in basisklasse volstaat*/

    /*set $sectorId
    return true als nt leeg; return false als leeg
    */
    
    public function setSectorId($value)
    {
        if (is_numeric($value))
        {
            $this->sectorId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getSectorId()
    {
        return $this->sectorId; 
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
            $preparedStatement = $this->pdo->prepare('call sectorinsert(@pSectorId, :pNaam, :pInfo)');
            $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
                                    
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setSectorId($this->pdo->query('select @pSectorId')->fetchColumn()); 
                $this->feedback="De sector {$naam} met id <b> " . $this->getSectorId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De sector {$naam} is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure sectorinsert is niet gelukt."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function update($sectorId, $naam, $info)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {

        try
        {
        $preparedStatement=$this->pdo->prepare('call sectorupdate(:pId, :pNaam, :pInfo)');
        $preparedStatement->bindParam(':pId', $sectorId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
        $success = $preparedStatement->execute();

        //$result = $preparedStatement->rowCount();
        if($success)
        {
            $this->feedback =  "Het update statement van sector {$sectorId} is uitgevoerd.";
            $result = TRUE;
        }
        else
        {
            $this->feedback = "De sector {$sectorId} is niet gewijzigd.";
            $sQLErrorInfo = $preparedStatement->errorInfo();
            $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
            $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
             $this->feedback = "De stored procedure sectorupdate is niet uitgevoerd.";
             $this->errorMessage=$e->getMessage();
             $this->errorCode=$e->getCode();
        }
        $this->close();
        }
        return $result;
    }

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function selectSectorById($sectorId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call sectorselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $sectorId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met id = {$sectorId} in de tabel sh_sectoren is (zijn) gevonden.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met id = {$sectorId} gevonden.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure sectorselectbyid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }



    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($sectorId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call sectordelete(:pId)');
                /*in stored procedure staat pId als parameter; hoeft hier niet idem te zijn*/
                $preparedStatement->bindParam(':pId', $sectorId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "De sector {$sectorId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "De sector met id = {$sectorId} is niet gevonden en is niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure sectordelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call sectorselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle sectoren ingelezen.';
            }
            else
            {
                $this->feedback = 'De tabel sh_sectoren is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure sectorselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    

      
    
}
?>



