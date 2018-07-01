<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('crud_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function readAll(){
		$limit = 2;
		$page = $this->input->post('current_page');
		$total_recode =count($this->crud_model->get_student_total());
		$total_pages = ceil($total_recode / $limit);
		if (($page != 0) || $page != '') {
            $page = $page;
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $limit;

        $data['student_list'] = $this->crud_model->get_student($limit, $start_from);
        $data['total_pages'] = $total_pages;
        echo json_encode($data);

	}
}
