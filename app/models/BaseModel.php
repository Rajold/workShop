<?php
// app/models/BaseModel.php

declare(strict_types=1);

class BaseModel
{
    protected PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }
}
