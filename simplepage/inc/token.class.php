<?php

class Token
{
	var $form, $token, $fieldToken;
	
	function __construct($form, $fieldToken="token") {
		$this->form = $form;
		$this->token = self::generateFormToken();
		$this->fieldToken = $fieldToken;
	}
	
	function getFieldToken() {
		return $this->fieldToken;
	}

	function getToken() {
		return $this->token;
	}
	
	function generateFormToken() {
		if(!isset($_SESSION[$this->form.'_token'])) {
		   // generate a token from an unique value
			$token = md5(uniqid(microtime(), true));

			// Write the generated token to the session variable to check it against the hidden field when the form is sent
			$_SESSION[$this->form.'_token'] = $token;

			return $token;
		}
		return $_SESSION[$this->form.'_token'];
	}


	function verifyFormToken() {
		// check if a session is started and a token is transmitted, if not return an error
		if(!isset($_SESSION[$this->form.'_token'])) {
			return false;
		}

		// check if the form is sent with token in it
		if(!isset($_POST[$this->fieldToken])) {
			return false;
		}

		// compare the tokens against each other if they are still the same
		if ($_SESSION[$this->form.'_token'] !== $_POST[$this->fieldToken]) {
			return false;
		}
		return true;
	}

	function unsetFormToken() {
		if(isset($_SESSION[$this->form.'_token'])) {
			unset($_SESSION[$this->form.'_token']);
		}
	}
	
	
	function encryptFieldName($field) { 
		return base64_encode($this->encrypt($field, $this->token));
	}
	
	function decryptFieldName($field) {
		return base64_decode($this->decrypt($field, $_POST[$this->fieldToken]));
	}
	
	
	/**
	 * Returns an encrypted & utf8-encoded
	 */
	function encrypt($pure_string, $encryption_key) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
		return $encrypted_string;
	}

	/**
	 * Returns decrypted original string
	 */
	function decrypt($encrypted_string, $encryption_key) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
		return $decrypted_string;
	}
}