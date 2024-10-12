<?php

namespace App\Domain\Entities;

class Repository
{
    public string $id;
    public string $name;
    public string $url;
    public string $createdAt;

    public function __construct($id, $name, $url, $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->createdAt = $createdAt;
    }
}
