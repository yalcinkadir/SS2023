<?php

class Controller
{
    private $model;
    private $cart;

    public function __construct($model, $cart)
    {
        $this->model = $model;
        $this->cart = $cart;
    }

    public function handleRequest($action, $typeId)
    {
        switch ($action) {
            case 'listTypes':
                return $this->listTypes();
            case 'listProductsByTypeId':
                return $this->listProductsByTypeId($typeId);
            case 'addArticle':
                $articleId = $_GET['articleId'] ?? null;
                if ($articleId !== null) {
                    return $this->addArticle($articleId);
                } else {
                    return $this->sendErrorResponse(400, 'Missing articleId');
                }
            case 'removeArticle':
                $articleId = $_GET['articleId'] ?? null;
                if ($articleId !== null) {
                    return $this->removeArticle($articleId);
                } else {
                    return $this->sendErrorResponse(400, 'Missing articleId');
                }
            case 'listCart':
                return $this->listCart();
            default:
                return $this->defaultAction();
        }
    }

    public function listTypes()
    {
        return $this->model->getProductTypes();
    }

    public function listProductsByTypeId($typeId)
    {
        return $this->model->getProductsByTypeId($typeId);
    }

    public function addArticle($articleId): array
    {
        $result = $this->cart->addArticle($articleId);

        if ($result) {
            return ['state' => 'OK'];
        } else {
            return ['state' => 'ERROR'];
        }
    }

    public function sendErrorResponse($code, $message): void
    {
        http_response_code($code); // Setzt den HTTP-Statuscode der Antwort

        $errorResponse = [
            'code' => $code,
            'message' => $message
        ];

        echo json_encode($errorResponse); // Gibt das JSON-Objekt als Antwort aus
    }

    public function removeArticle($articleId): array
    {
        $result = $this->cart->removeArticle($articleId);

        if ($result) {
            return ['state' => 'OK'];
        } else {
            return ['state' => 'ERROR'];
        }
    }

    public function listCart(): array
    {
        $cartItems = $this->cart->listCart($this->model);

        $output = ['cart' => $cartItems];
        return $output;
    }

    public function defaultAction()
    {
        return $this->listTypes();
    }
}