<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1, h2 { text-align: center; font-family: Calibri; }
		table.mytable {border-collapse: collapse;}
		table.mytable td, th {border: 1px solid grey; padding: 5px 15px 2px 7px;}
		th {background-color: #f2e4d5;}		
	</style>
</head>
<body>

<h1>Queries</h1>
<div align='center'>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query1')?>'">Total Deliveries to each Venue</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query2')?>'">Total Current Employees per Company</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query3')?>'">Total Vehicles per Company</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query4')?>'">Deliveries per Driver</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query5')?>'">Deliveries to Venues on 20/10/2018</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query6')?>'">All deliveries by Suppliers</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query7')?>'">Driver, Vehicle for deliveries to Athletic Center on 20/10/2018 by Food Stuff</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query8')?>'">Entry Log data sorted by Date</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query9')?>'">Entry Log Data sorted by Venue</button>
	
</div>
<h2>Driver, Vehicle for deliveries to Athletic Center on 20/10/2018 by Food Stuff</h2>
<div align='center'>
<?php
	$tmpl = array ('table_open' => '<table class="mytable">');
	$this->table->set_template($tmpl); 
	
	$this->db->query('drop table if exists temp');
	$this->db->query("create temporary table temp as (select d.EntryID,d.Allowed,d.DelDate,r.DriverName,e.VenueStadiumName,v.VehicleReg
	from entrylog d
	JOIN driver r ON (d.DelDriver=r.DriverID)
	JOIN vehicle v ON (d.DelVehicleReg=v.VehicleID)
	JOIN venue e ON (d.DelVenue=e.VenueID)
	where r.DriverID=d.DelDriver AND d.DelVehicleReg=v.VehicleID AND d.DelVenue=e.VenueID AND d.delDate=(DATE '2018/10/20'))");
	$query = $this->db->query('SELECT * from temp;');
	echo $this->table->generate($query);
?>
</div>
</body>
</html>
