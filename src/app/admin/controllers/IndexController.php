<?php

namespace Multi\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Escaper;

class IndexController extends Controller
{
    public function indexAction()
    {
        // Redirect to View
    }
    public function loginAction()
    {
        $data = $this->mongo->user;
        $check = $data->findOne(['$and' => [['email' => $_POST['email']], ['password' => $_POST['password']]]]);
        if ($check->name) {
            $this->logger
                // ->excludeAdapters(['login'])
                ->warning("Fill All Detail Email: " . $_POST["email"] . " Password " . $_POST["password"]);
            $this->response->redirect("../admin/product");
        } else {
            $this->response->redirect("../admin");
        }
    }
    public function signupAction()
    {
        // Redirect to View
    }
    public function checkAction()
    {
        $escaper = new Escaper();
        $arr = [
            'name'=>$escaper->escapeHtml($_POST['name']),
            'company'=>$escaper->escapeHtml($_POST['company']),
            'quantity'=>$escaper->escapeHtml($_POST['quantity']),
            'price'=>$escaper->escapeHtml($_POST['price']),
            'image'=>$escaper->escapeHtml($_POST['image']),
        ];
        $data = $this->mongo->user;
        $data->insertOne($arr);
        $this->response->redirect("../admin");
    }
}
