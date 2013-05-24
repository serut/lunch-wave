<?php

/*
|--------------------------------------------------------------------------
| Application Composer
|--------------------------------------------------------------------------
|
| Here is where you can specify variables that will available in view 
| without specify them in the controller.
*/

class UserComposer extends Composer {
 
    public function compose($view)
    {
        $view->with('userName', User::getFirstNameAttribute());
    }
}