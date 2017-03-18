<?php

namespace Verisure;

class SecuritasK
{

    const OFF = false;
    const ON = true;

    const INIT_MODE_AUTO = 1;

    const URL_BASE = 'https://e-api.verisure.com/xbn/2/';
    const URL_LOGIN = 'cookie';
    const GET_INSTALLATIONS_URL = 'installation/search?email=%s';
    const GET_CAMERA_STATE = 'device/%s/';
    const SET_CAMERA_STATE = 'installation/%s/device/%s/customerimagecamera/config';
}

?>