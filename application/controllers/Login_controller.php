<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
	}

	public function index()
	{

		if ($this->input->post('submit')) 
		{
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[30]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('error',validation_errors());
				redirect(base_url());
			}
			else
			{
				$email = $this->input->post('email',TRUE);
				$password = $this->input->post('password',TRUE);
				$password = md5($password);

				$query = $this->db->select('id_100,full_name_100,password_100')->from('user_100')->where('email_id_100',$email)->get();
				$get_rows = $query->num_rows();
				if ($get_rows > 0) 
				{
					$get_data = $query->result_array();
					if ($password == $get_data[0]['password_100']) 
					{
						$login_data = array(
							'id' => $get_data[0]['id_100'],
							'fullname' => $get_data[0]['full_name_100']
						);
						$this->session->set_userdata('login_user',$login_data);
						redirect('Home_controller/dashboard');
					}
					else
					{
						$this->session->set_flashdata('error','Please enter a Correct Password');
						redirect(base_url());
					}
				}
				else
				{
					$this->session->set_flashdata('error','Please enter a Correct Email-Id');
					redirect(base_url());
				}
			}

		}

		$this->load->view('login');
	}


	public function registration()
	{
		$this->load->view('registration');
	}

	public function registration_verify()
	{
		if ($this->input->post('submit')) 
		{
			$this->form_validation->set_rules('fname', 'First Name', 'required|trim|alpha|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|trim|alpha|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user_100.email_id_100]|valid_email');
			$this->form_validation->set_rules('phone', 'Phone No', 'required|numeric|trim|is_unique[user_100.phone_no_100]');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[30]');
			$this->form_validation->set_rules('re_password', 'Confirm Password', 'required|trim|matches[password]');
			$this->form_validation->set_rules('agree', 'Agree to terms and conditions', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('registration');
			}
			else
			{
				$insert_data = array(
					'first_name_100' => $this->input->post('fname',TRUE),
					'last_name_100' => $this->input->post('lname',TRUE),
					'full_name_100' => $this->input->post('fname',TRUE).' '.$this->input->post('lname',TRUE),
					'email_id_100' => $this->input->post('email',TRUE),
					'phone_no_100' => $this->input->post('phone',TRUE),
					'password_100' => md5($this->input->post('password',TRUE)),
					'active_yn_100' => '1'
				);

				$insert_data = $this->security->xss_clean($insert_data);
				$this->db->insert('user_100',$insert_data);
				$t100_id = $this->db->insert_id();
				$this->session->set_flashdata('success','Your Registration Successfully Done. You can Login with your Email-Id & Password.');
				redirect(base_url());
			}

		}
	}


public function logout()
{
	$this->session->unset_userdata('login_user');
	session_destroy();
	redirect(base_url());
}










}
