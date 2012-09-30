<?php
/**
 * Logout constants
 */
const LOGOUT_SUCCESS      = 90;
const LOGOUT_CANNOTSTOP   = 91;

if(destroy_session()) {
    return LOGOUT_SUCCESS;
}
else {
    return LOGOUT_CANNOTSTOP;
}
