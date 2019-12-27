<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Enseignant Page</title>
</head>
<body>
	
	<div class="container">
		
		<!-- header -->
		<?php $this->load->view('include/header_view'); ?>

		<!-- navbar -->
		<?php $this->load->view('include/navbar_ens_view'); ?>
		<h2>Vos Modules</h2>

		<?php 
			foreach ($ModuleInfo->result() as $row)
			{
				echo "<h3>";
				echo "<ul>";
					echo "<li>";
						echo $row->intitule_module; echo '     ';echo '<span style="color:#808080; font-size: small; font-style: italic; ">'.$row->etat.'</span>';
					echo "</li>";
					
				echo "</ul>";
				echo "</h3>";
			}
		?>
		

		

		

	<hr>
		<h2>Liste des seances :</h2>
		<br>           
		<center>
		<table class="table table-striped">
	    	<thead>
	    		<tr>
	        		<th>Intitulé</th>
					<th>Date début de semaine  </th>
					<th>Jour</th>
					<th>Heure début</th>
	        		<th>Heure fin</th>
	        	<!--	<th>Classe</th> -->
	        		<th class="ico">liste des étudiants</th>
	      		</tr>
	    	</thead>
	    	<tbody>
				<?php
					foreach ($SeanceInfo->result() as $row)
					{
						echo "<tr>";
					        echo "<td>" . $row->intitule_module . "</td>";
							echo "<td>" . $row->date_debut_semaine . "</td>";
							echo "<td>" . $row->jour . "</td>";
					        echo "<td>" . $row->heure_debut . "</td>";
					        echo "<td>" . $row->heure_fin . "</td>";
							//	echo "<td>" . $row->Classe . "</td>"; 
							echo "<td class=\"ico\">";
							?>
							<button type="button" class="btn btn-default btn-sm">
								<a href="http://localhost/GAbs/index.php/ListClasse/index?id_module=<?php echo $row->id_module;?>&id_seance=<?php echo $row->id_seance;?>">
								<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
							</button>
							<?php
								echo "</td>";
						        echo "<td class=\"ico\">";
					        		?>
							        
									<?php
								echo "</td>";
					    echo "</tr>";
					}
				?>
			</tbody>
  		</table>
			<?php echo "Nombre Total des Seance: " . $SeanceInfo->num_rows(); ?>
			<br><br>
	</center>

	</div>

	

</body>
</html>