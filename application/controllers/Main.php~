<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation','session'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('users_model','',TRUE);
		
	}
	
	function index($offset = 0)
	{
		//echo '<pre>'; print_r($this->session->all_userdata());exit;
		// offset
		if($this->session->userdata('isUserLoggedIn')){
		if($this->session->userdata('user_role')==1){
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$persons = $this->users_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('main/index/');
 		$config['total_rows'] = $this->users_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'address', 'Phone Number', 'City','Actions');
		
		$i = 0 + $offset;
		foreach ($persons as $person)
		{
			$this->table->add_row(++$i, $person->name, $person->address, $person->phone_number,$person->city,
				anchor('main/view/'.$person->user_id,'view',array('class'=>'view')).' '.
				anchor('main/update/'.$person->user_id,'update',array('class'=>'update')).' '.
				anchor('main/delete/'.$person->user_id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this person?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$this->load->view('personList', $data);
	}
else
	{
	redirect('main/update/'.$this->session->userdata('userId'));
	}
	}
else
	{
redirect('main/login');
	}
	}
	
	function add()
	{
		// set empty default form field values
		
		$data['form_data']="";
		// set common properties
		$data['title'] = 'Add new person';
		$data['message'] = '';
		$data['action'] = site_url('main/addPerson');
		$data['link_back'] = anchor('main/index/','Back to list of persons',array('class'=>'back'));
	
		// load view
		$this->load->view('personAdd', $data);
	}
	
	function addPerson()
	{	//echo "<pre>";print_r($_FILES);exit;
		// set common properties
		$data['title'] = 'Add new user';
		$data['action'] = site_url('main/addPerson');
		$data['link_back'] = anchor('main/index/','Back to list of persons',array('class'=>'back'));
		
		// set empty default form field values
		//$this->_set_fields();
		//set validation properties
		$this->_set_rules();
		$person = array('name' => $this->input->post('name'),
							'address' => $this->input->post('address'),
							'phone_number' => $this->input->post('phone_number'),
							'city'=>$this->input->post('city'),
							'username'=>$this->input->post('username'),
							'password'=>$this->input->post('passowrd'));
			$id = $this->users_model->save($person);			

                
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// set user message
			$data['message'] = '<div class="success">add new person success</div>';
		}
		
		// load view
		redirect('/main/index');
	}
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'Person Details';
		$data['link_back'] = anchor('main/index/','Back to list of persons',array('class'=>'back'));
		
		// get person details
		$data['person'] = $this->users_model->get_by_id($id)->row();
		
		// load view
		$this->load->view('personView', $data);
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$person = $this->users_model->get_by_id($id)->row();
		
		
		$data['form_data']=$person;
		//echo "<pre>";print_r($data);exit;
		// set common properties
		$data['title'] = 'Update person';
		$data['message'] = '';
		$data['action'] = site_url('main/updatePerson');
		$data['link_back'] = anchor('main/index/','Back to list of persons',array('class'=>'back'));
	
		// load view
		$this->load->view('personEdit', $data);
	}
	
	function updatePerson()
	{
		
	//echo "<pre>";print_r($_POST);exit;
		// set common properties
		$data['title'] = 'Update person';
		$data['action'] = site_url('main/updatePerson');
		$data['link_back'] = anchor('main/index/','Back to list of persons',array('class'=>'back'));
		
		// set empty default form field values
		//$this->_set_fields();
		// set validation properties
		$id = $this->input->post('id');
		$person = array('name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone_number' => $this->input->post('phone_number'),
				'city' => $this->input->post('city')
		);
		$this->users_model->update($id,$person);
 		redirect('main/index');

		
	}
	
	function delete($id)
	{
		// delete person
		$this->users_model->delete($id);
		
		// redirect to person list page
		redirect('main/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data->user_id = '';
		$this->form_data->name = '';
		$this->form_data->address = '';
		$this->form_data->phone_number = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	// date_validation callback
	function valid_date($str)
	{
		//match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts))
		{
			//check weather the date is valid of not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return false;
		}
		else
			return false;

	}

	public function login(){
        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        if($this->input->post('submit')){
            $this->form_validation->set_rules('username', 'username', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'username'=>$this->input->post('username'),
                    'password' => $this->input->post('password')
                );
                $checkLogin = $this->users_model->getRows($con);
                if($checkLogin){
                    $this->session->set_userdata('isUserLoggedIn',TRUE);
                    $this->session->set_userdata('userId',$checkLogin['user_id']);
		    $this->session->set_userdata('user_role',$checkLogin['is_admin']);
                    redirect('main/index');
                }else{
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            }
        }
        //load the view
        $this->load->view('login_form', $data);
    }

	 public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('main/login/');
    }


}
?>
