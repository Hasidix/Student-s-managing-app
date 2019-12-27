<?php 

	class Enseignant extends CI_Controller {

		public function index() {

			// Limiter l'access
			if($this->session->userdata('type') == 'enseignant') {

				$this->load->model('show_model');

				// $idUser contient l'ID de l'utilisateur connecté
				$idUser = $this->session->userdata('idUser');

				// module_show() retourne tt les modules ensignés par cet enseignant
				$data['ModuleInfo'] = $this->show_model->module_show($idUser);
				

				// seance_show() retourne tt les seances enseignés par cet ens
				$data['SeanceInfo'] = $this->show_model->seance_show($idUser);

				// on passe les données obtenues a "admin_view"
				$this->load->view('enseignant_view', $data);

			} else {
				echo "<h1>VOUS N'AVEZ PAS LE DROIT D'ÊTRE ICI !!</h1>";
			}

		}
		public function listeEtuens(){
			$this->load->model('show_model');

			if($this->session->userdata('type')=='enseignant'){
				$id=$this->session->userdata('idUser');
				$data['etuInfo'] = $this->show_model->List_etu_ens_show($id);
				

					$this->load->view('etudiant_ens_view', $data);}






			
		}
		

	


		public function listeAbs() {
			$this->load->model('show_model');
		

			// Limiter l'access
			if($this->session->userdata('type') == 'enseignant') {

				// On va passer par 7 étapes :
				// étape 1 : get id_ens from ens table (l'utilisateur connecté actuellement)
				// étape 2 : get id_module from affecter table where id = id_ens (les modules affecter a cet ens)
				// étape 3 : get nom_module from Module table à l'aide de id_module
				// étape 4 : get id_etu from Etudier table where id = id_module
				// étape 5 : get * from Etudiant table where id = id_etu
				// étape 6 : get * from seance table where id = id_etu
				// étape 7 : get * from absence table where id = id_etu

				// here we go !!!
				$this->load->model('show_model');

				// étape 1
				$idUser = $this->session->userdata('idUser');

				// Si il n'a pas encore cliquer sur afficher, y a affichage de tt les abs
				if (!$this->input->post('submit')) {
					
					// ici les étapes 2 -> 7
					$data['allAbsInfo'] = $this->show_model->get_all_abs($idUser);

					// get CNE etudiant (see model)
					$data['CNEEtuAbsInfo'] = $this->show_model->get_cne_abs($idUser);

					// pour eviter l'erreur de "Undefined variable bla bla bla"
					$data['EtuAbsInfo'] = FALSE;

					$this->load->view('listeAbs_view', $data);

				}


				// pour avoir les infos d'un etudiant spécifique, selon son CNE
				elseif ($this->input->post('submit')) {

					// get le CNE selectionner
					$cne = $this->input->post('cne');
					// je vais le garder, pour le passer à l'export aprés ;)
					$this->session->set_flashdata('cne', $cne);

					$data['EtuAbsInfo'] = $this->show_model->get_abs_etu($idUser, $cne);

					// pour eviter l'erreur de "Undefined variable bla bla bla"
					$data['allAbsInfo'] = FALSE;

					$this->load->view('listeAbs_view', $data);

				}

			} else {
				echo "<h1>VOUS N'AVEZ PAS LE DROIT D'ÊTRE ICI !!</h1>";
			}

		}

		// Fonction pour avoir les infos d'un etudiant spécifique, selon son CNE
		public function listeAbsEtu() { // pas encore traité

			// Limiter l'access
			if($this->session->userdata('type') == 'enseignant') {

				$this->load->model('show_model');

				$idUser = $this->session->userdata('idUser');

			} else {
				echo "<h1>VOUS N'AVEZ PAS LE DROIT D'ÊTRE ICI !!</h1>";
			}

		}


		public function listeEtu() { // pas encore traité

			// Limiter l'access
			if($this->session->userdata('type') == 'enseignant') {

				$this->load->model('show_model');

				// get id de l'utilisateur connecté actuellement
				$idUser = $this->session->userdata('idUser');

				// get les modules affecter a cet ens
				$data['ModuleInfo'] = $this->show_model->module_show($idUser);

				

			} else {
				echo "<h1>VOUS N'AVEZ PAS LE DROIT D'ÊTRE ICI !!</h1>";
			}

		}
		public function deleteAbs() {

			$this->load->model('delete_model');

			$id = $this->input->get('id');

			$this->delete_model->delete_abs($id);

			redirect('enseignant/listeAbs');

		}
		public function editAbs() {

			$this->load->model('edit_model');

			$id = $this->input->get('id');

			$this->edit_model->edit_abs($id);

			redirect('enseignant/listeAbs');

		}


			
		
		

	}

?>