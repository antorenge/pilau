<?php

/**
 * checks if the passed parameter is a CSK code
 * @param String csk_code
 * @return boolean 
 */
function check_code($csk_code){
		$csk_code=strtoupper($csk_code);
	//take the code passed
		$pattern="/^(?P<append>CSK)-(?P<code>\d{3,4})\/(?P<year>\d{4})/";
		if(!preg_match($pattern, $csk_code,$output)){
			  //String not a code
			return FALSE;
		}else{
			return TRUE;
		}
			
}
/**
 * checks if the passed parameter is a registration number
 * @param String registration number
 * @return boolean
 */
function check_reg($registration_no){
	//take the code passed
		$pattern="/^([a-zA-Z]\d{3})-?(\d{2})?-(\d{4})\/(\d{2,4})/";
		if(!preg_match($pattern, $registration_no,$output)){
			 //String not a registration number
			return FALSE;
		}else{
			return TRUE;
		}
}







/*End of file: csk.php*/
/*Location: application/helpers/csk.php*/
?>