<?php

namespace Fhtechnikum\Uebung34\Views;

class JsonView implements ViewInterface
{

    public function display($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}