<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
	* {
		color: #000 !important;
		text-shadow: none !important;
		background: transparent !important;
		-webkit-box-shadow: none !important;
            box-shadow: none !important;
	}
	
	#header { text-align: center; margin:0; padding:0; border-width:0;}
	#footer { }

	body {font-family: Arial, sans-serif;font-size:12px;margin: 10px 10px 130px 10px;}
	.center{ text-align:center; }

	.mt10{margin-top:10px;margin-bottom:0;margin-left:0;margin-right:0;} 
	.mt20{margin-top:20px;margin-bottom:0;margin-left:0;margin-right:0;} 
	.no-margin{margin-top:0;margin-bottom:0;margin-left:0;margin-right:0; }

	table.tbl th, table.tbl td{
		text-align:left;
		vertical-align:top;
		padding:5px;
		font-size:12px;
		border:0;
	}

	table.static th, table.static td{
		text-align:left;
		vertical-align:top;
		padding:0;
		margin:0;
		font-size:12px;
		border:0;
	}

	table.grid{
		border:0;
		border-top: 1px solid #e5e5e5;
		border-left: 1px solid #e5e5e5;
	}

	table.grid th{
		text-align:left;
		vertical-align:top;
		border:0;
		border-bottom: 1px solid #e5e5e5;
		border-right: 1px solid #e5e5e5;
		padding:5px;
		font-size:12px;
	}

	table.grid td{
		text-align:left;
		vertical-align:top;
		border:0;
		border-bottom: 1px solid #e5e5e5;
		border-right: 1px solid #e5e5e5;
		padding:5px;
		font-size:12px;
	}

	div.qct{text-align:center;font-size:9px;line-height:12px;}
	div.qci{color:#dddddd;font-size:9px;text-align:center;}
	div.qci a{color:#dddddd;font-size:9px;text-align:center;}
	.qttitle{margin-top:0;text-align:center;padding:0 0 5px 60px;}
	.qtbox{text-align:left;margin:0 0 0 60px;padding:5px;border:1px solid #e5e5e5;}
	</style>
</head>
<body>

<div id="header">
	
	<div id="rpt-title">JOB SHEET</div>
	
    <table class="grid" cellspacing="0" cellpadding="0" width="100%">
	<thead>
		<tr>
			<th width="13%">Job Ref #</th>
			<td width="20%"><?php echo $job_info->reference_number;?></td>
			<th width="13%">Date Created</th>
			<td width="21%"><?php echo local_time($job_info->created_on,'d/m/Y');?></td>
			<th width="13%">Created By</th>
			<td width="20%"><?php echo $job_info->created_by_name;?></td>
	</tr>
	</thead>
	</table>
</div>

<div id="content">
	<?php $this->load->view("web/{$default_theme}/pages/{$page}"); ?>
</div>

<div id="footer">
    
</div>
<script>
window.print();
</script>
</body>
</html>