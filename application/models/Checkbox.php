<?php

    session_start();
    if(isset($_POST['login']))
    $_SESSION['id_enseignant']=$l->id_enseignant;
    $Id_enseignant= $_SESSION['id_enseignant'];
    echo  $Id_enseignant;
    
   
 if(isset($_POST['Submit'])){
     if(!empty($_POST['Absent'])){
         foreach($_POST['Absent'] as $var){
             $sql="INSERT INTO absences(id_ens,id_seance,id_etu) VALUES('$Id_enseignant', '$matiere', '$var')";
                $resultat=mysqli_query($db,$sql);
             }
     }}
?>