<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>SIMPLE CRUD APPLICATION</title>

<link href="<?php echo base_url(); ?>res/css/style.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>res/css/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>res/js/calendar.js"></script>

</head>
<body>
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('id'); ?>"/></td>
				<input type="hidden" name="id" value=""/>
			</tr>
			<tr>
				<td valign="top">Username<span style="color:red;">*</span></td>
				<td><input type="text" name="username" class="text" value=""/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
<tr>
				<td valign="top">Password<span style="color:red;">*</span></td>
				<td><input type="passowrd" name="passowrd" class="text" value=""/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Name<span style="color:red;">*</span></td>
				<td><input type="text" name="name" class="text" value=""/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
				<td valign="top">Address<span style="color:red;">*</span></td>
				<td><input type="text" name="address" class="text" value=""/>
<?php echo form_error('address'); ?>
			<tr>				
			</td>
			<tr>
				<td valign="top">Phone Number<span style="color:red;">*</span></td>	
				<td><input type="text" name="phone_number" class="text" value=""/>
<?php echo form_error('name'); ?>
			</tr>
			<tr>
				<td valign="top">City<span style="color:red;">*</span></td>
				<td><input type="text" name="city" class="text" value=""/>
<?php echo form_error('address'); ?>
			</tr>	
<tr>
				<td valign="top">Image<span style="color:red;">*</span></td>
				<td><input type="file" name="user_image" class="text" value=""/>
<?php echo form_error('address'); ?>
			</tr>	
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>
