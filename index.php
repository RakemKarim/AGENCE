<?php
session_start();

include "classes/Client.php";
include "classes/GestionVehicules.php";
include "classes/Vehicules.php";



//include "vue/header.php";



if( !isset($_GET['action']) ){
    include "vue/connexion.php";
}

//include "vue/footer.php";
