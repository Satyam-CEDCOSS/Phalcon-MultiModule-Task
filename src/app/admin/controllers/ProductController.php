<?php

namespace Multi\Admin\Controllers;

use Phalcon\Mvc\Controller;

class ProductController extends Controller
{
    public function indexAction()
    {
        $this->view->data = $this->mongo->product->find();
    }
    public function addAction()
    {
        $data = $this->mongo->product;
        $data->insertOne($_POST);
        $this->response->redirect("../admin/product");
    }
    public function editAction()
    {
        $id = $_GET['id'];
        $this->view->data = $this->mongo->product->findOne(array("_id" => new \MongoDB\BSON\ObjectId($id)));
    }
    public function updateAction()
    {
        $id = $_GET['id'];
        $data = $this->mongo->product;
        $data->updateOne(array("_id" => new \MongoDB\BSON\ObjectId($id)), array('$set' => $_POST));
        $this->response->redirect("../admin/product");
    }
    public function deleteAction()
    {
        $id = $_GET['id'];
        $data = $this->mongo->product;
        $data->deleteOne(array("_id" => new \MongoDB\BSON\ObjectId($id)));
        $this->response->redirect("../admin/product");
    }
}