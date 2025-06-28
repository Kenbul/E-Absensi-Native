<?php
require_once 'config/database.php';

class Guru_Pelajaran
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
}
