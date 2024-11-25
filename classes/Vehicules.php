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
        $this->$disponibilite=true;
    }
    public function getId() {
        return $this->id;
    }
  
 
    public function getStatut() {
        return $this->disponibilite ? 'Disponible' : 'Indisponible';
    }

    public function setStatut($statut) {
        $this->disponibilite = $statut;
    }

}