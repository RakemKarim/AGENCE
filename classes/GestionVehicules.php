<?php
class GestionVehicules {
    private array $listeVehicules; 
    private array $reservations; 
    private Db $db; 
    public function __construct(Db $db) {
        $this->db = $db; 
        $this->listeVehicules = [];
        $this->reservations = [];  
    }

    
    public function ajouterVehicule(Vehicules $vehicule): void {
        try {
            $pdo = $this->db->getPdo();
            $query = $pdo->prepare("
                INSERT INTO vehicules (marque, immatriculation, type, prix_par_jour) 
                VALUES (:marque, :immatriculation, :type, :prix_par_jour)
            ");
            $query->execute([
                'marque' => $vehicule->getMarque(),
                'immatriculation' => $vehicule->getImmatriculation(),
                'type' => $vehicule->getType(),
                'prix_par_jour' => $vehicule->getPrixParJour()
            ]);
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout du véhicule : " . $e->getMessage());
        }
    }

    public function getListeVehicules(): array {
        try {
            $pdo = $this->db->getPdo();
            $query = $pdo->query("SELECT * FROM vehicules");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des véhicules : " . $e->getMessage());
        }
    }

  
    public function ajouterReservation(Reservation $reservation): void {
        $this->reservations[] = $reservation;
    }

    public function getVehiculesReserves(): array {
        try {
            $pdo = $this->db->getPdo();
            $query = $pdo->query("
                SELECT v.marque, v.immatriculation, v.type, v.prix_par_jour, 
                       u.prenom, r.date_debut, r.date_fin
                FROM reservations r
                JOIN vehicules v ON r.vehicule_id = v.id
                JOIN utilisateurs u ON r.utilisateur_id = u.id
            ");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des véhicules réservés : " . $e->getMessage());
        }
    }
}

?>
