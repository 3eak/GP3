<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Main extends CI_Controller {
	 
	 function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('table');
	}
	
	public function index($msg=NULL)
	{	

		$this->load->view('header');
		$this->load->view('home');
	}
	
	public function querynav()
	{	
		$this->load->view('header');
		$this->load->view('querynav_view');
	}
		
	public function query1()
	{	
		$this->load->view('header');
		$this->load->view('query1_view');
	}
	
	public function query2()
	{	
		$this->load->view('header');
		$this->load->view('query2_view');
	}
	
	public function query3()
	{	
		$this->load->view('header');
		$this->load->view('query3_view');
	}
	public function query4()
	{	
		$this->load->view('header');
		$this->load->view('query4_view');
	}
	
	public function query5()
	{	
		$this->load->view('header');
		$this->load->view('query5_view');
	}
	
	public function query6()
	{	
		$this->load->view('header');
		$this->load->view('query6_view');
	}
	
	public function query7()
	{	
		$this->load->view('header');
		$this->load->view('query7_view');
	}
	public function query8()
	{	
		$this->load->view('header');
		$this->load->view('query8_view');
	}
	public function query9()
	{	
		$this->load->view('header');
		$this->load->view('query9_view');
	}
	
	
	public function blank()
	{	
		$this->load->view('header');
		$this->load->view('blank_view');
	}
	
	
	
	
	public function Vehicle()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('vehicle');
		$crud->set_primary_key('VehicleID');
		$crud->set_subject('Vehicle');
		$crud->columns('VehicleID','VehicleReg', 'VehicleBrand', 'VehicleModel', 'VehicleSupplier');
		$crud->fields('VehicleReg', 'VehicleBrand', 'VehicleModel', 'VehicleSupplier');
		$crud->required_fields('VehicleReg', 'VehicleBrand', 'VehicleModel', 'VehicleSupplier');
		//$crud->set_relation('Vehicle Registration','vehicle','Vehicle Registration');
		//$crud->display_as('', 'Vehicle Registration','Vehicle Brand', 'Vehicle Model', 'Vehicle Supplier ID');
		//$crud->set_primary_key('VehicleReg');
		$crud->set_relation('VehicleSupplier','supplier','SupplierName');
		
		$crud->display_as('VehicleReg', 'Reg');
		$crud->display_as('VehicleBrand', 'Brand');
		$crud->display_as('VehicleModel', 'Model');
		$crud->display_as('VehicleSupplier', 'Vehicle Supplier');
		//$crud->display_as('custPostcode', 'Postcode')
		
		$crud->callback_before_delete(array($this, 'expireV'));
		
		$output = $crud->render();
		$this->Vehicle_output($output);
	}
	
	function expireV($primary_key) {
		
		$can=array('Status'=>'Cancelled');
		$this->db->where('DeliveryVehicleReg',$primary_key);
		$this->db->update('delivery',$can);
		
	}
	
	
	
	function Vehicle_output($output = null)
	{
		$this->load->view('vehicle_view.php', $output);
	}
	
	public function venue()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('venue');
		$crud->set_primary_key('VenueID');
		$crud->set_subject('Venue');
		$crud->columns('VenueID','VenueStadiumName', 'VenueArea', 'VenueContactNo', 'VenueAddress');
		$crud->display_as('VenueStadiumName', 'Venue Stadium Name');
		$crud->display_as('VenueArea', 'Venue Area');
		$crud->display_as('VenueContactNo', 'Venue Contact Number');
		$crud->display_as('VenueAddress', 'Venue Address');
		//$crud->set_primary_key('VenueStadiumName');
		$crud->fields('VenueStadiumName', 'VenueArea', 'VenueContactNo', 'VenueAddress');
		$crud->required_fields('VenueStadiumName', 'VenueArea', 'VenueAddress');

		
		$output = $crud->render();
		$this->Venue_output($output);
	}

	function Venue_output($output = null)
	{
		$this->load->view('venue_view.php', $output);
	}
	
	public function delivery()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('delivery');
		$crud->set_primary_key('DeliveryID');
		$crud->set_subject('Delivery');
		$crud->columns('DeliveryID', 'Status', 'DeliveryDate', 'DeliveryVehicleReg', 'DeliveryVenue', 'DeliverySupplier','DeliveryDriverName');
		$crud->set_relation('DeliveryVehicleReg','vehicle','VehicleReg');
		$crud->set_relation('DeliveryVenue','venue','VenueStadiumName');
		$crud->set_relation('DeliverySupplier','supplier','SupplierName');
		//$crud->set_relation_n_n('DeliveryDriver','driveridcard','driver','CardID','CardID','DriverName');
		$crud->set_relation('DeliveryDriver','driveridcard','Driver');
		$crud->set_relation('DeliveryDriverName','driver','DriverName');
		$crud->display_as('DeliveryVenue', 'Delivery Venue');
		$crud->display_as('DeliverySupplier', 'Delivery Supplier');
		$crud->display_as('DeliveryDriver', 'Delivery Driver Card ID');
		$crud->display_as('DeliveryVehicleReg', 'Delivery Vehicle Registration');
		$crud->display_as('DeliveryID', 'Delivery ID');
		//$crud->display_as('DeliveryDriver)
		$crud->display_as('DeliveryDate', 'Delivery Date');
		$crud->display_as('DeliveryDriverName', 'Delivery Driver Name');

		$crud->fields('DeliveryDate', 'DeliveryVehicleReg','DeliveryVenue', 'DeliveryDriver');
		$crud->required_fields('DeliveryDate', 'DeliveryVehicleReg', 'DeliveryVenue','DeliveryDriver');
		
		$crud->callback_after_insert(array($this,'adddrivername'));
		
		$this->db->query("UPDATE delivery d
		JOIN driveridcard i 
		ON (d.DeliveryDriver=i.CardID)
		SET d.Status='Cancelled'
		WHERE i.State='Expired'"
		);
		
		$this->db->query("UPDATE delivery d
		JOIN driver e
		ON (d.DeliveryDriver=e.DriverID)
		SET d.DeliveryDriverName=e.DriverID
		WHERE d.DeliveryDriver=e.DriverID");
		
		$this->db->query("UPDATE delivery d
		JOIN driver r ON (d.DeliveryDriver=r.DriverID)
		SET d.DeliverySupplier=r.DriverEmployer
		WHERE d.DeliveryDriver=r.DriverID");
		
		//,d.DeliverySupplier=i.SupplierID
		
	/*	$this->db->query("UPDATE delivery d
		JOIN supplier i 
		ON (d.DeliverySupplier=i.SupplierID)
		SET d.DeliverySupplier=i.SupplierID*/
		
		/*$this->db->query("UPDATE delivery d
		JOIN supplier r
		ON (d.DeliveryDriver=r.DriverID)
		JOIN driver i ON (i.DriverEmployer=r.SupplierID)
		SET d.DeliverySupplier=r.SupplierID
		WHERE d.DeliveryDriver=r.DriverID");*/
		
		
		$output = $crud->render();
		$this->Delivery_output($output);
	}
	
	function adddrivername($post_array,$primary_key) {
		
		/*$test = array(
		//"CardID"=>$primary_key,
		"DeliveryVenue"=>$post_array['DeliveryVenue'],
		"DeliveryDate"=>$post_array['DeliveryDate'],
		"DeliveryVehicleReg"=>$post_array['DeliveryVehicleReg'],
		"DeliveryDriver"=>$post_array['DeliveryDriver'],
		"DeliveryDriverName"=>$post_array['DeliveryDriver']
		);
		$this->db->where($primary_key,$primary_key);
		$this->db->('delivery',$test);*/
		
		
		
		/*
		$this->db->query("UPDATE delivery d
		JOIN driver e
		ON (d.DeliveryDriver=e.DriverID)
		JOIN supplier i 
		ON (d.DeliverySupplier=i.SupplierID)
		SET d.DeliveryDriverName=e.DriverID,d.DeliverySupplier=i.SupplierID
		WHERE d.DeliveryDriver=e.DriverID");
		*/
	}
	

	function Delivery_output($output = null)
	{
		$this->load->view('delivery_view.php', $output);
	}
	
	public function driver()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('driver');
		$crud->set_primary_key('DriverID');
		$crud->set_subject('Driver');
		$crud->columns('DriverID','DriverName','DriverEmployer', 'DriverTitle');
		$crud->set_relation('DriverEmployer','supplier','SupplierName');
		$crud->display_as('DriverName', 'Driver Name');
		$crud->display_as('DriverTitle', 'Driver Title');

		$crud->fields('DriverEmployer', 'DriverName', 'DriverTitle');//,'StartDate','EndDate');
		$crud->required_fields('DriverEmployer', 'DriverName');//,'StartDate','EndDate');
		
		$crud->callback_after_insert(array($this, 'add_driveridcard'));
		$crud->callback_before_delete(array($this, 'expire'));
		
		$output = $crud->render();
		$this->Driver_output($output);
	}
	
	function expire($primary_key) {
		$this->db->where('DriverName',$primary_key);
		$u=$this->db->get('driver')->row();
		
		$exp=array('State'=>'Expired');
		$can=array('Status'=>'Cancelled');
		$this->db->where('Driver',$primary_key);
		$this->db->update('driveridcard',$exp);
		$this->db->where('DeliveryDriver',$primary_key);
		$this->db->update('delivery',$can);
		
	}
	

	
	
	function add_driveridcard($post_array,$primary_key) {
		$driveridcard_insert = array(
		//"CardID"=>$primary_key,
		"Driver"=>$primary_key,
		"CardEmp"=>$post_array['DriverEmployer'],
		"StartDate"=>date('Y-m-d H:i:s'),
		"EndDate"=>date('Y-m-d', strtotime( '+'.(1).' years'))
		);
		$this->db->insert('driveridcard',$driveridcard_insert);
		return true;
	}
	
	function Driver_output($output = null)
	{
		
		$this->load->view('driver_view.php', $output);
	}
	
	public function driveridcard()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('driveridcard');
		$crud->set_primary_key('CardID');
		$crud->set_subject('Driver ID Card');
		$crud->columns('CardID', 'Driver', 'StartDate', 'EndDate', 'State');
		//$crud->set_relation('Driver','driver','DriverName');
		$crud->fields('EndDate');
		$crud->required_fields('EndDate');
		$crud->display_as('CardID', 'Card ID');
		$crud->display_as('Driver', 'Driver ID');
		$crud->display_as('StartDate', 'Start Date');
		$crud->display_as('EndDate', 'End Date');
		$crud->display_as('State', 'Card State');
		
				
		$crud->callback_after_update(array($this,'delifexp'));

		$this->db->query("UPDATE driveridcard i
		JOIN driver d ON (i.Driver=d.DriverID)
		SET CardEmp=d.DriverEmployer
		WHERE i.Driver=d.DriverID"
		);
		
		
		$this->db->query("UPDATE driveridcard
		SET State='Expired'
		WHERE CURDATE() > EndDate AND State='Valid'"
		);
		
		/*$this->db->query("UPDATE delivery,driveridcard
		SET Status='Cancelled'
		WHERE State='Expired'"
		);*/
		$output = $crud->render();
		$this->Driveridcard_output($output);
	}
	
	function delifexp($post_array,$primary_key) {
		//$expir
		
		//$cancelexp = array (
		//"Status" => 'Cancelled');
		$can=array('Status'=>'Cancelled');
		$this->db->where('DeliveryDriver',$primary_key);
		$this->db->where($post_array['State'],'Expired');
		$this->db->update('delivery',$can);
		
		
		
		/*$can=array('Status'=>'Cancelled');
		$this->db->where('DeliveryDriver',$post_array['Driver']);
		$this->db->update('delivery',$can);
		
	/**	$this->where($post_array['State']='Expired');
		$this->delete('delivery',array('DeliveryDriver'=>$post_array['Driver']));
		//$this->db->delete('delivery',array('DriverEmployer'=>$primary_key));*/
		
	}
	
	function Driveridcard_output($output = null)
	{
		$this->load->view('driveridcard_view.php', $output);
	}
	
	public function supplier()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('supplier');
		$crud->set_primary_key('SupplierID');
		$crud->set_subject('Supplier');
		$crud->columns('SupplierID','SupplierName', 'SupplierGaS', 'SupplierAddress', 'SupplierManager');
		$crud->display_as('Supplier ID');
		$crud->display_as('SupplierName','Supplier Name');
		$crud->display_as('SupplierGaS', 'Supplier Goods and Services');
		$crud->display_as('SupplierAddress', 'Supplier Address');
		$crud->display_as('SupplierManager', 'Supplier Manager');

		$crud->fields('SupplierName', 'SupplierGaS', 'SupplierAddress', 'SupplierManager');
		$crud->required_fields('SupplierName', 'SupplierGaS', 'SupplierAddress', 'SupplierManager');

		$crud->callback_before_delete(array($this, 'cancel_del'));
		
		
		$output = $crud->render();
		$this->Supplier_output($output);
	}

		function cancel_del($primary_key) {
		
		//$can=array('Status'=>'Cancelled');
		//$this->db->where('SupplierName',$primary_key);
		/*$que=$this->db->get('driver');
		foreach ($que->result() as $row)
		{
			if $row->
		}*/
		
	//	$exp=array('State'=>'Expired');
		
		//$this->db->select('driver');
		
		
		
		//$this->db->where('DriverEmployer',$primary_key);
		//$q=$this->db->get();
		//$u=$this->db->get_where('driver',array('DriverEmployer'=>$primary_key));
		//$this->db->where('Driver',$u);
		//$this->db->where('driveridcard',array('Driver'=>));
		//$this->db->update('driveridcard',$exp);
		/*$exp=array('State'=>'Expired');
		$this->db->join('driver','driveridcard','driver.DriverID=driveridcard.Driver','left');
		$this->db->where('driver.DriverEmployer',$primary_key);
		$this->db->update('driveridcard',$exp);*/
		
		
		
		//$this->db->select('DriverEmployer');
		//$q=$this->db->get('driver');
	//	$this->db->where($q,$primary_key);
		//$c=array($q=>$primary_key);
		//$exp=array('State'=>'Expired');
		
		$cann=array('State'=>'Cancelled');
		/*$this->db->where('DriverEmployer',$primary_key);
		$this->db->update('driveridcard',$exp);*/
		//$this->db->update('driveridcard',$exp,$c);
		//$this->db->delete('driver',array('DriverEmployer'=>$primary_key));
		//$this->db->delete('vehicle',array('VehicleSupplier'=>$primary_key));
		//$ua=$this->db->get('supplier')->row();
		
	//	$exp=array('State'=>'Expired');
		$can=array('Status'=>'Cancelled');
		$this->db->where('DeliverySupplier',$primary_key);
		$this->db->where('Status !=','Delivered');
		$this->db->update('delivery',$can);
		//$this->db->update(')
		
		
		
	/*	$this->db->query("UPDATE driveridcard i
		JOIN delivery d ON (i.Driver=d.DeliveryDriver)
		SET i.State='Expired'
		WHERE d.Status='Cancelled'");
		*/
	/*	$this->db->query("UPDATE driveridcard i
		JOIN driver d ON (i.Driver=d.DeliveryDriver)
		JOIN supplier s ON (d.DriverEmployer=s.SupplierID)
		SET i.State='Expired'
		WHERE d.Status='Cancelled'");*/
		
		
		
		$this->db->where('CardEmp',$primary_key);
		$this->db->where('State','Valid');
		$this->db->update('driveridcard',$cann);
		
		
	}
	
	
	
	function Supplier_output($output = null)
	{
		$this->load->view('supplier_view.php', $output);
	}
	
	
	public function entrylog()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('entrylog');
		$crud->set_primary_key('EntryID');
		$crud->set_subject('Entry Log');
		$crud->columns('EntryID','Allowed','DelDate','DelVehicleReg', 'DelVenue', 'DelDriver');
		$crud->display_as('EntryID', 'Entry ID');
		$crud->display_as('DelVenue', 'Delivery Venue');
		$crud->display_as('DelDate', 'Delivery Date');
		$crud->display_as('DelVehicleReg', 'Delivery Vehicle Registration');
		$crud->display_as('DelDriver', 'Delivery Driver');
		$crud->display_as('Allowed', 'Allowed Access');
		$crud->set_relation('DelVehicleReg','vehicle','VehicleReg');
		$crud->set_relation('DelVenue','venue','VenueStadiumName');
		$crud->set_relation('DelDriver','driver','DriverName');
		//$crud->set_relation('DelDriverID','driveridcard','Driver');
		//$crud->set_primary_key('VenueStadiumName');
		$crud->fields('DelVenue', 'DelDate', 'DelVehicleReg', 'DelDriver');
		$crud->required_fields('DelVenue', 'DelDate', 'DelVehicleReg', 'DelDriver');

		//$crud->callback_after_insert($this,'checkentry');
		
		$this->db->query("UPDATE entrylog e
		JOIN delivery d ON (d.DeliveryDate=e.DelDate)
		SET e.Allowed='Authorised', d.Status='Delivered'
		WHERE e.DelVenue=d.DeliveryVenue 
		AND e.DelDate=d.DeliveryDate
		AND e.DelDriver=d.DeliveryDriver
		AND e.DelVehicleReg=d.DeliveryVehicleReg
		AND d.Status!='Cancelled'
		AND d.Status!='Delivered'"
		);
		
		$output = $crud->render();
		$this->Entrylog_output($output);
		
		
		
	}

	function checkentry($post_array,$primary_key) {
		$al=array('Allowed'=>'Authorised');
		$crud->db->get('delivery');
		$crud->db->where($post_array['DelVenue'],'DeliveryVenue');
		$crud->db->where($post_array['DelDate'],'DeliveryDate');
		$crud->db->where($post_array['DelVehicleReg'],'DeliveryVehicleReg');
		$crud->db->where($post_array['DelDriver'],'DeliveryDriver');
		$crud->db->update('entrylog',$al);
		//$crud->db->where($post_array['DelDate'],'DeliveryDate');
		
		
		
		
		
		
		
		
		
		
		
	}
	
	function Entrylog_output($output = null)
	{
		$this->load->view('entrylog_view.php', $output);
	}
	
}
