var $thispage = null;
Date.prototype.getWeek = function() {
	var date = new Date(this);
	date.setHours(0, 0, 0, 0);
  
	date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
	var week1 = new Date(date.getFullYear(), 0, 4);
	return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7);
}

Date.prototype.getWeekYear = function() {
	var date = new Date(this);
	date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
	return date.getFullYear();
}

String.prototype.ucfirst = function () {

    var x = this.split(/\s+/g);

    for (var i = 0; i < x.length; i++) {

        var parts = x[i].match(/(\w)(\w*)/);

        x[i] = parts[1].toUpperCase() + parts[2].toLowerCase();
    }

    return x.join(' ');
};

(function ($, undef) {
	"use strict";
	
	$.fn.sval = function (key) {
	
		var $el = (typeof(this[0]) !== 'undefined' && typeof(this) === 'object') ? this[0].tagName.toLowerCase() : false;
		
		if($el == 'select'){
			return (typeof(jQuery(this).find('option:selected').val()) === 'undefined') ? '' : jQuery.trim(jQuery(this).find('option:selected').val()); 
		} else {
	
			if( typeof(key) != 'undefined' && jQuery.trim(key) != ''){
				return (typeof(this.attr(key)) === 'undefined') ? '' : jQuery.trim(this.attr(key));
			} else {
				return (typeof(this.val()) === 'undefined') ? '' : jQuery.trim(this.val());
			}
		}
	};
	
	$.fn.stext = function (key) {
	
		var $el = (typeof(this) === 'object') ? this[0].tagName.toLowerCase() : false;
		
		if($el == 'select'){
			return (typeof(jQuery(this).find('option:selected').text()) === 'undefined') ? '' : jQuery.trim(jQuery(this).find('option:selected').text()); 
		} else {
	
			if( typeof(key) != 'undefined' && jQuery.trim(key) != ''){
				return (typeof(this.attr(key)) === 'undefined') ? '' : jQuery.trim(this.attr(key));
			} else {
				return (typeof(this.text()) === 'undefined') ? '' : jQuery.trim(this.text());
			}
		}
	};
	
	$.fn.formmarkup = function (key) {
		
		var $this = jQuery(this)
			, element = (typeof(this) === 'object') ? $this[0].tagName.toLowerCase() : false
			, type = (jQuery.inArray(element, ['input']) !== -1) ? jQuery(this).attr('type') : false
			, input = ['search','text','number','date','month','week','time','datetime','tel','email','url','password','color','file'];
			
		if(element == 'select'){
		
			gl.select2({form_ctrl : $this, empty : false});
			
		} else if(element == 'input' && jQuery.inArray(type, input) !== -1){
			
			if($this.closest('div').hasClass('ui-input-search') || $this.closest('div').hasClass('ui-input-text')){
				$this.textinput().textinput('destroy');
			}
			
			$this.textinput({ mini: true }).textinput('refresh', true);
		
		} else if(element == 'textarea'){
		
			if($this.hasClass('ui-input-text')){
				$this.textinput().textinput('destroy');
			}
			
			$this.textinput({ mini: true }).textinput('refresh', true);
		
		}
		
		
	};
	
	$.extend({
		capitalize : function (e) {
			return  (typeof e !== 'undefined') ? e.charAt(0).toUpperCase() + e.slice(1) : '';
		}
	});

}(jQuery));

var gl = gl || {
	latitude : ""
	,longitude : ""
	,debug : false
	
	,round2decimal : function(d){
		
		return  (parseInt(d * 100)/100);
	}
	
	,log_it : function(str , log){
		/*console.log(str);console.log(log);*/
	}
	
	,validate_decimal: function(val){
		var regexp = /^\d+(\.\d{0,100})?$/; /*/^\d+\.\d{0,2}$/;*/
		
		return regexp.test(val);
	}
	
	,to_int : function(val){
	
		return gl.validate_decimal(val) ? parseInt(val) : 0;
	}
	
	,to_decimal : function(val){
	
		return gl.validate_decimal(val) ? parseFloat(val) : 0;
	}
	
	,_fixed_dec : function(val){
	
		return gl.validate_decimal(val) ? parseFloat(val).toFixed(2) : 0;
	}
	
	,add_location : function(form){
		
		var form_data = {};
		if(form.form_method == 'POST'){
			if(form.d_format == 'serializearray'){
				var form_data = options.form_data.slice();
				form_data.push({name: 'latitude', value: gl.latitude});
				form_data.push({name: 'longitude', value: gl.longitude});
			} else {
				form_data = $.extend({}, options.form_data, {"latitude" : gl.latitude}, {"longitude" : gl.longitude});
			}
		}
		
		gl.log_it(form_data);
		
		return form_data;
	}
	
	,pnotify : function(title, message) {
		console.log($thispage);
		$popup = $thispage.find(".my_message_popup");
		$popup.popup({"corners" : false, "overlayTheme" : "a" ,"positionTo" : "window" , "theme" : "c"});
		$popup.find("div[data-role='header'] h1").html(title);
		
		$popup.find("div[data-role='header']").html('<h1 style="margin-left:0;margin-right:0;text-align:center">' + title + '</h1>');
		$popup.find("div[data-role='content'] p").html(message);
		
		$popup.popup('open',{"positionTo" : "window", "shadow" : false });
		$popup.find("div[data-role='header'] h1").addClass("ui-title");
	}
	
	,dropdown : function(form){

		form = $.extend({
			form_action : null
			,form_data : {}
			,form_ctrl : null
			,first_row : true
			,default_text : ""
			,select_type : ''
			,callback_fun : null
			,placeholder : false
			,multiple : false
		}, form);

		form.placeholder = ( form.form_ctrl && typeof(form.form_ctrl.attr('placeholder')) !== 'undefined') ? form.form_ctrl.attr('placeholder') : '';

		$.ajax({
            type: "POST"
            ,dataType: "json"
            ,data: form.form_data
            ,url: SITE_URL + form.form_action
			,cache : false
            ,success: function(data) {
				
				if(!form.form_ctrl) return;
			
				var mySelect = form.form_ctrl;
				
				if(typeof(mySelect[0]) !== 'undefined'){
					mySelect[0].options.length = 0;
				}
				
				if( form.first_row ) {
					mySelect.append(
						$('<option></option>').val("").html( form.default_text)
					);
				}
				
				$.each(data, function(e, m)
				{
					var params = (typeof m.params === 'undefined') ? '' : "data-options='"+m.params+"'";
					
					if( typeof m.rows !== 'undefined'){
							
						var opt = $('<optgroup label="'+m.text+'"></option>');
						$.each(m.rows, function(k, wt)
						{	
							opt.append($("<option"+params+"></option>").val(wt.value).html(wt.text))
						});
						
						mySelect.append(opt);
						
					} else {
					
						mySelect.append(
							$("<option "+params+"></option>").val(m.value).html(m.text)
						);
					}
				});
				
				
				if(form.callback_fun){
					eval(form.callback_fun);
				}
            }
			
			,error: function(xhr, ajaxOptions, thrownError){
				gl.log_it(xhr.responseText);
			}
        });
	}
	
	,select2 : function(form){
	
		form = $.extend({
			form_ctrl : null
			,first_row : false
			,default_text : ""
			,placeholder : false
			,empty : true
			,width : "100%"
		}, form);
	
		var mySelect = $(form.form_ctrl);
		
		if(form.empty){

			try{
				mySelect[0].options.length = 0;
			}catch(e){}
		
			try{
				mySelect.show();
				mySelect.removeClass("chzn-done").data("chosen", null).next().remove();
				
				if( form.first_row ) {
					mySelect.append(
						$('<option></option>').val("").html(form.default_text)
					);
				}
				
				mySelect.chosen({'width':form.width,'white-space':'nowrap',allow_single_deselect:true});
			}catch(e){}
		
		} else {
			try{
				mySelect.show();
				mySelect.removeClass("chzn-done").data("chosen", null).next().remove();
			}catch(e){}
			
			mySelect.chosen({'width':form.width,'white-space':'nowrap',allow_single_deselect:true});
		}
	}
	
	,_form: function(form){
		
		var options = $.extend(
			{"role" : false, "callback" : false, 'params' : false, 'created_new' : false, 'title' : '', "beforesend_callback" : false, "success_callback" : false, "reload" : false, "loader" : "default", initiator : false}
			,{data_type : "json" , form_method : "POST", form_data : {}}
			,form
		);
		
		gl._wdp_ajax(options);
	}
	
	,_get: function(form){
		
		var options = $.extend(
			{"role" : false, "callback" : false, 'params' : false, 'created_new' : false, 'title' : '', "beforesend_callback" : false, "success_callback" : false, "reload" : false, "loader" : "default", initiator : false}
			,{data_type : "json" , form_method : "GET"}
			,form
		);
		
		gl._wdp_ajax(options);
	}
	
	,_process : function(ctrl){
	
		var $this = $(ctrl)
			, element = $this[0].tagName.toLowerCase()
			, form_data = (element == 'form') ? $this.serialize() : {} /* serializeArray|serialize */
			, d_format = (element == 'form') ? 'serialize' : ''
			, url_tag = (element == 'form') ? 'action' : (element == 'a' ?  'href' : 'data-url')
			, form_url = (typeof($this.attr(url_tag)) != 'undefined' ) ? $this.attr(url_tag) : false
			, options = $.extend(
					{role : false, callback : false, params : false, created_new : false, title : '', beforesend_callback : false, success_callback : false, reload : false, loader : "default", initiator : false}
					, { data_type: "json" ,form_method : "POST", 'form_url': form_url, 'form_data' : form_data, initiator: $this, formdateget_callback : false, "d_format" : d_format}
					, $this.data('options')
				);
		
		options.form_data = gl.add_location(options);
		
		if(options.formdateget_callback != false){
			options.form_data = eval(options.formdateget_callback);
		}
		
		gl.log_it("gl._process() - options", options);
				
		gl._wdp_ajax(options);
	}
	
	,_wdp_ajax : function(form){
	
		gl.log_it("gl._wdp_ajax() - before ajax call - form", form);
	
		var date = new Date();
		var milliseconds = date.getTime();
		
		var form_action = form.form_url + (form.params ? "/"+ form.params : "");// + "?_=" + milliseconds;

		try {
			$.ajax({
				type: form.form_method
				,dataType: form.data_type
				,data: form.form_data
				,url: form_action
				,cache : false
				,beforeSend: function(xhr){
					$.mobile.showPageLoadingMsg();
				}
				,success: function(response){
				
					gl.log_it("gl._wdp_ajax() - after ajax call - response", response);
					gl.log_it("gl._wdp_ajax() - after ajax call - form", form);
				
					if(form.beforesend_callback){
						eval(form.beforesend_callback);
					}

					if(form.form_method == 'GET' && form.role == 'section'){
						gl.open_section(response, form);
						
					} else if(form.form_method == 'GET' && form.role == 'modal'){
					
						gl.open_modal(response, form);
						
					} else if(form.form_method == 'POST' && form.data_type == 'json'){
					
						response = $.extend({"status" : "", "message" : "", 'html' : "","redirect"  : false}, response);
						
						if(response.status != '' && response.message != ''){
						
							if(response.status == "success" &&  response.redirect != false ){
								window.location = response.redirect;
								return;
							}
			
							gl.pnotify($.capitalize(response.status), response.message);
							
							if(response.status == "success" &&  form.success_callback != false ){
								var g = gl.getGrid(form);
								eval(form.success_callback);
							}
							
						} else if( form.role == 'section' ) {
						
							gl.open_section(response.html, form);
							
						}
						
					} else if(form.form_method == 'POST' && form.role == 'section'){
						gl.open_section(response, form);
					}
						
					if(form.callback != false){
						eval(form.callback);
					}
				}
				,complete : function(xhr,status){
					$.mobile.hidePageLoadingMsg();
				}
				,error: function(xhr, ajaxOptions, thrownError){
					gl.log_it("gl._wdp_ajax() - after ajax call ajax:ERROR- xhr.responseText", xhr.responseText);
				}
			});
		}catch(e){}
	}
	
	,open_section: function(html, form){
	
		var $tab = $thispage.find(form.initiator).closest("div.job-tab")
				, p = $tab.find("ul.pnl-job")
				, c = $tab.find("ul.pnl-job-2")
				, s = $(c).find("div.div-section");
		
		p.hide();
		s.show().html(html);
		$frm = $(s).find('form');
		
		if($frm.length > 0){
			
			$frm.submit(function (e) {
				e.preventDefault();

				gl._process(this);
				return false;
			});
			
			$frm.find('button.btn-close-section').click(function (e) {
				e.preventDefault();
				
				gl.close_section(this);
			});
		}
			
		var modal_success_callback = (typeof(form.section) != 'undefined' && typeof(form.section.modal_success_callback) != 'undefined') ? form.section.modal_success_callback : '';
		var modal_before_close_callback = (typeof(form.section) != 'undefined' && typeof(form.section.modal_before_close_callback) != 'undefined') ? form.section.modal_before_close_callback : false;
		
		
		var $opt = $frm.data('options');
		
		if( ($opt != null && typeof($opt) != 'undefined') && (typeof($opt.success_callback) != 'undefined') && ($opt.success_callback != '' || $opt.success_callback != false) ){
			modal_success_callback = "gl.close_section(form.initiator);" + modal_success_callback + $opt.success_callback;
		} else{
			modal_success_callback = "gl.close_section(form.initiator);" + modal_success_callback;
		}
		
		var _initiator = typeof form.initiator !== 'undefined' ? form.initiator : false;
		
		$frm.data('options', $.extend( $frm.data('options'), {"success_callback" : modal_success_callback, "modal_before_close_callback" : modal_before_close_callback, "_src_initiator" : _initiator, target_tab : $tab}) );
		
		
		console.log($frm.data('options'));
		
		c.listview();
		c.listview('refresh');
		$(c).find('select').selectmenu();
		$(c).find('select').selectmenu("refresh");
		$(c).find('button').button();
		$(c).find('button').button('refresh');
		
		$thispage.trigger('create');
	}
	
	,close_section : function(ctrl){
		
		var tab = $thispage.find(ctrl).closest("div.job-tab")
			, p = tab.find("ul.pnl-job")
			, c = tab.find("ul.pnl-job-2")
			, s = (c).find("div.div-section");
			
		s.hide().html('');
		p.show();
	}
	
	,bind_ajax : function(){
		
		$thispage.find( 'a[majax="wdpajax"], button[majax="wdpajax"], input[majax="wdpajax"], a.btn-download-csv, [mtoggle="wdpsection"]' ).unbind( "click" );
		$thispage.find( 'form[majax="wdpajax"]' ).unbind( "submit" );
		
		$thispage.find('form[majax="wdpajax"]').submit(function (e) {
			e.preventDefault();

			gl._process(this);
			return false;
		});
		
		$thispage.find('a[majax="wdpajax"], button[majax="wdpajax"], input[majax="wdpajax"]').click(function (e) {
			e.preventDefault();
			
			gl._process(this);
			return false;
		});
	}
};

function getLocation()
{
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition);
	}
	else{ alert("Geolocation is not supported by this browser.");}
}

function showPosition(position)
{
	gl.latitude = position.coords.latitude;
	gl.longitude = position.coords.longitude;
}

$(document).on('pagecreate', function(event) {	
	console.log('GLOBAL:pagecreate');
});

$(document).on( 'pageremove', function( event ) {
	console.log('GLOBAL:pageremove');
});