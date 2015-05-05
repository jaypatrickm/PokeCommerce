<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin');
		$this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('admins/admin_login');
	}

	public function admin_login()
	{
		$this->load->view('admins/admin_login');
	}
	public function login_check()
	{
		if ($this->Admin->login_validation() == false)
		{
			$error = validation_errors();
			$this->session->set_flashdata('msg', 'Something is not right, could not log in.');
			$this->session->set_flashdata('errors', $error);
			redirect('/Admin');
		}
		else 
		{
			$result = $this->Admin->get_user_by_email($this->input->post());	
			if($result == false)
			{
				$this->session->set_flashdata('msg', 'Something went wrong, please try logging in again.');
				redirect('/Admin');
			}
			else
			{
				$this->session->set_userdata('id', $result);
				redirect('/Admin');
			}	
		}
	}
	public function admin_orders()
	{
		$this->load->view('admins/admin_orders');
	}

	public function admin_edit_product()
	{
		$this->load->view('admins/admin_edit_product');
	}

	public function admin_registration()
	{
		$this->load->view('admins/admin_registration.php');

	}

	public function register()
	{
		if ($this->Admin->registration_validation() == false)
		{
			$error = validation_errors();

			$this->session->set_flashdata('msg', 'Something went wrong, please try registering again.');
			$this->session->set_flashdata('errors', $error);
			redirect('/Admin_Registration');
		}
		else 
		{
			$result = $this->Admin->register_user($this->input->post());	
			$error = "Successfully Registered!";
			if($result == false)
			{
				$this->session->set_flashdata('msg', 'Something went wrong, please try registering again.');
				redirect('/Admin_Registration');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Registration submitted! Please Login!');
				redirect('/Admin');
			}
				
		}
	}
}

//end of main controller