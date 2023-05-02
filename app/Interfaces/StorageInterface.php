<?php

namespace App\Interfaces;

interface StorageInterface
{
    public function write(mixed $data);
    public function read();
    public function update(mixed $data = null, int $index = -1);
    public function search($key, $value);

    public function delete(int $index);
}
