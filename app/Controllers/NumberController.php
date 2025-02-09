<?php

namespace App\Controllers;

use App\Services\NumberService;

class NumberController
{
    private NumberService $service;

    public function __construct()
    {
        $this->service = new NumberService();
    }

    public function generateNumber(): false|string
    {
        $result = $this->service->generateNumber();
        return json_encode($result);
    }

    public function getAllNumbers(): false|string
    {
        $result = $this->service->getAllNumbers();
        return json_encode($result);
    }

    public function getNumberById($id): array
    {
        return $this->service->getNumberById($id);
    }
}
