<?php

class BaseController {

    /**
     * Получает URN из запроса
     * 
     * @return string URN из URL запроса
     */
    protected function getUrn() 
    {
        $urn = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return $urn;
    }

    /**
     * Парсит JSON из тела запроса
     * 
     * @return array Декодированные данные из JSON
     */
    protected function parseJson() 
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        return $data;
    }

    /**
     * Извлекает и парсит заголовок авторизации
     * 
     * @return string Извлеченный JWT токен
     * @throws Exception Если заголовок авторизации отсутствует
     */
    protected function parseAuthHeader() 
    {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            throw new Exception('No authorization header');
        }

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $token = str_replace('Bearer ', '', $authHeader);
        return $token;
    }

    /**
     * Отправляет ответ клиенту
     * 
     * @param string $data Данные для отправки
     * @param array $httpHeaders Массив HTTP заголовков для отправки
     */
    protected function sendToClient($data, $httpHeaders = []) 
    {
        foreach ($httpHeaders as $header) {
            header($header);
        }

        echo $data;
        exit();
    }
}

?>
