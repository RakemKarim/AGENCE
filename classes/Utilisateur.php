<?php
class Utilisateur {
    private $prenom;
    private $login;
    private $mot_de_passe;
    private $role;

    public function __construct($prenom, $login, $mot_de_passe, $role = 'client') {
        $this->prenom = $prenom;
        $this->login = $login;
        $this->mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT); // Hachage du mot de passe
        $this->role = $role;
    }

    // Getter et Setter pour chaque propriété
    public function getPrenom() {
        return $this->prenom;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getMotDePasse() {
        return $this->mot_de_passe;
    }

    public function getRole() {
        return $this->role;
    }

    // Vérifier si le login existe déjà dans la base de données
    public static function loginExiste($login) {
        // Connexion à la base de données
        $pdo = new PDO("mysql:host=localhost;dbname=agence", "root", ""); // Remplacez par vos informations de connexion

        // Vérifier si le login existe
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':login' => $login]);
        
        return $stmt->fetchColumn() > 0; // Retourne true si le login existe déjà
    }

    // Méthode pour enregistrer l'utilisateur dans la base de données
    public function enregistrer() {
        // Vérifier si le login existe déjà
        if (self::loginExiste($this->login)) {
            throw new Exception("Le login '{$this->login}' est déjà utilisé.");
        }

        // Connexion à la base de données
        $pdo = new PDO("mysql:host=localhost;dbname=agence", "root", ""); // Remplacez par vos informations de connexion

        // Préparer la requête d'insertion
        $sql = "INSERT INTO utilisateurs (prenom, login, mot_de_passe, role) VALUES (:prenom, :login, :mot_de_passe, :role)";
        $stmt = $pdo->prepare($sql);

        // Exécuter la requête
        $stmt->execute([
            ':prenom' => $this->prenom,
            ':login' => $this->login,
            ':mot_de_passe' => $this->mot_de_passe,
            ':role' => $this->role
        ]);
    }

    // Méthode pour connecter un utilisateur
    public static function seConnecter($login, $mdp) {
        // Connexion à la base de données
        $pdo = new PDO("mysql:host=localhost;dbname=agence", "root", ""); // Remplacez par vos informations de connexion

        // Préparer la requête pour récupérer l'utilisateur
        $sql = "SELECT * FROM utilisateurs WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':login' => $login]);

        // Vérifier si l'utilisateur existe
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($utilisateur && password_verify($mdp, $utilisateur['mot_de_passe'])) {
            return new Utilisateur($utilisateur['prenom'], $utilisateur['login'], $utilisateur['mot_de_passe'], $utilisateur['role']);
        }

        return null; // Si l'utilisateur n'est pas trouvé ou le mot de passe est incorrect
    }
}
?>
