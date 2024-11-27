<?php

class Vehicules{
    private string $marque;
    private int  $immatriculation;
    private string  $type;
    private float  $prixParJour;
    private bool $disponibilite ;

    public function __construct(string $marque, int $immatriculation, string  $type,float  $prixParJour){
        $this->marque = $marque;
        $this->prixParJour = $prixParJour;
        $this->immatriculation = $immatriculation;
        $this->marque = $marque;
        $this->type = $type;
        $this->disponibilite = true; 
    
    }
 
    public function getMarque(): string {
        return $this->marque;
    }

    public function getImmatriculation(): int {
        return $this->immatriculation;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getPrixParJour(): float {
        return $this->prixParJour;
    }

    public function getDisponibilite(): bool {
        return $this->disponibilite;
    }

    public function getStatut(): string {
        return $this->disponibilite ? 'Disponible' : 'Indisponible';
    }

    public function setStatut($statut) {
        $this->disponibilite = $statut;
    }

    public function getVehiculs($immatriculation){
        
    }
}