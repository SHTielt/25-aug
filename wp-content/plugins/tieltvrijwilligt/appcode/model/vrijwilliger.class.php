<?php

class Vrijwilliger extends \Base
{
    private $vrijwilligerId;

    /*constructor in basisklasse volstaat*/

    /*set $vrijwilligerId
    return true als nt leeg; return false als leeg
    */
    public function setVrijwilligerId($value)
    {
        if (is_numeric($value))
        {
            $this->vrijwilligerId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getVrijwilligerId()
    {
        return $this->vrijwilligerId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($voornaam, $naam, $adres, $postCode, $gemeente, $geboorteDatum, $email, $gsm, $telefoon, $info, $foto, $comment, $actief, $statusId, $contactVoorkeurId, $wpUserId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call vrijwilligerinsert(@pVrijwilligerId, :pVoornaam, :pNaam, :pAdres, :pPostCode, :pGemeente, :pGeboorteDatum, :pEmail, :pGSM, :pTelefoon, :pInfo, :pFoto, :pComment, :pActief, :pStatusId, :pContactVoorkeurId, :pWPUserId)');
            $preparedStatement->bindParam(':pVoornaam', $voornaam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pAdres', $adres, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pPostCode', $postCode, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pGemeente', $gemeente, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pGeboorteDatum', $geboorteDatum, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pEmail', $email, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pGSM', $gsm, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pTelefoon', $telefoon, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pFoto', $foto, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pComment', $comment, \PDO::PARAM_STR, 255);
            $preparedStatement->bindParam(':pActief', $actief, \PDO::PARAM_BOOL);
            $preparedStatement->bindParam(':pStatusId', $statusId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pContactVoorkeurId', $contactVoorkeurId, \PDO::PARAM_INT, 11);
            $preparedStatement->bindParam(':pWPUserId', $wpUserId, \PDO::PARAM_INT, 11);
             
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setVrijwilligerId($this->pdo->query('select @pVrijwilligerId')->fetchColumn()); 
                $this->feedback="De vrijwilliger {$voornaam} {$naam} with id <b> " . $this->getVrijwilligerId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De vrijwilliger {$voornaam} {$naam} is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure vrijwilligerinsert is niet gelukt."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function update($vrijwilligerId, $voornaam, $naam, $adres, $postCode, $gemeente, $geboorteDatum, $email, $gsm, $telefoon, $info, $foto, $comment, $actief, $statusId, $contactVoorkeurId, $wpUserId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {

        try
        {
        $preparedStatement=$this->pdo->prepare('call vrijwilligerupdate(:pId, :pVoornaam, :pNaam, :pAdres, :pPostCode, :pGemeente, :pGeboorteDatum, :pEmail, :pGSM, :pTelefoon, :pInfo, :pFoto, :pComment, :pActief, :pStatusId, :pContactVoorkeurId, :pWPUserId)');
        $preparedStatement->bindParam(':pId', $vrijwilligerId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pVoornaam', $voornaam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pAdres', $adres, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pPostCode', $postCode, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pGemeente', $gemeente, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pGeboorteDatum', $geboorteDatum, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pEmail', $email, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pGSM', $gsm, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pTelefoon', $telefoon, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pInfo', $info, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pFoto', $foto, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pComment', $comment, \PDO::PARAM_STR, 255);
        $preparedStatement->bindParam(':pActief', $actief, \PDO::PARAM_BOOL);
        $preparedStatement->bindParam(':pStatusId', $statusId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pContactVoorkeurId', $contactVoorkeurId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pWPUserId', $wpUserId, \PDO::PARAM_INT, 11);
        $success = $preparedStatement->execute();

        //$result = $preparedStatement->rowCount();
        if($success)
        {
            $this->feedback =  "Het update statement van vrijwilliger {$vrijwilligerId} is uitgevoerd.";
            $result = TRUE;
        }
        else
        {
            $this->feedback = "De vrijwilliger {$vrijwilligerId} is niet gevonden en niet gewijzigd.";
            $sQLErrorInfo = $preparedStatement->errorInfo();
            $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
            $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
             $this->feedback = "De stored procedure vrijwilligerupdate is niet uitgevoerd.";
             $this->errorMessage=$e->getMessage();
             $this->errorCode=$e->getCode();
        }
        $this->close();
        }
        return $result;
    }

    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    public function selectVrijwilligerById($vrijwilligerId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call vrijwilligerselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $vrijwilligerId, \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met id = {$vrijwilligerId} in de tabel Vrijwilliger is(zijn) gevonden.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen with id = {$vrijwilligerId} gevonden.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure vrijwilligerselectbyid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }



    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($vrijwilligerId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call vrijwilligerdelete(:pId)');
                /*in stored procedure staat pId als parameter; hoeft hierniet idem te zijn*/
                $preparedStatement->bindParam(':pId', $vrijwilligerId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "vrijwilliger {$vrijwilligerId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "De vrijwilliger met id = {$vrijwilligerId} is niet gevonden en is niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure vrijwilligerdelete is niet uitgevoerd.";
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
            $preparedStatement=$this->pdo->prepare('call vrijwilligerselectall');
            $preparedStatement->execute();
            if ($result = $preparedStatement->fetchAll())
            {
                $this->feedback = 'Alle vrijwilligers ingelezen.';
            }
            else
            {
                $this->feedback = 'De tabel vrijwilliger is leeg.';
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
            }
            }
            catch (\PDOException $ex)
            {
                $this->feedback = "De stored procedure vrijwilligerselectall is niet uitgevoerd.";
                $this->errorMessage=$ex->getMessage();
                $this->errorCode=$ex->getCode();
            }
            $this->close();
        }
        return $result;
    }
    

      
    //retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    public function selectVrijwilligerByUserId($userId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call vrijwilligerselectbyuserid(:pUserId)');
        $preparedStatement -> bindParam(':pUserId', $userId,  \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met userid = {$userId} gevonden in de tabel Vrijwilliger.";
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
                $this->feedback = "de stored procedure vrijwilligerselectbyuserid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }

	//retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    public function selectVrijwilligerByVoornaamNaamGeboorteDatum($voornaam, $naam, $geboorteDatum)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call vrijwilligerselectbyvoornaamnaamgeboortedatum(:pVoornaam, :pNaam, :pGeboorteDatum)');
        $preparedStatement->bindParam(':pVoornaam', $voornaam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pNaam', $naam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pGeboorteDatum', $geboorteDatum, \PDO::PARAM_STR, 255); 
			
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met voornaam = {$voornaam}, naam = {$naam} en geboortedatum = {$geboorteDatum} gevonden in de tabel Vrijwilliger.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met voornaam = {$voornaam}, naam = {$naam} en geboortedatum = {$geboorteDatum}.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure vrijwilligerselectbyvoornaamnaamgeboortedatum is niet uitgevoerd.";
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



