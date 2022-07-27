<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _template_output($output = null)
	{
		$this->load->view('admin.php',(array)$output);
	}

	public function index()
	{
		$this->_template_output((object)array('output' => '<h1>Bienvenido</h1>' , 'js_files' => array() , 'css_files' => array()));
	}

	public function user_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('users');
			$crud->set_subject('User');
			$output = $crud->render();

			$this->_template_output($output);
	}

	public function user_activity_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('user_activities');
			$crud->set_subject('Activity');
			$output = $crud->render();

			$this->_template_output($output);
	}


}
