<head>
<script> function NoterAbs(){}</script>
    <script> function reloadPage() { location.reload(); } </script>
	<script> function Chkbox(id){
	switch(id){
		case "Absent" :
			document.getElementById("Présent").checked = false	;
			document.getElementById("Absent").checked = true;
		break;
		case "Présent" :
			document.getElementById("Présent").checked = true;
			document.getElementById("Absent").checked = false;
		break;
	}}</script>
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

        

		

			<?php // var_dump($EtuAbsInfo->result()); ?>
			<h3>Liste des etudiants :</h3>
			<table class="table table-striped">
		    	<thead>
		    		<tr>
		        	
                        <th>CNE</th>
                        <th>Classe</th>
		        		<th>Nom</th>
		        		<th>Prenom</th>
		        		
		        	
		        		<th class="ico"></th>
		        	
		      		</tr>
		    	</thead>
		    	<tbody>
				<?php 
					$id_seance=$this->input->GET('id_seance');
					
					
					
	                echo form_open_multipart("ListClasse/Valider", $id_seance);?> 
					<?php  
						foreach ($etuInfo->result() as $row)
						{
							echo "<tr>";
								
                                echo "<td>" . $row->CNE . "</td>";
                                echo "<td>" . $row->Classe . "</td>";
						        echo "<td>" . $row->nom_etu . "</td>";
						        echo "<td>" . $row->prenom_etu . "</td>";
								echo "<td class=\"ico\">";
								
								echo '<td><input type="checkbox" name="Absent[]" value="'.$row->id_user.'">';
								echo "</td>";
						        
						        
						
						       
								
								
						    echo "</tr>";
						}
					?>
					<input type="hidden"  name="id_seance" value=<?php echo $id_seance ?>>
                </tbody>
                <br><br>
			
					
				
				
				<div class="form-group">
	                    
	                
                <input type="Submit" class="btn btn-primary" value="Valider" >
				<input type="Reset" class="btn btn-default btn" value="Réinitialiser" onclick="reloadPage()">
				</div>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('msg'); ?>
				
				<br><br>
	  		</table>
	

	</div>

	
</body>
</html>