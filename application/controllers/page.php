<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	/**
	 * Index Page for default controller.
	 * @author: Antony Oroko
	 * @version 1.0.0
	 *  antoroko@gmail.com
	 * http://github.com/antoroko
	 * 
	 */
	 
	function __construct() {
		parent::__construct();
		$this->load->model('members_model');
		$this->load->helper('verification_csk');
	}
	
	public function index(){
			
		$data['main_content']='home_view';	
		$data['title']='CSK Members';		
		//search data
		$data['search']=array(
							'name' =>'search',
							'id'   =>'search',
							'type' =>'text',
							'value'=>($this->input->post('search')) ? $this->input->post('search'): '',
						);
		if($this->input->post()){
			//example of csk
			$search = $this->input->post('search');
			
			if(check_code($search)){
				$search=strtoupper($search);
				$result = $this->members_model->search($search,$CSK=TRUE,$REG=FALSE);
			}elseif(check_reg($search)){
				$result = $this->members_model->search($search,$CSK=FALSE,$REG=TRUE);
			}else{
				$result['message']="Sorry your query must be csk code or registration number";
			}
			
			//$pattern;
			$data['result']=$result;
		}
		
		$this->load->view('include/template', $data);
		
	}
	
	public function dissertation() {
		
		$data['script'] = null;	
		$data['main_content']='dissertation_view';
		$this->load->view('includes/template',$data);
		
	}
	
	public function privacy() {
		$data['script'] = null;	
		$data['main_content']='privacy_view';
		$this->load->view('includes/template',$data);
	} 
	
}
