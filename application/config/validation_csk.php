<?php

/**
	 * Index Page for default controller.
	 * @author: Oscar Oluoch
	 * @version 1.0.0
	 *  luoch.scar@gmail.com
	 * http://github.com/donozone
	 * 
	 */
	 
	 
//the required tables for the members
$config['tables']['members']='members_details';//provide the table name
$config['tables']['payments']='reg_payments';
$config['tables']['renewals']='renewals';
$config['tables']['skill']='skill';
$config['tables']['member_skill']='member_skill';
$config['tables']['images']='members_img';

//validation rules
$config['reg_validation']=array(
						array(
						
							'field'=>'reg_no',
							'label'=>'Registration number',
							'rules'=>'trim|required|is_unique[members_details.registration_no]|min_length[14]|max_length[18]|xss_clean',
						),
						array(
							'field'=>'surname',
							'label'=>'Surname',
							'rules'=>'trim|required|max_length[15]|xss_clean',
						),
						array(
							'field'=>'other_names',
							'label'=>'other names',
							'rules'=>'trim|required|max_length[30]|xss_clean',
						),
						array(
							'field'=>'email',
							'label'=>'Email address',
							'rules'=>'trim|required|valid_email|max_length[64]|xss_clean',
						),
						array(
							'field'=>'phone',
							'label'=>'phone number',
							'rules'=>'trim|required|min_length[8]|max_length[12]|xss_clean',
						),
						array(
							'field'=>'course',
							'label'=>'Course',
							'rules'=>'trim|required|xss_clean',
						),
					);






/*End of file: validation_csk.php*/
/*Location: application/config/validation_csk.php*/
