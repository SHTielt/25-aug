<?php

class Vereniging extends \Base
{
    private $verenigingId;
	
    /*constructor in basisklasse volstaat*/

    /*set $verId
    return true als nt leeg; return false als leeg
    */
    public function setVerenigingId($value)
    {
        if (is_numeric($value))
        {
        	$this->verenigingId = $value;
			return TRUE;
			
        }
        else
        {
            return FALSE;
        }
    }

    public function getVerenigingId()
    {
        return $this->verenigingId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($naam, $locatie, $omschrijving, $werkingsGebied, $webSite, $facebook, $beschrijving, $actief, $wpUserId, $rechtsVormId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call vereniginginsert(@pverID, :pNaam, :pLocatie, :pOmschrijving, :pWerkingsGebied, :pWebSite, :pFacebook, :pBeschrijving, :pActief, :pWPUserId, :pRechtsVormId)');
            $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pLocatie', $locatie, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pOmschrijving', $omschrijving, \PDO::PARAM_STR);/*mysql text type*/
            $preparedStatement->bindParam(':pWerkingsGebied', $werkingsGebied, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pWebSite', $webSite, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pFacebook', $facebook, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pBeschrijving', $beschrijving, \PDO::PARAM_STR, 50);
            $preparedStatement->bindParam(':pActief', $actief, \PDO::PARAM_BOOL);
		    $preparedStatement->bindParam(':pWPUserId', $wpUserId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pRechtsVormId', $rechtsVormId, \PDO::PARAM_INT, 11);
           
            $success = $preparedStatement->execute(); 
            if ($success)
            {
            	$argument = $this->pdo->query('select @pverID')->fetchColumn();
				echo "argument: ".$argument;
                $this->setVerenigingId($argument); 
                $this->feedback="De vereniging {$naam} with id <b> " . $this->getVerenigingId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De vereniging {$naam} is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure vereniginginsert is niet gelukt."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function update($verenigingId, $naam, $locatie, $omschrijving, $werkingsGebied, $webSite, $facebook, $beschrijving, $actief, $wpUserId, $rechtsVormId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {

        try
        {
        $preparedStatement=$this->pdo->prepare('call verenigingupdate(:pVerenigingId, :pNaam, :pLocatie, :pOmschrijving, :pWerkingsGebied, :pWebSite, :pFacebook, :pBeschrijving, :pActief, :pWPUserId, :pRechtsVormId)');
        $preparedStatement->bindParam(':pVerenigingId', $verenigingId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pLocatie', $locatie, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pOmschrijving', $omschrijving, \PDO::PARAM_STR);/*mysql text type*/
        $preparedStatement->bindParam(':pWerkingsGebied', $werkingsGebied, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pWebSite', $webSite, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pFacebook', $facebook, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pBeschrijving', $beschrijving, \PDO::PARAM_STR, 50);
        $preparedStatement->bindParam(':pActief', $actief, \PDO::PARAM_BOOL);
		$preparedStatement->bindParam(':pWPUserId', $wpUserId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pRechtsVormId', $rechtsVormId, \PDO::PARAM_INT, 11);
        $success = $preparedStatement->execute();

        //$result = $preparedStatement->rowCount();
        if($success)
        {
            $this->feedback =  "Het update statement van vereniging {$verenigingId} is uitgevoerd.";
            $result = TRUE;
        }
        else//0 wordt als false opgevat
        {
            $this->feedback = "De vereniging {$verenigingId} is niet gevonden en niet gewijzigd.";
            $sQLErrorInfo = $preparedStatement->errorInfo();
            $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
            $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
             $this->feedback = "De stored procedure verenigingupdate is niet uitgevoerd.";
             $this->errorMessage=$e->getMessage();
             $this->errorCode=$e->getCode();
        }
        $this->close();
        }
        return $result;
    }

    //retourneert FALSE bij mislukken en een 2dimens array bij slagenn
    public function selectVerenigingById($verenigingId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call verenigingselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $verenigingId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met id = {$verenigingId} in de tabel sh_verenigingen is(zijn) gevonden.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen with id = {$verenigingId} gevonden.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure verenigingselectbyid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }



    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($verenigingId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call verenigingdelete(:pId)');
                /*in stored procedure staat pId als parameter; hoeft hierniet idem te zijn*/
                $preparedStatement->bindParam(':pId', $verenigingId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "De vereniging {$verenigingId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "De vereniging met id = {$verenigingId} is niet gevonden en is niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure verenigingdelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call verenigingselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle verenigingen ingelezen.';
            }
            else
            {
                $this->feedback = 'De tabel sh_verenigingen is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure verenigingselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    

      
    //retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function selectVerenigingByUserId($userId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call verenigingselectbyuserid(:pUserId)');
        $preparedStatement -> bindParam(':pUserId', $userId,  \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met userid = {$userId} gevonden in de tabel sh_verenigingen.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met userid = {$userId}.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "de stored procedure verenigingselectbyuserid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }
	
	//retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function filterVerenigingenBySector($sectorId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call FilterVerenigingenBySectorId(:pSectorId)');
        $preparedStatement -> bindParam(':pSectorId', $sectorId,  \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met sectorid = {$sectorId} gevonden in de tabel sh_verenigingen.";
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
                $this->feedback = "de stored procedure FilterVerenigingenBySectorId is niet uitgevoerd.";
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



