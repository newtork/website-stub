<?php

define(DEBUG, true);
define(COOKIES, false);
define(LOGGING, true);

define(LOG_PREFIX, "log.");
define(LOG_SUFFIX, ".txt");


if(DEBUG) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}


if(!COOKIES) {
	ini_set("session.use_cookies", 0);
	ini_set("session.use_only_cookies", 0);
	ini_set("session.use_trans_sid", 1);
	ini_set("session.cache_limiter", "");
}


// session initialization
session_start();

// loading libaries
require_once("inc/token.class.php");
require_once("inc/language.class.php");
require_once("inc/template.class.php");
require_once("inc/site.class.php");




// parameter handling
if(isset($_GET["lang"]))
 $_SESSION["language"] = $_GET["lang"];
else if(isset($_POST["lang"]))
 $_SESSION["language"] = $_POST["lang"];


// parameter defaults
$language_default = Site::LANGUAGE_DEFAULT;
$language_current = isset($_SESSION["language"]) ? $_SESSION["language"] : $language_default;



// action handling
if(isset($_POST["form"])) {

	// check action and token
	$token = new Token($_POST["form"]);
	if(isset($_POST["action"]) && $token->verifyFormToken()) {

		//$token->unsetFormToken();
		switch($_POST["action"]) {
		 case "order":

			$logText = $_SERVER['REMOTE_ADDR'] . " - " . date(DATE_ATOM) . ":\n";
			// fill logging text
			{
				$lang = Site::getLanguage($language_default);
				$translations = $lang->getTranslations();
				foreach($_POST as $key => $val) {
					if(isset($translations[$key])) {
						$logLine = $translations[$key] . "\n" . (isset($translations[$val]) ? $translations[$val] : $val) . "\n\n";
						$logText .= $logLine;
					}
				}
				$logText .= "\n---\n\n";
			}

			$logFile = LOG_PREFIX . $_POST["action"] . LOG_SUFFIX;
			file_put_contents($logFile, $logText, FILE_APPEND | LOCK_EX);

			echo '<html><head><META http-equiv="refresh" content="0;URL=#sent"></head><body>...</body></html>';
			exit;

			break;
		 default:
			// nothing
		}

	}
}


// site loading
echo (new Site($language_current))->getOutput();



