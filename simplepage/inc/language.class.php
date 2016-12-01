<?php


class Language
{
	const PAIR_SEPERATOR = "\n";
	const VALUE_SEPERATOR = "=";

	
	var $contents;
	var $translations = array();
	
	function __construct($file) {
		$this->doLoad($file);
	}
		
    function doLoad($file) {
        if ($fp = fopen($file, "r")) {
            $this->contents = fread($fp, filesize($file));
            fclose($fp);
        }
		
		$this->createTranslations();
    }
	
	
	function createTranslations() {
		if(!isset($this->contents) || count($this->translations)>0)
			return;
			
		$seperator_length = strlen(self::VALUE_SEPERATOR);
		
		$lines = explode(self::PAIR_SEPERATOR, $this->contents);
		foreach($lines as $line) {
			$seperator_pos = strpos($line, self::VALUE_SEPERATOR);
			if($seperator_pos > 0) {
			
				$key = trim( substr($line, 0, $seperator_pos) );
				$val = trim( substr($line, $seperator_pos + $seperator_length) );
				
				if($key !== "")
					$this->translations[$key] = $val;
			}
		}
	}
	
	function getTranslations() {
		return $this->translations;
	}
}


	
	