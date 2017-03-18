<?php
namespace Verisure;

class Interface {
	private $session = null;
	private $httpInterface = null;
	public function __construct(...$args) {
		$this->session = new Session(...$args);
		$this->httpInterface = new HTTPInterface();
	}
	
	public function login() {
		$this->httpInterface->setUrl(SecuritasK::URL_BASE.SecuritasK::URL_LOGIN);
		$this->httpInterface->setSession($this->session);
		$this->httpInterface->setPayload([]);
		
		$loginResponse = $this->httpInterface->execute();
		
		$this->session->setCookie($loginResponse->cookie); 
	}
	
	public function init($initMode = SecuritasK::INIT_MODE_AUTO) {
		
		$this->httpInterface->setUrl(
			sprintf(SecuritasK::URL_BASE.SecuritasK::GET_INSTALLATIONS_URL, urlencode($this->session->getUser()))
		);
		
		$installations = $this->httpInterface->execute();
		$this->session->setInstallations($installations);
		
		if($initMode === SecuritasK::INIT_MODE_AUTO) {
			// Set automatically first installation as main installation
			$this->session->setInstallation($installations[0]);
		}
		
	}
	
	public function setCameraMotionDetectorState($cameraSerial = null, $state = SecuritasK::OFF) {
		if ($cameraSerial === null) {
			throw new Exception("Need a device serial");
		}
		
		$this->httpInterface->setUrl(
			sprintf(SecuritasK::URL_BASE.SecuritasK::SET_CAMERA_STATE, $this->session->getGiid(), urlencode($cameraSerial))
		);
		
		$this->httpInterface->setPayload(array(
			"userMonitoredCameraConfiguration" => array(
				"motionDetectorActive" => $state
			),
			"capability" => "USER_MONITORED_CUSTOMER_IMAGE_CAMERA"
		));
		
		$res = $this->httpInterface->execute(HTTPInterface::PUT);
	}
}
?>