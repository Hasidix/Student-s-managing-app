<?php 

	class ListClasse extends CI_Controller {

		public function index() {
			
			
			
			
			

			


			// Limiter l'access

				

				// chargement du modele "show_model" pour qu'on peut utiliser ses méthodes 
				$this->load->model('show_model');
				$idModule= $this->input->get('id_module');
				
				// etuAbs_show() retourne tt les infos necessaire a partir des 3 tableau ;) 
				$data['etuInfo'] = $this->show_model->List_etu_show($idModule);
				
				// on passe les données obtenues a "etudiant_view"
				$this->load->view('List_etudiant_view', $data);


		}
		public function Valider(){
			
			$id_seance=$_POST['id_seance'];
			if(!empty($_POST['Absent'])){
				foreach($_POST['Absent'] as $row){
					$id_user=$row;
					$this->load->model('insert_model');
					    $absencedata=array(
						'id_seance' => $id_seance,
						'id_user' => $id_user,
						'justifiee' => '0',);

						$this->insert_model->insert_absence($absencedata);


						redirect('enseignant');
					
					}
			}
			
			
						



		

	
}
	}
?>