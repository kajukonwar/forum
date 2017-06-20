<?php
class DB{

	private static  $_instance=null;
	private 	    $_pdo,
					$_query,
					$_error=false,
					$_count=0,
					$_results=NULL;


	private function __construct()
	{
		try {
			
			//$this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->db_user, $this->db_password);

			$this->_pdo = new PDO('mysql:host='.$GLOBALS["_forum_config"]["mysql"]["host"].';dbname='.$GLOBALS["_forum_config"]["mysql"]["db"],$GLOBALS['_forum_config']['mysql']['username'], $GLOBALS['_forum_config']['mysql']['password']);

		} catch (PDOException $e) {

			die($e->getmessage());
			
		}
	}//end construct


	/**
	 * returns database instance
	 * only one instance is returned satisfying 
	 * singleton pattern
	 */

	public static function getInstance() {


		if(!isset(self::$_instance))
		{
			 self::$_instance =new DB();
		}

		return self::$_instance;

		
	}


	/**
	 *
	 *
	 */
	public function query($sql,$params=array())
	{

		
		$this->_error=false;
   	  	$this->_count=0;
   	  	$this->_results=NULL;

		if($this->_query=$this->_pdo->prepare($sql))
		{
			//have parameters
			if(count($params))
			{

				if(!$this->_query->execute($params))
				{
					$this->_error=true;
				}
				
			}//if
			//no parameters passed
			else
			{
				if(!$this->_query->execute())
				{
					$this->_error=true;
				}
			}//else

			//end if-else

		}//if
		else{

			$this->_error=true;
		}
		//end if-else

		return $this;

	}//end query


	/**
	 * Insert into database
	 * @param table name, column names and values
	 * $param is associative array with key-column name
	 * and value --column values
	 * @return  $this
	 */
	public function insert($table,$params=array())
	{


		if(count($params))
		{
			$values="";

			$i=1;

			//add the question marks into query
			while($i<count($params))
			{
				$values .="?, ";
				$i++;
			}

			$values .="?";
			$values=trim($values);

			//make the final query
			$sql="INSERT INTO ".$table."(".implode(",",array_keys($params)).") values(".$values.")";

			//get the column values to be inserted
			$column_values=array();
			foreach($params as $param)
			{
			  $column_values[]=$param;
			}
			//send request to execute
			return $this->query($sql,$column_values);
			
		}
		else{

			$this->_error=true;
			return $this;
		}
	

	}//end insert


	/**
	 * Returns the error variable
	 */
   public  function error()
   {

   		return $this->_error;

   }
    //end error

   /**
    * Get results
    * @param string table name
    * @return $this
    */

   public function get($table=NULL)
   {

      if($table)
      {
      	$sql="SELECT * FROM ".$table;

      	//query executed sucessfully
      	if(!$this->query($sql)->error())
      	{
      		$this->_results=$this->_query->fetchAll(PDO::FETCH_OBJ);
      		$this->_count=$this->_query->rowCount();
      	}

      }
      else{

      	$this->_error=true;
      }

      return $this;

   }//end select

   /**
    * Returns the count rows returnd from select query
    */
   public function count()
   {

   	  return $this->_count;
   }//count

   /**
    * Returns the results of select query
    */

   public function results(){

   	  return $this->_results;
   }//results


   /**
    * update query
    * @param string sql query
    * @param associative array with key pointing to  
    * column names and values pointing to column values
    * @return $this
    */
   public function update($sql=NULL,$params=array())
   {

   	  
   	  if(!empty($sql)&&!empty($params))
   	  {
   	  	//no error
   	  	//get the column values
		$column_values=array();
		foreach($params as $param)
		{
			$column_values[]=$param;
		}
   	  	//query executed sucessfully
   	  	if(!$this->query($sql,$column_values)->error())
   	  	{

      		$this->_count=$this->_query->rowCount();
   	  	}
   	  }
   	  else
   	  {

   	  	$this->_error=true;
   	  }
   	  return $this;
   }//end update

   /**
    * delete query
    * @param string sql query
    * @param associative array with key pointing to  
    * column names and values pointing to column values
    * @return  $this
    */
   public function delete($sql=NULL,$params=array())
   {

   	  
   	  if(!empty($sql)&&!empty($params))
   	  {
   	  	//no error

   	  	//get the column values
		$column_values=array();
		foreach($params as $param)
		{
			$column_values[]=$param;
		}

		//query executed sucessfully
   	  	if(!$this->query($sql,$column_values)->error())
   	  	{

      		$this->_count=$this->_query->rowCount();
   	  	}
   	  }
   	  else
   	  {

   	  	$this->_error=true;
   	  }
   	  return $this;
   }//end update

}//class
?>