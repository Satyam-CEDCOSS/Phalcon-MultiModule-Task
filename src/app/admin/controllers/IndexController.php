<?php

namespace Multi\Admin\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // Redirect to View
    }
    public function loginAction()
    {
        $data = $this->mongo->user;
        $check = $data->findOne(['$and'=> [['email'=>$_POST['email']], ['password'=>$_POST['password']]]]);
        $this->response->redirect("../admin/product");
    }
    public function signupAction()
    {
        // Redirect to View
    }
    public function checkAction()
    {
        $data = $this->mongo->user;
        $data->insertOne($_POST);
        $this->response->redirect("../admin");
    }
}