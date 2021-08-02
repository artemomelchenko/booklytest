<?php


class DB
{

    public static $dsn = 'mysql:dbname=booklytest;host=localhost';
    public static $user = 'root';
    public static $pass = '';

    public static $dbh = null;
    public static $sth = null;
    public static $query = '';

    public static function getDbh()
    {
        if (!self::$dbh) {
            try {
                self::$dbh = new PDO(
                    self::$dsn,
                    self::$user,
                    self::$pass
                );
            } catch (PDOException $e) {
                exit($e->getMessage());
            }
        }

        return self::$dbh;
    }

    public static function getAll($table)
    {
        $query = "SELECT * FROM `" . $table . "`";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute();
        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function add($table, $fields, $value)
    {

        $query = "INSERT INTO `" . $table . "` (" . $fields . ") VALUES (:value)";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->bindParam(':value', $value);
        return (self::$sth->execute() ? self::getDbh()->lastInsertId() : 0);
    }

    public static function delete($table, $value)
    {

        $query = "DELETE FROM `" . $table . "` WHERE id = :value";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->bindParam(':value', $value);
        return self::$sth->execute();
    }

}