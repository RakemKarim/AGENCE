<?php 
class Reservation {
    private $vehicule;
    private $utilisateur;
    private $dateDebut;
    private $dateFin;

    public function __construct($vehicule, $utilisateur, $dateDebut, $dateFin) {
        $this->vehicule = $vehicule;
        $this->utilisateur = $utilisateur;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }

    public function getVehicule() {
        return $this->vehicule;
    }

    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }
}
