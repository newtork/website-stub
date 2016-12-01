<?php

require_once('token.class.php');

class Template {
	var $contents;
	var $output;

    var $search = array(
		'/\t/',					//Remove Tabs
		'/<!--[^\[-]+?-->/',	//Remove Comments
		'/[\\s]{2,}/'			//Remove double space
	);
	
	var $DELIMITER_START = '[[';
	var $DELIMITER_END = ']]';
	
	
	function __construct($file) {
		$this->doLoad($file);
	}
		
    function doLoad($file) {
        if ($fp = fopen($file, "r")) {
            $this->contents = fread($fp, filesize($file));
            fclose($fp);
        }
    }

    function doReplace($str,$var) {
		if(!isset($this->contents))
			return;
			
        $this->contents = str_replace(
			$this->DELIMITER_START . $str . $this->DELIMITER_END,
			$var,
			$this->contents);
			
		$this->output = null;
    }

	function doForms() {
	
		// find indices of forms end tag
		$formEnd = array();
		$formPos = 0;
		while($formPos = stripos($this->contents, "</form>", $formPos)) {
			$formEnd[] = $formPos++;
		}
		
		
		// iterate backwards to keep intact indices
		for($i = count($formEnd)-1; $i >= 0; $i--) {
			
			// initialize token
			$formName = "form.".$i;
			$t = new Token($formName);
			
		
			// add hidden token field before form end tag
			$hiddenToken = "<input type=\"hidden\" name=\"" . $t->getFieldToken() . "\" value=\"" . $t->getToken() . "\" />";
			$hiddenFormName = "<input type=\"hidden\" name=\"form\" value=\"" . $formName . "\" />";
			$this->contents = substr_replace($this->contents, $hiddenToken.$hiddenFormName, $formEnd[$i], 0);
		}
	
	}

	function doGenerate() {
		if(!isset($this->contents))
			return;
			
		$replace = array_fill(0, count($this->search), '');
        $this->output = preg_replace($this->search, $replace, $this->contents);
	}

	function getOutput() {
		if(!isset($this->output))
			$this->doGenerate();
		return $this->output;
	}
	
    function doWrite() {
        echo $this->getOutput();
    }
}
