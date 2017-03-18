<?php
namespace Verisure;

class Session {
	
	private $user = null;
	private $password = null;
	private $authorization = null;
	private $cookie = null;
	private $installations = [];
	private $installation = null;
	
	public function __construct($user, $password) {
		$this->user = $user;
		$this->password = $password;
		$this->authorization = base64_encode(sprintf("CPE/%s:%s", $this->user, $this->password));
	}
	
	public function getAuthorization() {
		return $this->authorization;
	}
	
	public function setCookie($cookie) {
		$this->cookie = $cookie;
	}
	
	public function getCookie() {
		return $this->cookie;
	}
	
	public function hasCookie() {
		return $this->cookie !== null;
	}
	
	public function setInstallations($installations = []) {
		$this->installation = null;
		$this->installations = $installations;
	}
	
	public function getInstallations() {
		$this->installations;
	}
	
	public function hasInstallations() {
		return is_array($this->installations) && count($this->installations) > 0;
	}
	
	public function setInstallation($installation) {
		if(!in_array($installation, $this->installations)) {
			throw new Exception("Unknow installation");
		}
		$this->installation = $installation;
	}
	
	public function getInstallation() {
		return $this->installation;
	}
	
	public function hasInstallation() {
		return $this->installation !== null;
	}
	
	public function getGiid() {
		if(!$this->hasInstallation()) {
			throw new Exception("No installation selected");
		}
		return $this->installation->giid;
	}
	
	public function getUser() {
		return $this->user;
	}
}
?>