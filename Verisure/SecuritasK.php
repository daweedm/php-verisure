<?php

namespace Verisure;

class SecuritasK
{

    const OFF = false;
    const ON = true;

    const INIT_MODE_AUTO = 1;

    const AVAILABLE_DOMAINS = array(
        "https://e-api01.verisure.com",
        "https://e-api02.verisure.com"
    );

    const URL_BASE = '/xbn/2/';
    const URL_LOGIN = 'cookie';

    const GET_INSTALLATIONS_URL = 'installation/search?email=%s';

    const GET_CAMERA_STATE = 'device/%s/';
    const SET_CAMERA_STATE = 'installation/%s/device/%s/customerimagecamera/config';

    const SET_SMARTPLUG_STATE = 'installation/%s/smartplug/state';
}

?>