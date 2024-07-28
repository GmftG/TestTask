<?php

class UserController extends BaseController {

    /**
     * Действие для входа пользователя
     */
    public function loginAction() 
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            try {
                $user = new UserModel();
                $jwtHelper = new JwtHelper();

                $fromJson = $this->parseJson();
                
                $user = $user->getId($fromJson['username'], $fromJson['password']);
                
                $accessTokenJWT = $jwtHelper->generateToken($user['id']);

                // Формируем ответ клиенту
                $toClient = json_encode([
                    'data' => [
                        'username' => $user['username']
                    ],
                    'access' => [
                        $accessTokenJWT
                    ]
                ]);

                $this->sendToClient($toClient, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));

            } catch (Exception $e) {
                // Обрабатываем ошибку аутентификации
                $strErrorDesc = 'authentication failed';
                $strErrorHeader = 'HTTP/1.1 401 Unauthorized';
                $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
            }
        } else {
            // Обрабатываем неподдерживаемый метод запроса
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }

    /**
     * Действие для создания пользователя
     */
    public function createAction() 
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            try {
                $user = new UserModel();

                $fromJson = $this->parseJson();
                
                $user->addUser($fromJson['username'], $fromJson['password']);

                $this->sendToClient(json_encode(array('message' => 'user was created')), array('Content-Type: application/json', 'HTTP/1.1 200 OK'));

            } catch (Exception $e) {
                // Обрабатываем ошибку на сервере
                $strErrorDesc = 'Internal server error';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
            }
        } else {
            // Обрабатываем неподдерживаемый метод запроса
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }

    /**
     * Действие для получения информации о пользователе
     */
    public function aboutAction() 
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            try {
                $user = new UserModel();
                $jwtHelper = new JwtHelper();

                $token = $this->parseAuthHeader();
                $fromJwt = $jwtHelper->validateAndGetInfoJwt($token);
        
                $user = $user->getById($fromJwt['id']);
                
                // Формируем ответ клиенту
                $toClient = json_encode([
                    'data' => [
                        'username' => $user['username'],
                        'id' => $fromJwt['id']
                    ]
                ]);

                $this->sendToClient($toClient, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));

            } catch (Exception $e) {
                // Обрабатываем ошибку аутентификации
                $strErrorDesc = 'authentication failed';
                $strErrorHeader = 'HTTP/1.1 401 Unauthorized';
                $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
            }
        } else {
            // Обрабатываем неподдерживаемый метод запроса
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }

    /**
     * Действие для редактирования пользователя
     */
    public function editAction() 
    {
        if ($_SERVER['REQUEST_METHOD'] == "PUT") {
            try {
                $user = new UserModel();
                $jwtHelper = new JwtHelper();

                $fromJson = $this->parseJson();
                $token = $this->parseAuthHeader();
                $fromJwt = $jwtHelper->validateAndGetInfoJwt($token);

                $user->updateUser($fromJson['username'], $fromJwt['id']);

                $this->sendToClient(json_encode(array('message' => 'user was updated')), array('Content-Type: application/json', 'HTTP/1.1 200 OK'));

            } catch (Exception $e) {
                // Обрабатываем ошибку аутентификации
                $strErrorDesc = 'authentication failed';
                $strErrorHeader = 'HTTP/1.1 401 Unauthorized';
                $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
            }
        } else {
            // Обрабатываем неподдерживаемый метод запроса
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }

    /**
     * Действие для удаления пользователя
     */
    public function deleteAction() 
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            try {
                $user = new UserModel();
                $jwtHelper = new JwtHelper();

                $token = $this->parseAuthHeader();
                $fromJwt = $jwtHelper->validateAndGetInfoJwt($token);

                $user->deleteUserById($fromJwt['id']);

                $this->sendToClient(json_encode(array('message' => 'user was deleted')), array('Content-Type: application/json', 'HTTP/1.1 200 OK'));

            } catch (Exception $e) {
                // Обрабатываем ошибку аутентификации
                $strErrorDesc = 'authentication failed';
                $strErrorHeader = 'HTTP/1.1 401 Unauthorized';
                $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
            }
        } else {
            // Обрабатываем неподдерживаемый метод запроса
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $this->sendToClient(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }
}

