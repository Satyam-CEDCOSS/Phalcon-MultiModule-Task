<?php

namespace Multi\User\Controllers;

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->data = $this->mongo->product->find();
    }
    public function detailAction()
    {
        $id = $_GET['id'];

        $this->view->data = $this->mongo->product->findOne(array("_id" => new \MongoDB\BSON\ObjectId($id)));
    }
}