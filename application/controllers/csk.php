<?php

/**
 * controlls acces of items through grocery crud
 */
class csk extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->library('grocery_CRUD');
	}
	/*public function index(){
		$this->_csk_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}*/
	public function _csk_output($output=null){
		$this->load->view('csk_view', $output);
	}
	public function members_details(){
		$output = $this->grocery_crud->render();

		$this->_csk_output($output);
	}
	public function members_management(){
		
		/**
		 * members table data
		 * id
		 * csk_code
		 * registration_no
		 * surname
		 * other_names
		 * email
		 * phone
		 * course
		 * created_at
		 * modified_at
		 */
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('members_details');
			$crud->set_subject('Member');
				//relationship

			$crud->fields('csk_code', 'registration_no', 'surname' ,  'other_names' ,'email', 'phone', 'course');
			
			//$crud->required_fields('registration_no');
			$crud->columns('csk_code', 'registration_no', 'surname' ,  'other_names' ,'email', 'phone', 'course');
				$crud->display_as('csk_code', 'CSK code');
				$crud->display_as('registration_no', 'Registration No');
				$crud->display_as('surname', 'Surname');
				$crud->display_as('other_names', 'Other Names');
				$crud->display_as('email', 'Email address');
				$crud->display_as('phone', 'Mobile phone no');
				$crud->display_as('course', 'Course');
				
			$output = $crud->render();

			$this->_csk_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function payments_management(){
		
	}
	public function renewals_management(){
		
	}
}






/*end of file: csk.php*/
/*Location: application/controllers/csk.php*/
?>