<?php
if(!is_null($status_code)) {
    switch($status_code) {
        case LOGOUT_CANNOTSTOP:
            echo sprintf('Can\'t stop the session! Error: %d', LOGOUT_CANNOTSTOP);
            break;
        case LOGOUT_SUCCESS:
            echo 'You are now logged out';
    }
}