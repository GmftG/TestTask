<?php

class Database {

    // Хранит соединение с базой данных
    protected $connection = null;

    public function __construct() {
        try {
            $this->connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE_NAME . ';', DB_USERNAME, DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Выполняет SELECT запрос к базе данных
     * 
     * @param string $query SQL запрос
     * @param array $params Параметры для SQL запроса
     * @return array Массив результатов запроса
     * @throws Exception Если возникает ошибка при выполнении запроса
     */
    public function select($query, $params = []) 
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);				
            $stmt->closeCursor();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $result;
    }

    /**
     * Выполняет INSERT запрос к базе данных
     * 
     * @param string $query SQL запрос
     * @param array $params Параметры для SQL запроса
     * @throws Exception Если возникает ошибка при выполнении запроса
     */
    public function insert($query, $params = []) 
    {
        try {
            $stmt = $this->executeStatement($query, $params);			
            $stmt->closeCursor();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return;
    }

    /**
     * Выполняет UPDATE запрос к базе данных
     * 
     * @param string $query SQL запрос
     * @param array $params Параметры для SQL запроса
     * @throws Exception Если возникает ошибка при выполнении запроса
     */
    public function update($query, $params = []) 
    {
        try {
            $stmt = $this->executeStatement($query, $params);				
            $stmt->closeCursor();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return;
    }

    /**
     * Выполняет DELETE запрос к базе данных
     * 
     * @param string $query SQL запрос
     * @param array $params Параметры для SQL запроса
     * @throws Exception Если возникает ошибка при выполнении запроса
     */
    public function delete($query, $params = []) 
    {
        try {
            $stmt = $this->executeStatement($query, $params);				
            $stmt->closeCursor();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return;
    }

    /**
     * Подготавливает и выполняет SQL запрос
     * 
     * @param string $query SQL запрос
     * @param array $params Параметры для SQL запроса
     * @return PDOStatement Подготовленное и выполненное SQL заявление
     * @throws Exception Если возникает ошибка при выполнении запроса
     */
    public function executeStatement($query, $params = []) 
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $stmt;
    }
}

