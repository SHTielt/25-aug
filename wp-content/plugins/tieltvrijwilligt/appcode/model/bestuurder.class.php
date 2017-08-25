<?php

class Bestuurder extends \Base
{
    private $bestuurderId;

    /*constructor in basisklasse volstaat*/

    /*set $bestuurderId
    return true als nt leeg; return false als leeg
    */
    public function setBestuurderId($value)
    {
        if (is_numeric($value))
        {
            $this->bestuurderId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getBestuurderId()
    {
        return $this->bestuurderId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $funcId, $verId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call bestuurderinsert(@pBestuurderId, :pVoornaam, :pNaam, :pInfo, :pEmail, :pGSM, :pTelefoon, :pContactVoorkeurId, :pFuncId, :pVerId)');
            $preparedStatement->bindParam(':pVoornaam', $voornaam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pEmail', $email, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pGSM', $gsm, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pTelefoon', $telefoon, \PDO::PARAM_STR, 255);
			$preparedStatement->bindParam(':pContactVoorkeurId', $contactVoorkeurId, \PDO::PARAM_INT, 11);
		    $preparedStatement->bindParam(':pFuncId', $funcId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pVerId', $verId, \PDO::PARAM_INT, 11);
             
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setBestuurderId($this->pdo->query('select @pBestuurderId')->fetchColumn()); 
                $this->feedback="De bestuurder {$voornaam} {$naam} with id <b> " . $this->getBestuurderId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De bestuurder {$voornaam} {$naam} is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure bestuurderinsert is niet gelukt."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function update($bestuurderId, $voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $funcId, $verId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {

        try
        {
        $preparedStatement=$this->pdo->prepare('call bestuurderupdate(:pBestuurderId, :pVoornaam, :pNaam, :pInfo, :pEmail, :pGSM, :pTelefoon, :pContactVoorkeurId, :pFuncId, :pVerId)');
        $preparedStatement->bindParam(':pBestuurderId', $bestuurderId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pVoornaam', $voornaam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pEmail', $email, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pGSM', $gsm, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pTelefoon', $telefoon, \PDO::PARAM_STR, 255);
	    $preparedStatement->bindParam(':pContactVoorkeurId', $contactVoorkeurId, \PDO::PARAM_INT, 11);
	    $preparedStatement->bindParam(':pFuncId', $funcId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pVerId', $verId, \PDO::PARAM_INT, 11);
        $success = $preparedStatement->execute();

        //$result = $preparedStatement->rowCount();
        if($success)
        {
            $this->feedback =  "Het update statement van bestuurder {$bestuurderId} is uitgevoerd.";
            $result = TRUE;
        }
        else
        {
            $this->feedback = "De bestuurder {$bestuurderId} is niet gevonden en niet gewijzigd.";
            $sQLErrorInfo = $preparedStatement->errorInfo();
            $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
            $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
             $this->feedback = "De stored procedure bestuurderupdate is niet uitgevoerd.";
             $this->errorMessage=$e->getMessage();
             $this->errorCode=$e->getCode();
        }
        $this->close();
        }
        return $result;
    }

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function selectBestuurderById($bestuurderId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call bestuurderselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $bestuurderId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met id = {$bestuurderId} in de tabel Bestuurder is(zijn) gevonden.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen with id = {$bestuurderId} gevonden.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure bestuurderselectbyid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }



    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($bestuurderId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call bestuurderdelete(:pId)');
                /*in stored procedure staat pId als parameter; hoeft hierniet idem te zijn*/
                $preparedStatement->bindParam(':pId', $bestuurderId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "bestuurder {$bestuurderId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "De bestuurder met id = {$bestuurderId} is niet gevonden en is niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure bestuurderdelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call bestuurderselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle bestuurders ingelezen.';
            }
            else
            {
                $this->feedback = 'De tabel bestuurder is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure bestuurderselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    
	//retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function selectBestuurderByVerenigingId($verenigingId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call bestuurderselectbyverenigingid(:pverId)');
        $preparedStatement -> bindParam(':pverId', $verenigingId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met id = {$verenigingId} in de tabel Bestuurder is(zijn) gevonden.";
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
                $this->feedback = "De stored procedure bestuurderselectbyverenigingid is niet uitgevoerd.";
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



