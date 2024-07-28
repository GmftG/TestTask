<?php

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JwtHelper {

    /**
     * Генерирует JWT для указанного пользователя
     *
     * @param int $userId - Идентификатор пользователя
     * @return string - JWT токен
     */
    public function generateToken($userId) {
        $accessToken = [
            'iss' => 'http://localhost',  // Издатель токена
            'iat' => time(),              // Время создания токена (временная метка)
            'exp' => time() + 3600,       // Время истечения токена (1 час)
            'data' => [
                'id' => $userId           // Вложенные данные (идентификатор пользователя)
            ]
        ];
        
        $accessTokenJWT = JWT::encode($accessToken, SECRET_KEY, 'HS256');
        
        return $accessTokenJWT;  
    }

    /**
     * Валидация JWT
     *
     * @param string $token - JWT токен для валидации
     * @throws Exception - Бросает исключение, если токен невалиден
     */
    public function validateJwt($token) {
        try {
            $decoded = JWT::decode($token, new Key(SECRET_KEY, 'HS256'));

            return; 

        } catch (Exception $e) {
            throw new Exception('Token is not valid');
        }
    }

    /**
     * Валидация JWT и получение информации из токена
     *
     * @param string $token - JWT токен для валидации
     * @return array - Декодированные данные из токена
     * @throws Exception - Бросает исключение, если токен невалиден
     */
    public function validateAndGetInfoJwt($token) {
        try {
            $decoded = JWT::decode($token, new Key(SECRET_KEY, 'HS256'));
            
            $fromJwt = (array) $decoded->data;
            return $fromJwt;

        } catch (Exception $e) {
            throw new Exception('Token is not valid');
        }
    }
}
?>
