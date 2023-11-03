<?php

namespace App\Repositories;

interface BaseRepository
{
    public function findById($id);
    public function findAll();
    public function create(array $data);
    public function update($model, array $data);
    public function delete($model);
}