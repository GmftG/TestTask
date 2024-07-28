<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database {

    /**
     * Получает пользователя по имени и паролю
     * 
     * @param string $username Имя пользователя
     * @param string $password Пароль пользователя
     * @return array Данные пользователя
     * @throws Exception Если пользователь не найден
     */
    public function getId($username, $password) 
    {
        $fromDb = $this->select("SELECT * FROM `users` WHERE `username`= :username AND `password`= :password",
            ['username' => $username, 'password' => $password]
        );

        if (empty($fromDb)) {
            throw new Exception('User not found');
        }

        $user = $fromDb[0];
        return $user;
    }

    /**
     * Получает пользователя по ID
     * 
     * @param int $id ID пользователя
     * @return array Данные пользователя
     * @throws Exception Если пользователь не найден
     */
    public function getById($id) 
    {
        $fromDb = $this->select("SELECT `username` FROM `users` WHERE `id`= :id", ['id' => $id]);

        if (empty($fromDb)) {
            throw new Exception('User not found');
        }

        $user = $fromDb[0];
        return $user;
    }

    /**
     * Добавляет нового пользователя
     * 
     * @param string $username Имя пользователя
     * @param string $password Пароль пользователя
     */
    public function addUser($username, $password) 
    {
        $this->insert("INSERT INTO `users` (username, password) VALUES ( :username, :password)",
            ['username' => $username, 'password' => $password]
        );
        return;
    }

    /**
     * Обновляет данные пользователя
     * 
     * @param string $username Имя пользователя
     * @param int $id ID пользователя
     */
    public function updateUser($username, $id) 
    {
        $this->update("UPDATE `users` SET `username`= :username WHERE `id`= :id",
            ['username' => $username, 'id' => $id]
        );
        return;
    }

    /**
     * Удаляет пользователя по ID
     * 
     * @param int $id ID пользователя
     */
    public function deleteUserById($id) 
    {
        $this->delete("DELETE FROM `users` WHERE `id`= :id", ['id' => $id]);
        return;
    }
}

