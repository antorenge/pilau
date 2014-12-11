<?php


/**
 * 
 */
class Members_model extends CI_Model {
	
	public  $tables=array(); //table for the members define in the config file
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
		$this->load->config('validation_csk',TRUE);
		
		//load the databases
		$this->tables=$this->config->item('tables','validation_csk');
		
	}
	public function search($slug, $csk_code=FALSE, $reg_no=FALSE){
		
		$this->db->select('members_details.csk_code as csk_code');
		$this->db->select('registration_no');
		$this->db->select('surname');
		$this->db->select('other_names');
		$this->db->select('email');
		$this->db->select('phone');
		$this->db->select('course');
		$this->db->select('amount');
		$this->db->select('date_paid');
		if($csk_code){
			$this->db->where('members_details.csk_code',$slug);
		}
		if($reg_no){
			$this->db->where('members_details.registration_no',$slug);
		}
		$this->db->join('reg_payments','reg_payments.csk_code=members_details.csk_code','left');
		$this->db->from($this->tables['members']);
		return $this->db->get()->row();
	}
	public function get_members(){
		$this->db->select('*');
		$this->db->from($this->tables['members']);
		return $this->db->get()->result_array();
	}
	public function register($data){
		//begin the transactions
		//get the last entry detail
		//use the detail to add a new user
		
		$this->db->trans_begin();
		//get the id and CSK_Code
			$this->db->select('id');
			$this->db->select('csk_code')
					 ->from($this->tables['members'])
					 ->order_by('id','desc')
					 ->limit(1);
			$num=$this->db->get()->row();
			$coded=$this->get_code((string)$num->csk_code);
			$data_entry=array(
					'csk_code'=>$coded,
					'registration_no'=>$data['reg_no'],
					'surname'=>$data['surname'],
					'other_names'=>$data['other_names'],
					'email'=>$data['email'],
					'phone'=>$data['phone'],
					'course'=>$data['course'],
					'created_at'=>now(),
					'modified_at'=>now(),
				);
				return $data_entry;
	$this->db->insert($this->tables['members'],$data_entry);
	
	if($this->db->trans_status()===FALSE){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return $coded;
		}
	}
	public function update($id){
		
	}
	public function delete($id){
		
	}
	public function check_payment($code){
		$this->db->select('csk_code');
		$this->db->select('amount');
		$this->db->select('date_paid');
		$this->db->select('created_at');
		
		
		//check using the csk code
		$this->db->where('csk_code',$code);
		
	}
	public function check_renewal($code){
		//use the csk code as the search key
		$this->db->select('amount');
		$this->db->select('created_at');
		$this->db->select('start_period');
		$this->db->select('end_period');
		
		//where teh given condition is met
		$this->db->where('csk_code',$code);
		$this->db->from('renewals');
	}
	public function create_renewal($ren_data){
		
		$this->db->insert('renewals',$ren_data);
	}
	public function make_payment(){
		
	}
	private function get_code($prev_code){
			$new_code='';//the new code to be returned
		$pattern="/^(?P<append>CSK)-(?P<code>\d{3,4})\/(?P<year>\d{4})/";
		preg_match($pattern, $prev_code,$output);
		$code=(int)$output['code'];
		$year=(int)$output['year'];

		$cur_year=mdate("%Y", time());
		
		if($year<$cur_year){
			//make the id to be the first
			$new_code=1;
		}else{
			//increase the code by 1
			$new_code=$code+1;
		}
		if($new_code>1000){
			$new_code=$new_code;
		}elseif($new_code>100){
			$new_code='0'.$new_code;
		}elseif($new_code>10){
			$new_code='00'.$new_code;
		}else{
			$new_code='000'.$new_code;
		}
		
		$result='CSK-'.$new_code.'/'.$cur_year;	
		return $result;
	}
}
/*End of file: members_model.php*/
/*Location: application/models/members_model.php*/
?>
