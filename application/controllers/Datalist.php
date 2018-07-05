<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datalist extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('crud_model');
	}

	public function index()
	{
		$this->load->view('datatable_view',array());
	}

	public function student_page(){

		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$student = $this->crud_model->get_students();

		$data = array();

		foreach($student->result() as $r) {

			$data[] = array(
				$r->student_firstname,
				$r->student_lastname,
				$r->student_email,
				$r->student_mobile . "/10 Stars",
				$r->student_created
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $student->num_rows(),
			"recordsFiltered" => $student->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();

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

	//https://www.webslesson.info/2016/10/codeigniter-tutorial-upload-image-file-using-jquery-ajax.html
}
