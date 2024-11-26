<?php
class Db {
    private $host = 'localhost';
    private $dbname = 'agence';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        try {
            // Crée la connexion à la base de données avec PDO
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", 
                                  $this->username, 
                                  $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Méthode pour obtenir l'objet PDO
    public function getPdo() {
        return $this->pdo;
    }

    // Méthode pour récupérer un utilisateur par login
    public function getUtilisateurByLogin($login) {
        $query = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $query->execute(['login' => $login]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
