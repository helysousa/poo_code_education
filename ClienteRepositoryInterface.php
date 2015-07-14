<?php

interface ClienteRepositoryInterface
{
    public static function getClientes($quantidade);
    public static function getJsonList($quantidade);
}