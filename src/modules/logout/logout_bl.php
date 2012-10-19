<?php
/**
 * Logout constants
 */
const LOGOUT_SUCCESS      = 90;
const LOGOUT_CANNOTSTOP   = 91;
/**
 * Status code container
 */
$status_code = NULL;

if(destroy_session()) {
    //TODO: use a header to manipulate page redirect
    //header("Location ".$_SERVER['SCRIPT_FILENAME']);
    $status_code = LOGOUT_SUCCESS;
}
else {
    $status_code = LOGOUT_CANNOTSTOP;
}

return array(
    'status_code' => $status_code
    );