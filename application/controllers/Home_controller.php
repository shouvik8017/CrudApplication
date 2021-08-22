<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
	}

	public function dashboard()
	{

		$login_id = 0;
		if (!$this->session->userdata('login_user')) 
		{
			redirect(base_url());
		}
		else
		{
			$login_user = $this->session->userdata('login_user');
			$login_id = $login_user['id'];
		}

		$datas = [];
		
		$per_page = 3;
		$this->db->select('*');
		$this->db->from('products_200');
		if ($this->input->post('search')) 
		{
			$name = $this->input->post('name',TRUE);
			if(!empty($name)){ $this->db->like('name_200',$name); }
		}
		$this->db->where('add_by_user_id_100_200',$login_id);
		$query = $this->db->get();

		if ($this->input->post('search')) 
		{
			$per_page = $query->num_rows();
		}

		$this->load->library('pagination');
		$config=[
			'base_url' => base_url('Home_controller/dashboard'),
			'per_page' => $per_page,
			'total_rows' => $query->num_rows(),
			'full_tag_open'=>"<nav aria-label='Page navigation example'><ul class='pagination'>",
			'full_tag_close'=>"</ul></nav>",
			'next_tag_open' =>"<li class='page-item'>",
			'next_tag_close' =>"</li>",
			'prev_tag_open' =>"<li class='page-item'>",
			'prev_tag_close' =>"</li>",
			'num_tag_open' =>"<li class='page-item'>",
			'num_tag_close' =>"</li>",
			'cur_tag_open' =>"<li class='page-item active'><a class='page-link'>",
			'cur_tag_close' =>"</a></li>"

		];
		$this->pagination->initialize($config);


		$this->db->select('*');
		$this->db->from('products_200');
		if ($this->input->post('search')) 
		{
			$name = $this->input->post('name',TRUE);
			if(!empty($name)){ $this->db->like('name_200',$name); }
		}
		$this->db->where('add_by_user_id_100_200',$login_id);
		$this->db->limit($config['per_page'],$this->uri->segment(3));
		$query2 = $this->db->get();
		$datas['products'] = $query2->result_array();

		$this->load->view('dashboard',$datas);
	}

	public function product_save()
	{
		$login_id = 0;
		$ip = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		if (!$this->session->userdata('login_user')) 
		{
			redirect(base_url());
		}
		else
		{
			$login_user = $this->session->userdata('login_user');
			$login_id = $login_user['id'];
		}

		if($this->input->post('save'))
		{

			$insert_data = array(
				'name_200' => $this->input->post('product_name',TRUE),
				'price_200' => $this->input->post('product_price',TRUE),
				'description_200' => $this->input->post('product_description',TRUE),
				'add_by_user_id_100_200' => $login_id,
				'active_yn_200' => '1',
				'ipaddress_200' => $ip,
				'source_200' => 'application',
				'created_at_200' => date("Y-m-d h:i:sa")
			);

			$insert_data = $this->security->xss_clean($insert_data);
			$this->db->insert('products_200',$insert_data);
			$this->session->set_flashdata('success','Product Details Save Successfully');
			redirect('Home_controller/dashboard');

		}

	}



	public function product_update()
	{
		$login_id = 0;
		$ip = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		if (!$this->session->userdata('login_user')) 
		{
			redirect(base_url());
		}
		else
		{
			$login_user = $this->session->userdata('login_user');
			$login_id = $login_user['id'];
		}

		if($this->input->post('update'))
		{
			$t200_id = $this->uri->segment(2);

			$update_data = array(
				'name_200' => $this->input->post('product_name'.$t200_id,TRUE),
				'price_200' => $this->input->post('product_price'.$t200_id,TRUE),
				'description_200' => $this->input->post('product_description'.$t200_id,TRUE),
				'add_by_user_id_100_200' => $login_id,
				'active_yn_200' => '1',
				'ipaddress_200' => $ip,
				'source_200' => 'application',
				'updated_at_200' => date("Y-m-d h:i:sa")
			);

			$update_data = $this->security->xss_clean($update_data);
			$rspn = $this->db->where('id_200',$t200_id)->update('products_200',$update_data);
			if($rspn)
			{
				$this->session->set_flashdata('success','Product Details Updated Successfully');
				redirect('Home_controller/dashboard');
			}
			else
			{
				$this->session->set_flashdata('error','Product Details Can not Updated');
				redirect('Home_controller/dashboard');
			}
			
		}

	}


	public function delete()
	{
		$t200_id = $this->uri->segment(2);
		$resp = $this->db->where('id_200',$t200_id)->delete('products_200');

		if ($resp) 
		{
			$this->session->set_flashdata('success','Product Details Deleted Successfully');
			redirect('dashboard');
		}
		else
		{
			$this->session->set_flashdata('error','Product Details Can not Deleted Successfully');
			redirect('dashboard');
		}

	}













}
