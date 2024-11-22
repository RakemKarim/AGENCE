<?php 

class Client{
    private $prenom;


    public function __construct(   $prenom){
        
        $this->prenom = $prenom;
       
    }


	public function setPrenom( $prenom): void {
        $this->prenom = $prenom;
    }


	public function getPrenom() {return $this->prenom;}

}