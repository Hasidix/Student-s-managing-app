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
		

		

		

	<hr>
		<h2>Liste des étudiants de mes séances :</h2>
		<table class="table table-striped">
		    	<thead>
		    		<tr>
		        		
		        		<th>CNE</th>
		        		<th>Nom</th>
		        		<th>Prenom</th>
		        		
						<th>Classe</th>
		        		
		        		<th class="ico">Consulter</th>
		  
		      		</tr>
		    	</thead>
		    	<tbody>
					<?php  
						foreach ($etuInfo->result() as $row)
						{
							echo "<tr>";
								
						        echo "<td>" . $row->CNE . "</td>";
						        echo "<td>" . $row->nom_etu . "</td>";
						        echo "<td>" . $row->prenom_etu . "</td>";
						       
								echo "<td>" . $row->Classe . "</td>";
						        
						        echo "<td class=\"ico\">";
					        		?>
							        <button type="button" class="btn btn-default btn-sm">
									<a href="http://localhost/GAbs/index.php/Consult/index?CNE=<?php echo $row->CNE;?>">
									    <span class="glyphicon glyphicon-education" aria-hidden="true"></span>
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
			<br>
			<center>
	  			<?php echo "Il y en a : <b>" . $etuInfo->num_rows() . " etudiant(s) </b>" ?>
	  			<br><br>
				
			</center>	
			<br><br>
	<!-- footer -->
	
</body>
</html>