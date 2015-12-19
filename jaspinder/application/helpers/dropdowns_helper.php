<?php defined('BASEPATH') OR exit('No direct script access allowed');

function companies_dropdown($method , $params = array()){
	$ci = & get_instance();
	$ci->load->model('company_model', 'company_m');
	
	$params = array_merge( array('first_row' => FALSE, 'default_text' => '', 'no_company' => FALSE), $params);
	
	$result = $ci->company_m->get_companies_list();
	
	if( $method == 'ajax' ){
	
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
			$list[] = array( "value" => $row->id, "text" => $row->name);
		}
		
		if($params['no_company']){
			$list[] = array( "value" => 'NO_COMPANY', "text" => 'No Company');
		}
		
		header('Content-Type: application/json');
        echo json_encode($list);
		die;
	}
	
	$list = array();
	if( $params['first_row'] ) {
		$list[""] = $params['default_text'];
	}
	
	foreach ($result as $row) {
		$list[$row->id] = $row->name;
	}
	
	if($params['no_company']){
		$list['NO_COMPANY'] = 'No Company';
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function groups_dropdown($method , $params = array()){
	$ci = & get_instance();
	
	$params = array_merge( array('first_row' => FALSE, 'default_text' => '', 'no_company' => FALSE), $params);
	
	$result = $ci->ion_auth->groups()->result();
	
	if( $method == 'ajax' ){
	
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
			if( _has_company_group_access($ci->current_user->group_id) && $row->id == GROUP_ADMIN) continue;
				
			if( in_array($ci->current_user->group_id, array(GROUP_USER_COMPANY, GROUP_CLIENT_USER)) && $row->id == GROUP_MANAGEMENT_COMPANY) continue;
			
			$list[] = array( "value" => $row->id, "text" => $row->description);
		}
		
		header('Content-Type: application/json');
        echo json_encode($list);
		die;
	}
	
	$list = array();
	if( $params['first_row'] ) {
		$list[""] = $params['default_text'];
	}
	
	foreach ($result as $row) {
		if( _has_company_group_access($ci->current_user->group_id) && $row->id == GROUP_ADMIN) continue;
				
			if( in_array($ci->current_user->group_id, array(GROUP_USER_COMPANY, GROUP_CLIENT_USER)) && $row->id == GROUP_MANAGEMENT_COMPANY) continue;
				
		$list[$row->id] = $row->description;
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function clients_dropdown($method , $params = array()){
	
	$ci = & get_instance();
	$ci->load->model('client_model' , 'client_m');
	
	$params = array_merge( array('first_row' => FALSE, 'default_text' => '', 'no_company' => FALSE, 'company_id' => 0), $params);
	
	$result = $ci->client_m->dropdown_list($params['company_id'], $params);

	if( $method == 'ajax' ){
	
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
			$list[] = array( 
				"value" => $row->client_id
				, "text" => $row->client_name
				//, "params" => json_encode(array('client_name' => $row->client_name, 'client_address' => $row->client_address, 'client_phone' => $row->client_phone, 'client_contact_email' => $row->client_contact_email))
			);
		}
		
		header('Content-Type: application/json');
        echo json_encode($list);
		die;
	}
	else if($method == 'list') {
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
				$list[] = array( 
					"value" => $row->client_id
					, "text" => $row->client_name
					//, "params" => json_encode(array('client_name' => $row->client_name, 'client_address' => $row->client_address, 'client_phone' => $row->client_phone, 'client_contact_email' => $row->client_contact_email))
				);
		}
		
		return $list;
	}
	
	$list = array();
	if( $params['first_row'] ) {
		$list[""] = $params['default_text'];
	}
		
	foreach ($result as $row) {
		$list[$row->client_id] = $row->client_name;
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function sites_dropdown($method , $params = array()){
	
	$ci = & get_instance();
	$ci->load->model('site_model' , 'site_m');
	
	$params = array_merge( array('first_row' => FALSE, 'default_text' => '', 'company_id' => 0, 'field_name' => 'site_code'), $params);
	
	$result = $ci->site_m->dropdown_list($params['company_id'], $params);

	if( $method == 'ajax' ){
	
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
			$list[] = array( 
				"value" => $row->site_id
				, "text" => $row->$params['field_name']
			);
		}
		
		header('Content-Type: application/json');
        echo json_encode($list);
		die;
	}
	else if($method == 'list') {
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
				$list[] = array( 
					"value" => $row->site_id
					, "text" => $row->$params['field_name']
				);
		}
		
		return $list;
	}
	
	$list = array();
	if( $params['first_row'] ) {
		$list[""] = $params['default_text'];
	}
		
	foreach ($result as $row) {
		$list[$row->site_id] = $row->$params['field_name'];
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function form_types_dropdown($method , $params = array()){
	
	$ci = & get_instance();
	$ci->load->model('site_model' , 'site_m');
	
	$params = array_merge( array('first_row' => FALSE, 'default_text' => '', 'site_id' => 0), $params);
	
	$result = $ci->site_m->form_types_dropdown_list($params['site_id']);

	if( $method == 'ajax' ){
	
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
			$list[] = array( 
				"value" => $row->form_type_id
				, "text" => $row->form_type_name
			);
		}
		
		header('Content-Type: application/json');
        echo json_encode($list);
		die;
	}
	else if($method == 'list') {
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
				$list[] = array( 
					"value" => $row->form_type_id
					, "text" => $row->form_type_name
				);
		}
		
		return $list;
	}
	
	$list = array();
	if( $params['first_row'] ) {
		$list[""] = $params['default_text'];
	}
		
	foreach ($result as $row) {
		$list[$row->form_type_id] = $row->form_type_name;
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function site_fields_dropdown($method , $params = array()){
	
	$ci = & get_instance();
	$ci->load->model('site_model' , 'site_m');
	
	$params = array_merge( array('first_row' => FALSE, 'default_text' => '', 'company_id' => 0, 'field_name' => 'site_code'), $params);
	
	$result = $ci->site_m->site_field_dropdown_list($params);

	if( $method == 'ajax' ){
	
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
			$list[] = array( 
				"value" => $row->id
				, "text" => $row->name
			);
		}
		
		header('Content-Type: application/json');
        echo json_encode($list);
		die;
	}
	else if($method == 'list') {
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
				$list[] = array( 
					"value" => $row->id
					, "text" => $row->name
				);
		}
		
		return $list;
	}
	
	$list = array();
	if( $params['first_row'] ) {
		$list[""] = $params['default_text'];
	}
		
	foreach ($result as $row) {
		$list[$row->id] = $row->name;
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function district_dropdown($method , $params = array()){
	
	$ci = & get_instance();
	$ci->load->model('site_model' , 'site_m');
	
	$params = array_merge( array('first_row' => FALSE, 'default_text' => '', 'site_id' => 0), $params);
	
	$result = $ci->site_m->district_dropdown_list();

	if( $method == 'ajax' ){
	
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
			$list[] = array( 
				"value" => $row->id
				, "text" => $row->name
			);
		}
		
		header('Content-Type: application/json');
        echo json_encode($list);
		die;
	}
	else if($method == 'list') {
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
				$list[] = array( 
					"value" => $row->id
					, "text" => $row->name
				);
		}
		
		return $list;
	}
	
	$list = array();
	if( $params['first_row'] ) {
		$list[""] = $params['default_text'];
	}
		
	foreach ($result as $row) {
		$list[$row->id] = $row->name;
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function postcode_dropdown($method , $params = array()){
	
	$ci = & get_instance();
	$ci->load->model('site_model' , 'site_m');
	
	$params = array_merge( array('first_row' => FALSE, 'default_text' => '', 'site_id' => 0), $params);
	
	$result = $ci->site_m->postcode_dropdown_list();

	if( $method == 'ajax' ){
	
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
			$list[] = array( 
				"value" => $row->id
				, "text" => $row->name
			);
		}
		
		header('Content-Type: application/json');
        echo json_encode($list);
		die;
	}
	else if($method == 'list') {
		$list = array();
		if( $params['first_row'] ) {
			$list[] = array( "value" => "", "text" => $params['default_text']);
		}
		
		foreach ($result as $row) {
				$list[] = array( 
					"value" => $row->id
					, "text" => $row->name
				);
		}
		
		return $list;
	}
	
	$list = array();
	if( $params['first_row'] ) {
		$list[""] = $params['default_text'];
	}
		
	foreach ($result as $row) {
		$list[$row->id] = $row->name;
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function contact_dropdown($method , $ref_id, $contact_type_id, $first_row = FALSE, $default_text = ''){
	
	$ci = & get_instance();
	$ci->load->model('contact_model', 'contact_m');
	
	$result = $ci->contact_m->get_by_many(array(
		'ref_id'			=> $ref_id
		,'contact_type_id' 	=> $contact_type_id
	), 'RESULT');
	
	if( $method == 'ajax' ){
	
		$list = array();
		if( $first_row ) {
			$list[] = array( "value" => "", "text" => $default_text);
		}
		
		foreach ($result as $row) {
			$list[] = array( "value" => $row->id, "text" => $row->contact_name );
		}
		
		@header('Content-Type: application/json');
        echo json_encode($list);
		exit;
	}
	
	$list = array();
	if( $first_row ) {
		$list[""] = $default_text;
	}
	
	foreach ($result as $row) {
		$list[$row->id] = $row->contact_name;
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}

function cust_tbls_dropdown($method, $tbl = '' , $first_row = FALSE, $default_text = ''){
	
	$ci = & get_instance();
	$ci->load->model('site_model' , 'site_m');
	
	$result = $ci->site_m->custom_table_list($tbl);
	
	if( $method == 'ajax' ){
	
		$list = array();
		if( $first_row ) {
			$list[] = array( "value" => "", "text" => $default_text);
		}
		
		foreach ($result as $row) {
			$list[] = array( "value" => $row->value, "text" => $row->text );
		}
		
		@header('Content-Type: application/json');
        echo json_encode($list);
		exit;
	}
	
	$list = array();
	if( $first_row ) {
		$list[""] = $default_text;
	}
	
	foreach ($result as $row) {
		$list[$row->value] = $row->text;
	}
	
	if( $method == 'return' ){
		return $list;
	} else {
		echo $list;
	}
	
}