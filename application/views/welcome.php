<?php
include 'designconstants.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo SITE_HEADER_TITLE; ?></title>
	<link rel="stylesheet" href="<?php echo CSS_FOLDER .'style.css'; ?>" type="text/css" media="screen"/>
	<script src="<?php echo JS_FOLDER; ?>jquery-2.0.3.min.js" type="text/javascript"></script>
	<script src="<?php echo JS_FOLDER; ?>common.js" type="text/javascript"></script>

</head>
<body>

<div id="container">
	<h1>Welcome to csv importer</h1>
	<div>
		
		<?php
		
			if(isset($msg['upload_data'])){
			echo '<div class="important">'.$msg['upload_data'].'</div>';
			}
			if(isset($error['error'])){
			echo '<div class="important">'.$error['error'].'</div>';
			}	
			$time = time();			
			$this->session->set_userdata('time', $time);

		?>
		
		<form name='csvform' action="" method="post" enctype="multipart/form-data">
		<table cellpadding="10" cellspacing="0" width="98%" border="0" align='center'>
		<tr>
			<td>CSV File</td>
			<td width="300">
			<input type='file' name='csvfile' id='csvfile'>
			<input type='hidden' name='txttime' id='txttime' value='<?php echo $time;?>'>
			</td>
			<td align='left'><input type='submit' name='sub' id='sub' value="Upload"></td>
			<td align='left'><a href="<?php echo SITE_URL; ?>test.csv" rel='nofollow'><input type='button' name='exp' id='exp' value="Export" ></a></td>
		</tr>
		</table>
		</form>
	</div>
	<div id="body">
		<table cellpadding="10" cellspacing="0" width="100%" border="1">
			<tr>
					<td width = "5%">P. ID</td>
					<td width = "15%">Company Name</td>
					<td width = "5%">Website</td>
					<td width = "10%">City</td>
					<td width = "5%">State</td>
					<td width = "10%">Country</td>
					<td width = "20%">Sector</td>
					<td width = "20%">Company Tags</td>
			</tr>

		<?php 
		if(count($csvData)>0){
		foreach($csvData as $field){?>
			<tr>
				<td><?php echo $field['portfolio_id']?></td>
				<td><?php echo $field['portfolio_company_name']?></td>
				<td><?php echo $field['portfolio_website']?></td>
				<td><?php echo $field['portfolio_city']?></td>
				<td><?php echo $field['comp_info_state']?></td>
				<td><?php echo $field['comp_info_country']?></td>
				<td><?php echo $field['portfolio_sector']; ?></td>
				<td><?php echo $field['comp_info_company_tags']; ?></td>
			</tr>
		<?php }
		}else{
		?>
			<tr>
				<td colspan="8">No records found.</td>
			</tr>		
		<?php
		}
		?>
		</table>
	</div>
</div>

</body>
</html>