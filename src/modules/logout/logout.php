<?

if(is_numeric($page_vl_vars)) {
    switch($page_vl_vars) {
        case LOGOUT_CANNOTSTOP:
            echo sprintf('Can\'t stop the session! Error: %d', LOGOUT_CANNOTSTOP);
            break;
        case LOGOUT_SUCCESS:
            echo 'You are now logged out';
    }
}