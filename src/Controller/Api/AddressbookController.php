<?php

namespace App\Controller\Api;

class AddressbookController extends BaseController
{
    protected $urls = ['addressbook', 'addressbooks'];
    protected $methode = [
        'GET' => 'read',
        'POST' => 'create',
        'PUT' => 'update',
        'DELETE' => 'delete'
      ];

    public function __construct()
    {
        $this->model = new \App\Model\Addressbook();
    }

    public function getUrls()
    {
        return $this->urls;
    }
    public function do($requestMethode)
    {
            $this->{$this->methode[$requestMethode]}();
    }

    public function index()
    {
        $data = $this->model->readAll();
        $this->sendOutput(json_encode($data));
    }

    public function create()
    {
        if (!($data = $this->getInputData())) {
            $this->sendError(400, "No data received");
        }
        unset($data['id']);
        $id = $this->model->create($data);
        $this->sendOutput(json_encode($id));
    }

    public function read()
    {
        if ($data = $this->getInputData()) {
            $data = $this->model->read($data);
        }else{
            $data = $this->model->readAll();
        }
            $this->sendOutput(json_encode($data));
    }

    public function update()
    {
        $data = $this->getInputData();
        $result = $this->model->update($data);
        $this->sendOutput(json_encode($result));
    }

    public function delete()
    {
        $data = $this->getInputData();
        $result = $this->model->delete($data);
        $this->sendOutput(json_encode($result));
    }

    public function getInputData()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        return $data;
    }
}
