<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Etudiant Page</title>
	<style type="text/css">
	.container {
		margin-bottom: 25px;
	}
	</style>
</head>
<body>

	<div class="container">
	
		<!-- header -->
		<?php $this->load->view('include/header_view'); ?>
		

		<!-- navbar -->
		<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Espace Enseignant</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><a href="http://localhost/GAbs/index.php/enseignant">Mes Séances</a></li>
            <li><a href="http://localhost/GAbs/index.php/enseignant/listeEtuens">Mes Etudiants </a></li>
            <li><a href="http://localhost/GAbs/index.php/enseignant/listeAbs">Mes absences</a></li>
        </ul>
            
    </div>
</nav>

	<center>
		
		<!-- ADD here les infos de l'etudiant ;) please  DONE-->
		<?php $info_etu = $etuAbsInfo->row(0) ?>
		<h3>L'étudiant <b><?php echo $info_etu->nom_etu ." ". $info_etu->prenom_etu; ?></b></h3>
		<div class="col-md-6 col-md-offset-3 well">
			
			<p>CNE : <b><?php echo $info_etu->CNE; ?></b></p>
			<p>Nom : <b><?php echo $info_etu->nom_etu; ?></b></p>
			<p>Prenom : <b><?php echo $info_etu->prenom_etu; ?></b></p>
			<p>Filière : <b><?php echo $info_etu->filière; ?></b></p>
			<p>Année : <b><?php echo $info_etu->année; ?></b></p>
			
			
			<p>Email : <b><?php echo $info_etu->email_etu; ?></b></p>
			
		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<!-- Si il n'y a pas d'absence id_absence va etre vide ;) donc je l'exploit-->		
		<?php if(!empty($etuAbsInfoo->row(0)->id_absence)): ?>

			<h3>Table d'absence de l'étudiant <b><?php echo $info_etu->nom_etu ." ". $info_etu->prenom_etu; ?></b></h3>
			<br>           
			<table class="table table-striped">
		    	<thead>
		    		<tr>
		        		<th>Module</th>
						<th>Date debut semaine</th>
						<th>Jour</th>
		        		<th>Heure debut</th>
		        		<th>Heure fin</th>
		        		<th>Classe</th>
		        		<th>Justifiee</th>
		        		
		      		</tr>
		    	</thead>
		    	<tbody>
					<?php  
						// var_dump($etuAbsInfo->result());
						foreach ($etuAbsInfoo->result() as $row)
						{
							echo "<tr>";
						        echo "<td>" . $row->intitule_module . "</td>";
								echo "<td>" . $row->date_debut_semaine . "</td>";
								echo "<td>" . $row->jour. "</td>";
						        echo "<td>" . $row->heure_debut . "</td>";
						        echo "<td>" . $row->heure_fin . "</td>";
						        echo "<td>" . $row->Classe . "</td>";
						        echo "<td>" . $row->justifiee . "</td>";
								
						    echo "</tr>";
						}
					?>
				</tbody>
	  		</table>
				<?php echo "Nombre Total d'absences: " . $etuAbsInfoo->num_rows(); ?>

		<?php else : ?>
				<br>
				<?php echo "Nombre Total d'absences: 0"; ?>
		<?php endif; ?>
	</center>
	</div>

	<!-- footer -->
	
	
</body>
</html>