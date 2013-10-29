<?php
/**
 * Home page controller
 */
class homeController
{
    /**
    * Variable that will hold the view of home page
    */
    public $template = 'home';

    /**
    * This function will handle the call from the router.php file 
    *
    * @param array $getVars
    */
    public function main(array $getVars)
    {
        // TODO: implement the function handle
        $model = new homeModel;
    }
}
