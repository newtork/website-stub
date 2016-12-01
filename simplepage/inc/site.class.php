<?php
require_once('template.class.php');
require_once('language.class.php');


class Site
{
	const LANGUAGE_DEFAULT = "eng";
	const LANGUAGE_AVAILABLE = array("ger", "eng");
	const LANGUAGE_CHAR_WIDTH = array("ger" => 0.55, "eng" => 0.55);
	const LANGUAGE_DIRECTORY = "./languages/";
	const TEMPLATE_DIRECTORY = "./templates/";
	
	const TEMPLATE_FILE_SITE = "site.html";
	
	
	var $language = self::LANGUAGE_DEFAULT;
	var $ouput;
	
	function __construct($language) {
		if(isset($language) && $language!=null && in_array($language, self::LANGUAGE_AVAILABLE))
			$this->language = $language;
	}

	public static function getLanguage($language=null) {
		$lang = isset($language) && $language!=null && in_array($language, Site::LANGUAGE_AVAILABLE) ? $language : Site::LANGUAGE_DEFAULT;
		return new Language(Site::LANGUAGE_DIRECTORY . "lang." . $lang . ".txt");
	}
	
	function doSite() {
		$lang = self::getLanguage($this->language);
		
		$temp_main = new Template(self::TEMPLATE_DIRECTORY . self::TEMPLATE_FILE_SITE);
		
		
		// flat translation
		{
			$char_width = null !== self::LANGUAGE_CHAR_WIDTH[$this->language]
							? self::LANGUAGE_CHAR_WIDTH[$this->language] 
							: 1.0;
			
			foreach($lang->getTranslations() as $key => $val)
			{
				$temp_main->doReplace($key, $val);
				
				// form field label length
				if(substr($key, 0, 5) === "form_")
					$temp_main->doReplace($key."_indent", ceil(mb_strlen($val) * $char_width));
			}
			
			
			$temp_main->doForms();
		}
		
		// language button class
		{
			foreach(self::LANGUAGE_AVAILABLE as $lang)
				$temp_main->doReplace("language_class_" . $lang, ($this->language==$lang ? "active" : "inactive"));
		}
		
		$this->output = $temp_main->getOutput();
	}
	
	
	function getOutput() {
		if(!isset($this->output))
			$this->doSite();
		return $this->output;
	}
}