<?php

class GestionVehicules {
    private array $listeVehicules; // Tableau contenant tous les véhicules
    private array $reservations; // Tableau contenant toutes les réservations

    public function __construct() {
        $this->listeVehicules = []; // Initialisation d'une liste vide
        $this->reservations = [];  // Initialisation d'une liste vide pour les réservations
    }

    // Ajouter un véhicule à la liste
    public function ajouterVehicule(Vehicules $vehicule): void {
        $this->listeVehicules[] = $vehicule;
    }

    // Récupérer tous les véhicules
    public function getListeVehicules(): array {
        return $this->listeVehicules;
    }

    // Ajouter une réservation
    public function ajouterReservation(Reservation $reservation): void {
        $this->reservations[] = $reservation;
    }

    // Récupérer les réservations
    public function getReservations(): array {
        return $this->reservations;
    }

    // Récupérer les véhicules réservés
    public function getVehiculesReserves(): array {
        $vehiculesReserves = [];

        foreach ($this->reservations as $reservation) {
            $vehiculesReserves[] = [
                'vehicule' => $reservation->getVehicule(),
                'utilisateur' => $reservation->getUtilisateur(),
                'dateDebut' => $reservation->getDateDebut(),
                'dateFin' => $reservation->getDateFin()
            ];
        }

        return $vehiculesReserves;
    }
}
