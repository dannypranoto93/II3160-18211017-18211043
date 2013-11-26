<?php if ( ! defined('BASEPATH')) exit('No Direct Access Allowed !');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','file'));
	}

	function index()
	{
		$this->data['page'] = 'home';
		$this->data['string'] = '';
		$this->data['info'] = '';
		$this->load->view('tab_menu',$this->data);
	}
	
	function home(){
		$this->data['page'] = 'home';
		$this->data['string'] = '';
		$this->load->view('tab_menu',$this->data);
	}
	
	function sqldb(){
		$stringsql = read_file('./database_collection/sqldb.sql');
		$this->data['string'] = $stringsql;
		$this->data['page'] = 'sqldb';
		$this->load->view('tab_menu',$this->data);
	}
	
	function csvdb(){
		$stringcsv = read_file('./database_collection/csvdb.csv');
		$this->data['string'] = $stringcsv;
		$this->data['page'] = 'csvdb';
		$this->load->view('tab_menu',$this->data);
	}
	
	function xmldb(){
		$stringxml = read_file('./database_collection/xmldb.xml');
		$this->data['string'] = $stringxml;
		$this->data['info'] = '';
		$this->data['page'] = 'xmldb';
		$this->load->view('tab_menu',$this->data);
	}
	
	function htmldb(){
		$stringhtml = read_file('./database_collection/xmldb.xml');
		$this->data['string'] = $stringhtml;
		$this->data['info'] = '';
		$this->data['page'] = 'htmldb';
		$this->load->view('tab_menu',$this->data);
	}
}
?>