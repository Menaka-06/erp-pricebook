<?php
class Pricebook extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->common_model->check_login();
		$this->load->model("pricebook_model");
	}

	public function listPriceBook(){
		$data['page_name']='List Price Book';
		$data['sub_page']='pricebook/listPricebook';
		$config['base_url'] = base_url()."pricebook/listPriceBook"; 
		$config['total_rows'] = $this->common_model->getTotalRecords('tbl_pricebook','');
		$config['per_page'] = PAGINATION_COUNT; 
		$config=$this->common_model->paginationStyle($config);
		$this->pagination->initialize($config); 
		$lmt=0;
		$lmt=$this->uri->segment(3);
		$lmt=mysqli_real_escape_string($this->db->conn_id,$lmt);
		$data['price_book'] = $this->pricebook_model->GetPriceBookList($config['per_page'],$lmt);
		$this->load->view('user_index',$data);
	}
	public function viewPricebookList($id){
		$id=$this->common_model->decode($id);
        $data['page_name']='List Price Book';
		$data['sub_page']='pricebook/viewPricebookList';
		$config['base_url'] = base_url()."pricebook/viewPricebookList"; 
		$config['total_rows'] = $this->common_model->getTotalRecords('tbl_pricebook_list','');
		$config['per_page'] = PAGINATION_COUNT; 
		$config=$this->common_model->paginationStyle($config);
		$this->pagination->initialize($config); 
		$lmt=0;
		$lmt=$this->uri->segment(3);
		//$lmt=mysqli_real_escape_string($this->db->conn_id,$lmt);
		$data['lmt']=$lmt;

		$data['price_book_details']=$this->pricebook_model->ViewPriceBookById($id);
		$data['price_booklist'] = $this->pricebook_model->ViewPriceBookListById($id);
		$this->load->view('user_index',$data);
	
	}
}