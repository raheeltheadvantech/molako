<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_home_model extends User_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function AddUser($data = array())
	{
		return $this->User_CRUD($data);
	}
	
	function UpdateUser($data = array())
	{
		return $this->User_CRUD($data, 'UPDATE');
	}
	
	function DeleteUser($data = array())
	{
		return $this->User_CRUD($data, 'DELETE');
	}
	
	private function User_CRUD($data = array(), $operation = 'INSERT')
	{
		if(empty($data) or !is_array($data))
		{
			return false;
		}
		
		try
		{
			$db_cols = array('UserID', 'FirstName', 'LastName', 'Email', );
			$out_vars = array('@CustomSUM', '@TestSomething', );
			$last_insert_id = '@pLAST_INSERT_ID';
			
			$save = $bind_marker = array();
			foreach($db_cols as $db_col)
			{
				$bind_marker[] = '?';
				
				$col_val = NULL;
				
				if(isset($data[$db_col]))
				{
					$col_val = $data[$db_col];
				}
				
				$save[] = $col_val;
			}
			
			$db_markers = implode(',', $bind_marker);
			
			$sp_params = $db_markers. (!empty($last_insert_id) ? ', '.$last_insert_id : '');
			
			$sql = 'CALL `PROC_User_CRUD`('. $sp_params .')';
			$this->db->trans_start();
			$result = $this->db->query($sql, $save);
			//echo $this->db->last_query();die;
			if(!$result)
			{
				return FALSE;
			}
			
			$query = $this->db->query("SELECT @pLAST_INSERT_ID AS last_insert_id");
			$row = $query->row();
			if(!$row)
			{
				return FALSE;
			}
			
			$last_insert_id = intval($row->last_insert_id);
			
			//var_dump($row);die;
			//echo $this->db->last_query();die;
			//$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			
			return $last_insert_id;
        }
		catch(Exception $e)
		{
			echo $e->getMessage();
        }
		
        return $result;
	}
}
// END User_home_model class

/* End of file User_home_model.php */
/* Location: ./application/models/user/User_home_model.php */