<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tp1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('tp1.php',(array)$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	

	public function documents()
	{
		$crud = new grocery_CRUD();
		$crud->set_language("french");
		$crud->set_table('Documents');
		$crud->set_relation_n_n('auteurs', 'Livres_auteurs', 'Utilisateur', 'id_doc', 'id_user', 'nom','ordre');

	        	$crud->set_subject('Documents')
	        	->columns('id','titre','anee','auteurs','type', 'niv_config')
	        	->display_as('id','Identificateur')
	        	->display_as('titre','Titre')
	        	->display_as('anee','Anée')
	        	->display_as('niv_config','Confidentialité')
	        	->display_as('type','Type');

		$crud->set_rules('anee','Anée','numeric');
		$crud->fields('titre','anee','type','auteurs','niv_config'); //To edit or create
		$crud->required_fields('titre','anee','type','niv_config');

		$output = $crud->render();

		$this->_example_output($output);
	}



	public function utilisateurs()
	{
		$crud = new grocery_CRUD();
		$crud->set_language("french");
		$crud->set_table('Utilisateur')
	        	->set_subject('Utilisateurs')
	        	->columns('id','nom','prenom','config')
	        	->display_as('id','Identificateur')
	        	->display_as('nom','Nom')
	        	->display_as('prenom','Prénom')
	        	->display_as('config',"Privilèges d'administrateur");

		$crud->fields('nom','prenom','config'); //To edit or create
		$crud->required_fields('prenom','nom','type','config');

		$output = $crud->render();

		$this->_example_output($output);
	}


public function emprunts()
	{
		$crud = new grocery_CRUD();
		$crud->set_language("french");
		$crud->set_table('Emprunt');
		$crud->set_subject('Emprunts')
	        	->display_as('id_doc','Document')
	        	->display_as('id_user','Utilisateur')
	        	->display_as('date_debut','Date Début')
	        	->display_as('date_fin','Date Fin');

	        	$crud->set_relation('id_doc', 'Documents', 'titre');
		$crud->set_relation('id_user', 'Utilisateur', 'nom');

		$crud->fields('id_doc','id_user','date_debut','date_fin');



		$output = $crud->render();

		$this->_example_output($output);
	}





}
