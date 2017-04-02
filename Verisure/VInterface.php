<?php
namespace Verisure;

class VInterface
{
    private $session = null;
    private $httpInterface = null;

    public function __construct(...$args)
    {
        $this->session = new Session(...$args);
        $this->httpInterface = new HTTPInterface();
    }

    public function __destruct()
    {
        if ($this->session->hasCookie()) { // if was logged in
            $this->logout();
        }
    }

    public function login()
    {
        $this->httpInterface->setUrl(SecuritasK::URL_BASE . SecuritasK::URL_LOGIN);
        $this->httpInterface->setSession($this->session);
        $this->httpInterface->setPayload([]);

        $loginResponse = $this->httpInterface->execute();

        $this->session->setCookie($loginResponse->cookie);
    }

    public function logout()
    {
        $this->httpInterface->setUrl(SecuritasK::URL_BASE . SecuritasK::URL_LOGIN);
        $this->httpInterface->setPayload([]);

        $this->httpInterface->execute(HTTPInterface::DELETE);
    }

    public function init($initMode = SecuritasK::INIT_MODE_AUTO)
    {

        $this->httpInterface->setUrl(
            sprintf(SecuritasK::URL_BASE . SecuritasK::GET_INSTALLATIONS_URL, urlencode($this->session->getUser()))
        );

        $installations = $this->httpInterface->execute();
        $this->session->setInstallations($installations);

        if ($initMode === SecuritasK::INIT_MODE_AUTO) {
            // Set automatically first installation as main installation
            $this->session->setInstallation($installations[0]);
        }

    }

    public function setCameraMotionDetectorState($cameraSerial = null, $state = SecuritasK::OFF)
    {
        if ($cameraSerial === null) {
            throw new \Exception("Please provide the serial number of the camera");
        }

        $this->httpInterface->setUrl(
            sprintf(SecuritasK::URL_BASE . SecuritasK::SET_CAMERA_STATE, $this->session->getGiid(), urlencode($cameraSerial))
        );

        $this->httpInterface->setPayload(array(
            "userMonitoredCameraConfiguration" => array(
                "motionDetectorActive" => $state
            ),
            "capability" => "USER_MONITORED_CUSTOMER_IMAGE_CAMERA"
        ));

        return $this->httpInterface->execute(HTTPInterface::PUT);
    }

    public function setSmartPlugState($smartPlugSerial = null, $state = SecuritasK::OFF) {
        if ($smartPlugSerial === null) {
            throw new \Exception("Please provide the serial number of the smartplug");
        }

        $this->httpInterface->setUrl(
            sprintf(SecuritasK::URL_BASE . SecuritasK::SET_SMARTPLUG_STATE, $this->session->getGiid())
        );

        $this->httpInterface->setPayload(array(
            "deviceLabel" => $smartPlugSerial,
            "state" => $state
        ));

        return $this->httpInterface->execute(HTTPInterface::POST);

    }
}

?>