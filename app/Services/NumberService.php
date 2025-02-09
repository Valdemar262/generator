<?php

namespace App\Services;

use App\Models\Number;

class NumberService
{
    private Number $number;

    public function __construct()
    {
        $this->number = new Number();
    }

    public function generateNumber(): int
    {
        $number = rand(1, 100);
        $this->number->save($number);
        return $number;
    }

    public function getAllNumbers(): array
    {
        return $this->number->getAll();
    }

    public function getNumberById(int $id): array
    {
        return $this->number->getById($id);
    }
}
