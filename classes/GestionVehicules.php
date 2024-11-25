<?php

class GestionVehicules {
    private array $listeVehicules; // Tableau contenant tous les véhicules

    public function __construct() {
        $this->listeVehicules = []; // Initialisation d'une liste vide
    }

    // Ajouter un véhicule à la liste
    public function ajouterVehicule(Vehicules $vehicule): void {
        $this->listeVehicules[] = $vehicule;
    }

    // Récupérer un véhicule par son immatriculation
    public function getVehicule(int $immatriculation): ?Vehicules {
        foreach ($this->listeVehicules as $vehicule) {
            if ($vehicule->getImmatriculation() === $immatriculation) {
                return $vehicule;
            }
        }
        return null; // Aucun véhicule trouvé
    }

    // Récupérer tous les véhicules
    public function getListeVehicules(): array {
        return $this->listeVehicules;
    }
}
