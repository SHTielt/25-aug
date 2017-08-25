<?php
function cleanInput($input)
{
    foreach($input as $key => $value)
    {
    	if(is_string($value))//enkel strings worden aangepakt
		{
			//HTML tags en PHP code verwijderen
        	$value = strip_tags($value);
        	//witruimte aan het begin en einde verwijderen
        	$value = trim($value);
        	//2 spaties vervangen door één spatie
        	while(strpos($value, '  ') != FALSE)
        	{
            	$value = str_replace('  ', ' ',$value);
        	}
        	$input[$key] = $value;
		}
    }//einde foreach
    return $input;
}
?>