<?php

/**
 * 
 */
class Members extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('members_model');
		$this->load->helper('verification_csk');
	}
	public function index(){
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
		$this->load->view('home', $data);
	}
	public function new_member(){
		//load the configuration file
		$this->load->config('validation_csk',TRUE);
		
		//form validation rules
		//$this->form_validation->set_rules($this->config->item('reg_validation','csk'));
		
		if($this->input->post()){
			$this->form_validation->set_rules($this->config->item('reg_validation','validation_csk'));
			if($this->form_validation->run()===TRUE){
				$member=$this->input->post();
				$result=$this->members_model->register($member);
				if($result){
					print_r($result);
					$this->session->set_flashdata('created',"your CSK code is {$result} thank you for registering");
				}
			}
		}
		
		//the data to the form
		$data['reg_no']=array(
						'name'=>'reg_no',
						'id'=>'reg_no',
						'type'=>'text',
						'class'=>'',
						'value'=>$this->form_validation->set_value('reg_no'),
						'placeholder'=>'C099-09-9999/9999',		
					);
		$data['surname']=array(
						'name'=>'surname',
						'id'=>'surname',
						'type'=>'text',
						'class'=>'',
						'value'=>$this->form_validation->set_value('surname'),
						'placeholder'=>'Doe',			
					);
		$data['other_names']=array(
						'name'=>'other_names',
						'id'=>'other_names',
						'type'=>'text',
						'class'=>'',
						'value'=>$this->form_validation->set_value('other_names'),
						'placeholder'=>'john',			
					);
		$data['email']=array(
						'name'=>'email',
						'id'=>'email',
						'type'=>'email',
						'class'=>'',
						'value'=>$this->form_validation->set_value('email'),
						'placeholder'=>'johndoe@host.com',			
					);
		$data['phone']=array(
						'name'=>'phone',
						'id'=>'phone',
						'type'=>'tel',
						'class'=>'',
						'value'=>$this->form_validation->set_value('phone'),
						'placeholder'=>'0799 999 999',			
					);
		$data['course']=array(
						'name'=>'course',
						'id'=>'course',
						'type'=>'text',
						'class'=>'',
						'value'=>$this->form_validation->set_value('reg_no'),
						'placeholder'=>'Bsc. Computer Science',			
					);
		
	$this->load->view('members/create',$data);
	}
	public function view_all(){
		print_r($this->members_model->get_members());
	}
	public function make_payment(){
		
	}
	public function renewals(){
		
	}
}


















/*End of file: members.php*/
/*location: application/controllers/members.php*/
?>