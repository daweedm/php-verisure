<?php
namespace Verisure;

class HTTPInterface
{
    const GET = "GET";
    const POST = "POST";
    const PUT = "PUT";
    const DELETE = "DELETE";
    const OPTIONS = "OPTIONS";

    const KEEP_CURRENT = 1;

    private $ch = null;
    private $session = null;

    public function __construct($verboseMode = false)
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_VERBOSE, $verboseMode);
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }

    public function setUrl($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, null);
        curl_setopt($this->ch, CURLOPT_HTTPGET, true);

        if ($this->session instanceof Session) {
            $this->authenticateRequest();
        }
    }

    public function setSession($session)
    {
        if (!$session instanceof Session) {
            throw new Exception("Need a Session obj");
        } else {
            $this->session = $session;
            $this->authenticateRequest();
        }
    }

    public function authenticateRequest()
    {
        $headers = array();
        $headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
        $headers[] = 'Content-Type: application/json';

        if ($this->session->hasCookie()) { // Most requests
            $headers[] = sprintf('Cookie: vid=%s', $this->session->getCookie());
        } else { // Login only
            $headers[] = sprintf('Authorization: Basic %s', $this->session->getAuthorization());
        }

        $this->setHeaders($headers);
    }

    public function setHeaders($headers)
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    }

    public function setPayload($payload)
    {
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($payload));
    }

    public function execute($method = HTTPInterface::KEEP_CURRENT)
    {
        if ($method !== HTTPInterface::KEEP_CURRENT) {
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        $res = curl_exec($this->ch);
        return json_decode($res, false);
    }
}

?>