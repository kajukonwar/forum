<?php
 class Validate {


   private  $_passed=false,
   			$_errors=array(),
   			$_db=null;

   public function __construct()
   {
   		$this->_db=DB::getInstance();
   }

   /**
    * Check the validation rules
    * @param string server method type
    * @param array  validation rules
    * @return object 
    */

   public function check($type, $items=array()) {

   	 	foreach($items as $item=>$rules)
   	 	{
   	 		$input_value=trim($type[$item]);

   	 		foreach($rules as $rule=>$rule_value)
   	 		{
   	 			if(empty($input_value))
   	 			{
   	 						if($rule=="requirred") {
   	 							$this->addErrors($item,"This is requirred");
   	 							
   	 						}

   	 					break;	
   	 			}
   	 			else
   	 			{
   	 				switch($rule)
   	 			{
   	 				
   	 				case "min":
   	 					if(strlen($input_value)<$rule_value)
   	 					{
   	 						$this->addErrors($item,"Minimum {$rule_value} characters needed");
   	 					}
   	 					break;

   	 				case "max":
   	 					if(strlen($input_value)>$rule_value)
   	 					{
   	 						$this->addErrors($item,"maximum {$rule_value} characters allowed");
   	 					}
   	 					break;

   	 				case "unique":
   	 				
   	 					$unique_check=$this->_db->getConditional("SELECT id FROM {$item} WHERE {$input_value}=?",array(
   	 						$item=>$input_value
   	 						));

   	 					if(!$unique_check->error()&&$unique_check->count())
   	 					{
   	 						$this->addErrors($item,"{$item} already exists");
   	 					}
   	 					
   	 					
   	 					break;

   	 				default:

   	 			}//switch
   	 		}//if/else

   	 			
   	 		}//inner loop
   	 	}//outer loop


   	 	if(empty($this->errors())) {
   	 		$this->_passed=true;
   	 	}

   	 	return $this;
   }//check

   private function addErrors($item,$error) {
   		$this->_errors[$item][]=$error;
   }

   public function errors() {

   		return $this->_errors;
   }

   public function passed() {

   	 	return $this->_passed;
   }
 }//end class