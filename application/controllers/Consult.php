<?php 

	class Consult extends CI_Controller {

		public function index() {
			
			
			
			
			

			


			// Limiter l'access

				

				// chargement du modele "show_model" pour qu'on peut utiliser ses méthodes 
				$this->load->model('show_model');
				$CNE= $this->input->get('CNE');
				$idens= $this->session->userdata('idUser');
				// etuAbs_show() retourne tt les infos necessaire a partir des 3 tableau ;) 
				$data['etuAbsInfo'] = $this->show_model->etu_show_ens($CNE);
				$data['etuAbsInfoo'] = $this->show_model->etuAbs_show($CNE,$idens);
				// on passe les données obtenues a "etudiant_view"
				$this->load->view('etudiant_view', $data);


		}

	}

?>