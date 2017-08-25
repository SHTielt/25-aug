<?php

class Foto extends \Base
{
    private $fotoId;

    /*constructor in basisklasse volstaat*/

    /*set $fotoId
    return true als nt leeg; return false als leeg
    */
    
    public function setFotoId($value)
    {
        if (is_numeric($value))
        {
            $this->fotoId=$value;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getFotoId()
    {
        return $this->fotoId; 
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function insert($fotoNaam, $vrId, $verId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try
            {
            $preparedStatement = $this->pdo->prepare('call fotoinsert(@pFotoId, :pFotoNaam, :pvrId, :pverId)');
            $preparedStatement->bindParam(':pFotoNaam', $fotoNaam, \PDO::PARAM_STR, 255); 
            $preparedStatement->bindParam(':pvrId', $vrId, \PDO::PARAM_INT);
			$preparedStatement->bindParam(':pverId', $verId, \PDO::PARAM_INT);
                                     
            $success = $preparedStatement->execute(); 
            if ($success)
            {
                $this->setFotoId($this->pdo->query('select @pFotoId')->fetchColumn()); 
                $this->feedback="De foto {$fotoNaam} met id <b> " . $this->getFotoId() . "</b> is toegevoegd."; 
                $result = TRUE;
            }
            else
            {
                $this->feedback = "De foto {$fotoNaam} is niet toegevoegd.";
                $sQLErrorInfo = $preparedStatement->errorInfo();//invulling van een array
                $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                $this->errorMessage = $sQLErrorInfo[2];
                $result = FALSE;
            }
            }
            catch (\PDOException $e)
            {
                $this->feedback="De stored procedure fotoinsert is niet gelukt."; 
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function update($fotoId, $fotoNaam, $vrId, $verId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {

        try
        {
        $preparedStatement=$this->pdo->prepare('call fotoupdate(:pId, :pNaam, :pvrId, :pverId)');
        $preparedStatement->bindParam(':pId', $fotoId, \PDO::PARAM_INT, 11);
        $preparedStatement->bindParam(':pNaam', $fotoNaam, \PDO::PARAM_STR, 255); 
        $preparedStatement->bindParam(':pvrId', $vrId, \PDO::PARAM_INT);
	    $preparedStatement->bindParam(':pverId', $verId, \PDO::PARAM_INT);
       
        $preparedStatement->execute();

        $result = $preparedStatement->rowCount();
        if($result)
        {
            $this->feedback =  "De foto {$fotoId} is gewijzigd.";
            $result = TRUE;
        }
        else
        {
            $this->feedback = "De foto {$fotoId} is niet gewijzigd.";
            $sQLErrorInfo = $preparedStatement->errorInfo();
            $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
            $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
             $this->feedback = "De stored procedure fotoupdate is niet uitgevoerd.";
             $this->errorMessage=$e->getMessage();
             $this->errorCode=$e->getCode();
        }
        $this->close();
        }
        return $result;
    }

    


    /*retourneert steeds boolean; ook feedback is voorzien*/
    public function delete($fotoId)
    {
        $result=FALSE;
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';

        if($this->connect())
        {
            try{
                $preparedStatement = $this->pdo->prepare('call fotodelete(:pId)');
                /*in stored procedure staat pId als parameter; hoeft hier niet idem te zijn*/
                $preparedStatement->bindParam(':pId', $fotoId, \PDO::PARAM_INT, 11);
                $preparedStatement->execute();
                $result = $preparedStatement->rowCount();
                if($result)
                {
                $this->feedback = "Foto {$fotoId} is verwijderd.";
                $result = TRUE;
                }
                else
                {
                     $this->feedback = "De Foto met id = {$fotoId} is niet gevonden en is niet verwijderd.";
                     $sQLErrorInfo = $preparedStatement->errorInfo();
                     $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
                     $this->errorMessage = $sQLErrorInfo[2];
                     $result = FALSE;
                }
            }
            catch (\PDOException $e)
            {
                $this->feedback = "De stored procedure fotodelete is niet uitgevoerd.";
                $this->errorMessage = $e->getMessage();
                $this->errorCode = $e->getCode();
            }
            $this->close();
        }
        return $result;
    }

    
	//retourneert FALSE bij mislukken en een 2dimens array bij slagen evenals invulling van alle variabelen
    public function selectFotoById($fotoId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call fotoselectbyid(:pId)');
        $preparedStatement -> bindParam(':pId', $fotoId,  \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met fotoid = {$fotoId} gevonden in de tabel sh_fotos.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met fotoid = {$fotoId}.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure fotoselectbyid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }
      
    //retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function selectFotoByVrijwilligerId($vrijwilligerId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call fotoselectbyvrijwilligerid(:pVrId)');
        $preparedStatement -> bindParam(':pVrId', $vrijwilligerId,  \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met vrijwilligerid = {$vrijwilligerId} gevonden in de tabel sh_fotos.";
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
                $this->feedback = "De stored procedure fotoselectbyvrijwilligerid is niet uitgevoerd.";
                $this->errorMessage=$e->getMessage();
                $this->errorCode=$e->getCode();
                $this->rowCount = -1;
        }
        $this->close();
        return $result;
        }
    }

	//retourneert FALSE bij mislukken en een 2dimens array bij slagen
    public function selectFotoByVerenigingId($verenigingId)
    {
        $this->errorCode='none';
        $this->errorMessage='none';
        $this->feedback='none';
        $result=FALSE;

        if($this -> connect())
        {
        try 
        {
       
        $preparedStatement = $this->pdo->prepare('call fotoselectbyverenigingid(:pVerId)');
        $preparedStatement -> bindParam(':pVerId', $verenigingId,  \PDO::PARAM_INT, 11);
        $preparedStatement->execute();
        $this->rowCount = $preparedStatement->rowCount();
        //fetch the output
        if($result = $preparedStatement->fetchAll()) //Returns an array containing all of the result set rows 
        {
            $this->feedback = "{$preparedStatement->rowCount()} rij(en) met verenigingid = {$verenigingId} gevonden in de tabel sh_verenigingen.";
        }
        else //retourneert lege array
        {
               $this->feedback = "Geen rijen met verenigingid = {$verenigingId}.";
               $sQLErrorInfo = $preparedStatement->errorInfo();
               $this->errorCode = $sQLErrorInfo[0].'/'.$sQLErrorInfo[1];
               $this->errorMessage = $sQLErrorInfo[2];
        }
        }
        catch (\PDOException $e)
        {
                $this->feedback = "De stored procedure fotoselectbyverenigingid is niet uitgevoerd.";
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



