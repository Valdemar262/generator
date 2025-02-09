<?php

namespace App\Models;

class Number
{
    private string $filename = __DIR__ . '/../../storage/numbers.json';

    public function save(int $number): array
    {
        $data = $this->getAll();
        $id = count($data) + 1;
        $data[$id] = $number;
        file_put_contents($this->filename, json_encode($data));

        return ["id" => $id, "number" => $number];
    }

    public function getAll(): array
    {
        if (!file_exists($this->filename)) {
            return [];
        }
        return json_decode(file_get_contents($this->filename), true) ?? [];
    }

    public function getById(int $id): array|string
    {
        $data = $this->getAll();
        return isset($data[$id]) ? ["id" => $id, "number" => $data[$id]] : ["error" => "Number with ID $id not found"];
    }
}
