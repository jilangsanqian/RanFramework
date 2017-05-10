<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author ranhai
 */
use Core\RanController;

class UserController extends RanController
{

    public function checkUser()
    {
        var_dump($this->Router->method);
       
    }

}
