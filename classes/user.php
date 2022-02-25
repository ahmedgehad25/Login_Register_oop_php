<?php

require "db.php";

class User
{
    protected $db;
    public function __construct()
    {
        $this->db = new Db();
        $this->db = $this->db->dbConnect();
    }

    public function checkLogin($name, $pass)
    {
        $stmt = $this->db->prepare("SELECT UserID , Username , Password FROM users WHERE Username = ? AND Password = ? AND is_admin != 1");
        $stmt->execute(array($name, sha1($pass)));
        $row = $stmt->fetch();
        if ($row > 0) {
            $_SESSION['username'] = $row['Username'];
            $_SESSION['UserID'] = $row['UserID'];
            return true;
        }
    }



    public function checkRegister($name, $pass, $email, $fname)
    {
        $stmt = $this->db->prepare("SELECT Username , Email  FROM users WHERE Username = ? OR Email = ?");
        $stmt->execute(array($name, $email));
        $row = $stmt->fetch();
        if ($row == 0) {
            $stmt = $this->db->prepare("INSERT INTO users(Username , Password , Email , Fullname ) VALUES (?,?,?,?)");
            $stmt->execute(array($name, sha1($pass), $email, $fname));
            return true;
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location:login.php");
        exit();
    }

    public function setError($msg)
    {
        return $this->error[] = $msg;
    }
}
