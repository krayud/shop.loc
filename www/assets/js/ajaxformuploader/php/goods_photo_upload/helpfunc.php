<?php


function CheckAndClearDir($path){

	if(is_dir($path))
			ClearDir($path);
		else
			mkdir($path,0777);
}

function ClearDir($path){
	if ($handle = opendir($path)) 
	{
	    while (false !== ($file = readdir($handle))) 
	    { 
	    	if($file !="." && $file !="..")
	    	{
	    		$fileName  = $path.$file;
	    		if(!is_dir($fileName))
		    		unlink($fileName);
		    }
	    }
	    closedir($handle); 
	}
}