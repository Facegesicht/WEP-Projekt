<?php

namespace WEP\Model;

abstract class Database {
    
    /**
     * Zugangsdaten für die Datenbank 
     */
    private $dbName = "pbbfh20bgo2"; //Datenbankname
    private $linkName = "mysql.pb.bib.de"; //Datenbank-Server
    private $user = "pbbfh20bgo"; //Benutzername
    private $pw = "GUtN3Y7X"; //Passwort
    
    /**
     * Stellt eine Verbindung zur Datenbank her
     * 
     * @return \PDO Gibt eine Datenbankverbindung zurueck
     */
    public function linkDB() {
        try {
            $pdo = new \PDO("mysql:dbname=$this->dbName;host=$this->linkName"
                , $this->user
                , $this->pw
                , array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            return $pdo;
        } catch (\PDOException $e) {
            new \WEP\Library\ErrorMsg("Verbindung konnte nicht aufgebaut werden.", $e); 
            die;
        }
    }

    /**
     * Zum serverseitigen generieren einer UUID
     * 
     * @return string Liefert eine UUID
     */
    public function createUUID()
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    } 
}