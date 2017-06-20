<?php

class User {

	private $_db;

	public function __construct($user=null)
	{
		$this->_db=DB::getInstance();
	}

	/**
	 * Create the user account
	 * @param associative array user details--column 
	 * names and values
	 * @return 
	 */

	public function create($params=array())
	{
		//call insert  method and check for error
		if($this->_db->insert('users',$params)->error())
		{
			throw new Exception("Error creating the user account");
		}
	}//create users
}