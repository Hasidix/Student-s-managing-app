<?php 

class Show_model extends CI_Model {

	public function etuAbs_show($CNE,$idens) {

		// hahaaaa ! get them aaaall :D
		$sql = "SELECT * FROM Absence,Affecter, Seance,Module, Etudier, Etudiant 
			WHERE Absence.id_seance= Seance.id_seance 
			AND Absence.id_user= Etudiant.id_user
			and module.id_module=seance.id_module
			And module.id_module=affecter.id_module
			and seance.id_module=etudier.id_module
			AND seance.id_user=?
			AND Absence.id_user= Etudiant.id_user
			AND Etudiant.CNE= ? 
			AND Affecter.id_user= ?
			group by module.intitule_module,absence.id_absence";

		$query  = $this->db->query($sql, array($idens,$CNE,$idens));

		// Si l'etudiant n'a pas d'absence
		if (empty($query->result())) {
			// affiche simplement les infos de l'etudiant
			$query = $this->db->query("SELECT * FROM Etudiant 
				WHERE Etudiant.CNE = '".$CNE."'");

			return $query;
		}
		
		return $query;  // $query->result()

	}
// OUSSAMA

 public function etu_show_ens($CNE) {

	$query = $this->db->query("SELECT * FROM Etudiant WHERE Etudiant.CNE='".$CNE."'"
 
								);

	return $query; 
}
public function List_etu_show($idModule) {

	$query = $this->db->query("SELECT * FROM Etudiant,Etudier WHERE Etudiant.id_user=Etudier.id_user
	AND Etudier.id_module='".$idModule."'
	ORDER BY Classe ASC"
 
								);

	return $query; 
}
public function List_etu_ens_show($id) {

	$query = $this->db->query("SELECT * FROM Etudiant,Etudier,Module,Affecter WHERE Etudiant.id_user=Etudier.id_user
	AND Etudier.id_module=Module.id_module
	And Module.id_module=Affecter.id_module
	And Affecter.id_user='".$id."'
	Group by Etudiant.id_user
	ORDER BY Classe ASC"
 
								);

	return $query; 
}

//stop
	public function all_etu_show() {

		$query = $this->db->query("SELECT * FROM Etudiant, User 
									WHERE Etudiant.id_user=User.id_user
									ORDER BY access DESC");

		return $query; 

	}

	// Cette fonction retourn tt les infos except la photo
	public function export_all_etu() {

		$query = $this->db->query("SELECT CNE, nom_etu, prenom_etu, date_naiss_etu, ville_naiss_etu, 
									adresse_etu, ville_etu, email_etu, phone_etu 
									FROM Etudiant, User 
									WHERE Etudiant.id_user=User.id_user
									ORDER BY access DESC");

		return $query; 

	}

	

	public function all_ens_show() {

		$query = $this->db->query("SELECT * FROM Enseignant, User 
									WHERE Enseignant.id_user=User.id_user
									ORDER BY access DESC");

		return $query; 

	}

	// Cette fonction retourn tt les infos except la photo
	public function export_all_ens() {

		$query = $this->db->query("SELECT nom_ens, prenom_ens, adresse_ens, ville_ens, email_ens, phone_ens 
									FROM Enseignant, User 
									WHERE Enseignant.id_user=User.id_user
									ORDER BY access DESC");

		return $query; 

	}

	public function all_admin_show() { // kant *

		$query = $this->db->query("SELECT login, nom_admin, prenom_admin, email_admin, access 
									FROM Admin, User 
									WHERE Admin.id_user=User.id_user
									ORDER BY access DESC");

		return $query; 

	}

	public function all_module_show() {

		$query = $this->db->query("SELECT * FROM Module");

		return $query; 

	}


	public function module_show($idUser) {

		$sql = "SELECT * FROM Module, Affecter, Enseignant
			WHERE Module.id_module=Affecter.id_module
			AND enseignant.id_user= ?
			AND Affecter.id_user= ?
			Order by module.etat asc";

		$query  = $this->db->query($sql, array($idUser, $idUser));

		return $query;

	}

	public function seance_show($idUser) {

		$sql = "SELECT DISTINCT * FROM Seance, Module, Enseignant
			WHERE seance.id_module = module.id_module
			And module.etat='en cours'
			AND Seance.id_user= ?
			AND Enseignant.id_user= ?
			Order BY date_debut_semaine desc, case jour
                 WHEN 'Lundi' THEN 1 
                 WHEN 'Mardi' THEN 2 
                 WHEN 'Mercredi' THEN 3 
                 WHEN 'Jeudi' THEN 4 
                 WHEN 'Vendredi' THEN 5 
                 WHEN 'Samedi' THEN 6 
                 WHEN 'Dimanche' THEN 7 END
		
				 

			

			 " ;

		$query  = $this->db->query($sql, array($idUser, $idUser));

		return $query;

	}

	// Fonction pour obtenir id_module à partir du nom_module ;)
	public function get_id_module($nom_module) {

		// la requete
		$query = $this->db->query("SELECT id_module FROM Module
			WHERE Module.intitule_module='".$nom_module."'");

		// on prend id_module
		$row = $query->row_array(0);
		$idModule = $row['id_module'];

		return $idModule;

	}

	// Fonction pour obtenir les CNE des etudiant qui ont au moins une abs
	// $idUser c'est du prof est pas l'etudiant ! 
	public function get_cne_abs($idUser) {

		$query = $this->db->query(
			"SELECT DISTINCT etudiant.CNE
			FROM enseignant, affecter, module, etudier, etudiant, seance, absence
			WHERE affecter.id_user = enseignant.id_user
			AND affecter.id_module = module.id_module
			AND etudier.id_user = etudiant.id_user
			AND seance.id_module = module.id_module
			AND seance.id_seance = absence.id_seance
			AND absence.id_user = etudiant.id_user
			AND enseignant.id_user = '".$idUser."'");

		return $query;
	}

	// Fonction pour get All Abs and related infos ;) wohoooo !
	public function get_all_abs($idUser) {

		// étape 2 : get id_module from affecter table where id = id_ens (les modules affecter a cet ens)
		// étape 3 : get nom_module from Module table à l'aide de id_module
		// étape 4 : get id_etu from Etudier table where id = id_module
		// étape 5 : get * from Etudiant table where id = id_etu
		// étape 6 : get * from seance table where id = id_etu
		// étape 7 : get * from absence table where id = id_etu

		$query = $this->db->query(
			"SELECT DISTINCT absence.id_absence,module.intitule_module, 
					etudiant.CNE, etudiant.nom_etu , etudiant.prenom_etu, 
					absence.justifiee, 
					seance.date_debut_semaine,seance.jour, seance.heure_debut, seance.heure_fin, seance.type_seance
			FROM enseignant, affecter, module, etudier, etudiant, seance, absence
			WHERE affecter.id_user = enseignant.id_user
			AND affecter.id_module = module.id_module
			AND etudier.id_user = etudiant.id_user
			AND seance.id_module = module.id_module
			AND seance.id_seance = absence.id_seance
			AND absence.id_user = etudiant.id_user
			AND enseignant.id_user = '".$idUser."'");

		return $query;

	}


	// Fonction pour get All Abs and related infos ;) wohoooo !
	public function get_abs_etu($idUser, $cne) {

		$sql = "SELECT DISTINCT module.intitule_module, 
						etudiant.CNE, etudiant.nom_etu , etudiant.prenom_etu, 
						absence.justifiee, 
						seance.date_debut_semaine,seance.jour, seance.heure_debut, seance.heure_fin, seance.type_seance
				FROM enseignant, affecter, module, etudier, etudiant, seance, absence
				WHERE affecter.id_user = enseignant.id_user
				AND affecter.id_module = module.id_module
				AND etudier.id_user = etudiant.id_user
				/* AND etudier.id_module = module.id_module */
				AND seance.id_module = module.id_module
				AND seance.id_seance = absence.id_seance
				AND absence.id_user = etudiant.id_user
				AND enseignant.id_user = ?
				AND etudiant.cne = ?";
		$query  = $this->db->query($sql, array($idUser, $cne));

		return $query;

	}


}

?>