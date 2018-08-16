<?php
/**
 * Created by PhpStorm.
 * User: adamveres
 * Date: 15.08.2018
 * Time: 17:11
 */

namespace Controller;

use View\View;

class UserController
{
    public function showFormAction()
    {
        $view = new View('View/registerTemplate.html');
        $view->render(['error'=>'']);
    }
}