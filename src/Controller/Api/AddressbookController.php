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

    public function __construct(\App\Model\Addressbook $model)
    {
        $this->model = $model;
    }

    public function getUrls(): array
    {
        return $this->urls;
    }

    public function do(string $requestMethode): void
    {
            $this->{$this->methode[$requestMethode]}();
    }

    public function index(): void
    {
        $data = $this->model->readAll();
        $this->sendOutput(json_encode($data));
    }

    public function create(): void
    {
        if (!($data = $this->getInputData())) {
            $this->sendError(400, "No data received");
        }
        unset($data['id']);
        $id = $this->model->create($data);
        $this->sendOutput(json_encode($id));
    }

    public function read(): void
    {
        if ($data = $this->getInputData()) {
            $data = $this->model->read($data);
        }else{
            $data = $this->model->readAll();
        }
            $this->sendOutput(json_encode($data));
    }

    public function update() : void
    {
        $data = $this->getInputData();
        $result = $this->model->update($data);
        $this->sendOutput(json_encode($result));
    }

    public function delete(): void
    {
        $data = $this->getInputData();
        $result = $this->model->delete($data);
        $this->sendOutput(json_encode($result));
    }

    public function getInputData(): ?array
    {
        $data = null;
        $rawData = file_get_contents('php://input');
        if (false !== $rawData) {
            $data = json_decode($rawData, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $data = null;
            }
        }
        return $data;
    }
}
