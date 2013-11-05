<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{		
			
			$this->load->library('session');
			$this->load->database();

		
			if(isset($_REQUEST['sub']) && $_REQUEST['sub']=='Upload' && trim($this->session->userdata('time'))==trim($_REQUEST['txttime'])){
				$this->load->library('csvreader');
				$config['upload_path'] = '/var/www/sample/uploads/';
				$config['allowed_types'] = '*';
				$config['max_size']	= '2000';
				$config['file_name']	= $this->session->userdata('time').'test.csv';		
				
				$ext = substr($_FILES['csvfile']['name'],-3);
				if(($ext=='csv') && ($_FILES['csvfile']['size']>0))
				{
					if ( ! @move_uploaded_file($_FILES['csvfile']['tmp_name'], $config['upload_path'].$config['file_name']))
					{
						$data['error'] = array('error' => 'File not uploaded. Please try again!');
					}
					else
					{
						$this->session->unset_userdata('time');

						$data['msg'] = array('upload_data' => 'File uploaded successfully.');
					}
				}else{
					$data['error'] = array('error' => 'Only csv files with valid size are allowed to upload.');
				}					
				if(file_exists($config['upload_path'].$config['file_name']))
				{
					$result =   $this->csvreader->parse_file($config['upload_path'].$config['file_name']);//path to csv file
					$csvData =  $result;
		
					foreach($csvData as $field)
					{
						if(isset($field['portfolio_id']) && trim($field['portfolio_id'])!='na')
						{
							$sqlCheck = "SELECT * FROM portfolio WHERE portfolio_id = ?";
							$query = $this->db->query($sqlCheck, $field['portfolio_id']);
							if($query->num_rows()==1){
								# UPDATE RECORD IN DATABASE
								$sql = 'update portfolio set 
									portfolio_user_id='.$this->db->escape($field['portfolio_user_id']).',
									portfolio_company_name='.$this->db->escape($field['portfolio_company_name']).',
									portfolio_website='.$this->db->escape($field['portfolio_website']).',
									portfolio_city='.$this->db->escape($field['portfolio_city']).',
									comp_info_state='.$this->db->escape($field['portfolio_state']).',
									comp_info_country='.$this->db->escape($field['portfolio_country']).',
									portfolio_sector='.$this->db->escape($field['portfolio_sector']).', 
									comp_info_company_tags='.$this->db->escape($field['portfolio_company_tags']).' 	
									where portfolio_id='.$field['portfolio_id'];
							}else{
								$sql = 'Insert into portfolio(portfolio_id,portfolio_user_id,portfolio_company_name, portfolio_website, portfolio_city, comp_info_state, 	comp_info_country, portfolio_sector, comp_info_company_tags) values('.$field['portfolio_id'].','.$field['portfolio_user_id'].','.$this->db->escape($field['portfolio_company_name']).','.$this->db->escape($field['portfolio_website']).','.$this->db->escape($field['portfolio_city']).','.$this->db->escape($field['portfolio_state']).','.$this->db->escape($field['portfolio_country']).','.$this->db->escape($field['portfolio_sector']).','.$this->db->escape($field['portfolio_company_tags']).')'; 
							}
						}else{
							$sql = 'Insert into portfolio(portfolio_user_id,portfolio_company_name, portfolio_website, portfolio_city, comp_info_state, comp_info_country, portfolio_sector, comp_info_company_tags) values('.$field['portfolio_user_id'].','.$this->db->escape($field['portfolio_company_name']).','.$this->db->escape($field['portfolio_website']).','.$this->db->escape($field['portfolio_city']).','.$this->db->escape($field['portfolio_state']).','.$this->db->escape($field['portfolio_country']).','.$this->db->escape($field['portfolio_sector']).','.$this->db->escape($field['portfolio_company_tags']).')'; 
						}
							$this->db->query($sql);
					 }		
					 $data['msg'] = array('upload_data' => 'File imported successfully.');
					 unlink($config['upload_path'].$config['file_name']);
				}
			}
			$select_sql = 'select * from portfolio';
			$result = $this->db->query($select_sql);
			$data['csvData'] = $result->result_array();
			$this->load->view('welcome', $data);  
	}
	
	public function exportcsv()
	{	
		//die('here');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
