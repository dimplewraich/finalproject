var jstz = {
	local_gmt_offset : '',
	timezones : [
		{tz_key : 'UM12', tz_name : '(UTC -12:00) Baker/Howland Island', tz_val : "-12"},
		{tz_key : 'UM11', tz_name : '(UTC -11:00) Samoa Time Zone, Niue', tz_val : "-11"},
		{tz_key : 'UM10', tz_name : '(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti', tz_val : "-10"},
		{tz_key : 'UM95', tz_name : '(UTC -9:30) Marquesas Islands', tz_val : "-9.5"},
		{tz_key : 'UM9', tz_name : '(UTC -9:00) Alaska Standard Time, Gambier Islands', tz_val : "-9"},
		{tz_key : 'UM8', tz_name : '(UTC -8:00) Pacific Standard Time, Clipperton Island', tz_val : "-8"},
		{tz_key : 'UM7', tz_name : '(UTC -7:00) Mountain Standard Time', tz_val : "-7"},
		{tz_key : 'UM6', tz_name : '(UTC -6:00) Central Standard Time', tz_val : "-6"},
		{tz_key : 'UM5', tz_name : '(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time', tz_val : "-5"},
		{tz_key : 'UM45', tz_name : '(UTC -4:30) Venezuelan Standard Time', tz_val : "-4.5"},
		{tz_key : 'UM4', tz_name : '(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time', tz_val : "-4"},
		{tz_key : 'UM35', tz_name : '(UTC -3:30) Newfoundland Standard Time', tz_val : "-3.5"},
		{tz_key : 'UM3', tz_name : '(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay', tz_val : "-3"},
		{tz_key : 'UM2', tz_name : '(UTC -2:00) South Georgia/South Sandwich Islands', tz_val : "-2"},
		{tz_key : 'UM1', tz_name : '(UTC -1:00) Azores, Cape Verde Islands', tz_val : "-1"},
		{tz_key : 'UTC', tz_name : '(UTC) Greenwich Mean Time, Western European Time', tz_val : "0"},
		{tz_key : 'UP1', tz_name : '(UTC +1:00) Central European Time, West Africa Time', tz_val : "+1"},
		{tz_key : 'UP2', tz_name : '(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time', tz_val : "+2"},
		{tz_key : 'UP3', tz_name : '(UTC +3:00) Moscow Time, East Africa Time', tz_val : "+3"},
		{tz_key : 'UP35', tz_name : '(UTC +3:30) Iran Standard Time', tz_val : "+3.5"},
		{tz_key : 'UP4', tz_name : '(UTC +4:00) Azerbaijan Standard Time, Samara Time', tz_val : "+4"},
		{tz_key : 'UP45', tz_name : '(UTC +4:30) Afghanistan', tz_val : "+4.5"},
		{tz_key : 'UP5', tz_name : '(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time', tz_val : "+5"},
		{tz_key : 'UP55', tz_name : '(UTC +5:30) Indian Standard Time, Sri Lanka Time', tz_val : "+5.5"},
		{tz_key : 'UP575', tz_name : '(UTC +5:45) Nepal Time', tz_val : "+5.75"},
		{tz_key : 'UP6', tz_name : '(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time', tz_val : "+6"},
		{tz_key : 'UP65', tz_name : '(UTC +6:30) Cocos Islands, Myanmar', tz_val : "+6.5"},
		{tz_key : 'UP7', tz_name : '(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam', tz_val : "+7"},
		{tz_key : 'UP8', tz_name : '(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time', tz_val : "+8"},
		{tz_key : 'UP875', tz_name : '(UTC +8:45) Australian Central Western Standard Time', tz_val : "+8.75"},
		{tz_key : 'UP9', tz_name : '(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time', tz_val : "+9"},
		{tz_key : 'UP95', tz_name : '(UTC +9:30) Australian Central Standard Time', tz_val : "+9.5"},
		{tz_key : 'UP10', tz_name : '(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time', tz_val : "+10"},
		{tz_key : 'UP105', tz_name : '(UTC +10:30) Lord Howe Island', tz_val : "+10.5"},
		{tz_key : 'UP11', tz_name : '(UTC +11:00) Magadan Time, Solomon Islands, Vanuatu', tz_val : "+11"},
		{tz_key : 'UP115', tz_name : '(UTC +11:30) Norfolk Island', tz_val : "+11.5"},
		{tz_key : 'UP12', tz_name : '(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time', tz_val : "+12"},
		{tz_key : 'UP1275', tz_name : '(UTC +12:45) Chatham Islands Standard Time', tz_val : "+12.75"},
		{tz_key : 'UP13', tz_name : '(UTC +13:00) Phoenix Islands Time, Tonga', tz_val : "+13"},
		{tz_key : 'UP14', tz_name : '(UTC +14:00) Line Islands', tz_val : "+14"}
	],
	
	tz_detect : function(){
		var d = new Date()
		var offset = (d.getTimezoneOffset()/60) + '';
		
		if(offset<0){	
			offset = offset.replace(/[-]/g,'+');
		} else if(offset>0){
			offset = offset.replace(/[+]/g,'-');
		}else{
			offset = offset.replace(/[-]/g,'').replace(/[+]/g,'');
		}
		
		
		$.each(jstz.timezones, function(index, timezone){
			
			if(offset == timezone.tz_val){
				jstz.local_gmt_offset = timezone.tz_key;
			}
		});
		
		if(jstz.local_gmt_offset != '' && typeof (APP.gmt_offset) !== 'undefined' && APP.gmt_offset !='' && jstz.local_gmt_offset != APP.gmt_offset && APP.gmt_options.recheck == true){
			
			form_action =  SITE_URL + "profile/set_timezone";
			gl._form({data_type : "html" , form_method : "POST", form_url : form_action, form_data : {'front_gmt_offset' : jstz.local_gmt_offset}, data_type : "html", "role" : "modal", "created_new" : true, "title" : "Timezone Detail", "modal" : {"buttons" : true, "modal_before_close_callback" : "jstz._callback_timezone()"}, "params" : "echo"});
		}
	},
	
	_callback_timezone : function(){
		form_action =  SITE_URL + "profile/synctimezone";
		gl._form({form_url : form_action, form_data : {'front_gmt_offset' : jstz.local_gmt_offset}, "callback" : "jstz._callback_update(response,form)"});
	},
	
	_callback_update : function(response,form){		
		APP.gmt_options.recheck = response.gmt_options.recheck;
	}
};

jQuery.fn.table2CSV = function(options) {
    var options = jQuery.extend({
        separator: ',',
        header: [],
        delivery: 'popup' /* popup, value */
    },
    options);

    var csvData = [];
    var headerArr = [];
    var el = this;

    var numCols = options.header.length;
    var tmpRow = [];

    row2CSV(tmpRow);

    
    $(el).find('tr').each(function() {
        var tmpRow = [];
		
		$(this).filter(':visible').find('th').each(function() {
            if ($(this).css('display') != 'none') tmpRow[tmpRow.length] = formatData(strip_tags($(this).html()));
        });
		
		if(tmpRow.length > 0) row2CSV(tmpRow);
		var tmpRow = [];
        $(this).filter(':visible').find('td').each(function() {
            if ($(this).css('display') != 'none') tmpRow[tmpRow.length] = formatData(strip_tags($(this).html()));
        });
		
        if(tmpRow.length > 0) row2CSV(tmpRow);
    });
	
    if (options.delivery == 'popup') {
        var mydata = csvData.join('\n');
        return popup(mydata, options.href);
    } else {
        var mydata = csvData.join('\n');
        return mydata;
    }

    function row2CSV(tmpRow) {
        var tmp = tmpRow.join('') // to remove any blank rows

        if (tmpRow.length > 0 && tmp != '') {
            var mystr = tmpRow.join(options.separator);
            csvData[csvData.length] = mystr;
        }
    }
    function formatData(input) {return input;
        
		var regexp = new RegExp(/["]/g);
        var output = input.replace(regexp, "“");
        
		var regexp = new RegExp(/\<[^\<]+\>/g);
        var output = output.replace(regexp, "");
        if (output == "") return '';
        return '"' + output + '"';
    }
	
	function strip_tags(html) {
		var tmp = document.createElement("div");
		tmp.innerHTML = html;
		return tmp.textContent||tmp.innerText;
	}
	
    function popup(data,href) {
		$('div.csv-data').remove();
		$('body').append('<div class="csv-data" style="display:none;"><form enctype="multipart/form-data" method="post" action="'+href+'"><textarea class="form" name="csv">'+data+'</textarea></form></div>');
		$('div.csv-data form').submit();
        return true;
    }
};

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
	
	$.extend({
		capitalize : function (e) {
			return  (typeof e !== 'undefined') ? e.charAt(0).toUpperCase() + e.slice(1) : '';
		}
	});

}(jQuery));

!function ($) {

	"use strict";

	var Wdpsection = function (element, options) {
		this.options = options
		this.$element = $(element)
							.delegate('[data-dismiss="wdpsection"]', 'click.dismiss.wdpsection', $.proxy(this.hide, this))
		this.options.remote && this.$element.find('.modal-body').load(this.options.remote)
	}

	Wdpsection.prototype = {

		constructor: Wdpsection

		, toggle: function () {
			return this[!this.isShown ? 'show' : 'hide']()
		}

		, show: function () {
			var that = this
				, e = $.Event('show')

			this.$element.trigger(e)

			if (this.isShown || e.isDefaultPrevented()) return

			this.isShown = true
			
			this.backdrop(function () {
				var transition = $.support.transition && that.$element.hasClass('fade')

				that.$element.show()
				
				if(typeof that.options.initiator !== 'undefined' ) that.options.initiator.hide()

			})
		}

		, hide: function (e) {
			e && e.preventDefault()

			var that = this

			e = $.Event('hide')

			this.$element.trigger(e)

			if (!this.isShown || e.isDefaultPrevented()) return

			this.isShown = false

			this.hideWdpsection()
		}
		
		, hideWdpsection: function () {
			var that = this
			this.$element.hide()
			
			if(typeof this.options.initiator !== 'undefined' ) this.options.initiator.show()
		}
		
		, backdrop: function (callback) {
				
			callback()
		}

	}

	var old = $.fn.wdpsection

	$.fn.wdpsection = function (option) {
		return this.each(function () {
			var $this = $(this)
				, data = $this.data('wdpsection')
				, options = $.extend({}, $.fn.wdpsection.defaults, $this.data(), typeof option == 'object' && option)
			
			

			if (!data) $this.data('wdpsection', (data = new Wdpsection(this, options))) 

			if (typeof option == 'string') data[option]()
			else if (options.show) data.show()
		})
	}

	$.fn.wdpsection.defaults = {
		show: true
	}

	$.fn.wdpsection.Constructor = Wdpsection

	$.fn.wdpsection.noConflict = function () {
		$.fn.wdpsection = old
		return this
	}

}(window.jQuery);

var gl =
{
	gritter_light: true,
	latitude : "",	
	longitude : "",	
	gdialog : null,
	dialog : null,
	dialogS : null,
	debug : false,
	
	round2decimal : function(d){
		
		return  (parseInt(d * 100)/100);
	},
	
	log_it : function(str , log){
		/*console.log(str);console.log(log);*/
	},
	
	validate_decimal: function(val){
		var regexp = /^\d+(\.\d{0,100})?$/; /*/^\d+\.\d{0,2}$/;*/
		
		return regexp.test(val);
	},
	
	to_int : function(val){
	
		return gl.validate_decimal(val) ? parseInt(val) : 0;
	},
	
	to_decimal : function(val){
	
		return gl.validate_decimal(val) ? parseFloat(val) : 0;
	},
	
	_fixed_dec : function(val){/*console.log("VAL:"+ val+" ::CONVERTED TO:" + (gl.validate_decimal(val) ? parseFloat(val).toFixed(2) : 0) );*/
	
		return gl.validate_decimal(val) ? parseFloat(val).toFixed(2) : 0;
	},
	
	pnotify: function(ptype,ptitle,ptext) {
		var picon = '';
		
        switch (ptype) {
			case 'success':
				picon = "growl-success";
				break;
			case 'error':
				picon = "growl-danger";
				break;
			case 'info':
				picon = "growl-info";
				break;
			default:
				picon = "growl-success";
				break;
		}
		
		jQuery.gritter.add({
			title: $.capitalize(ptitle),
			text: ptext,
			class_name: picon
		});
    },
	
	show_error: function(ptext) {
        gl.pnotify('error','Error',ptext);
    },
	
	show_success: function(ptext) {
        gl.pnotify('success','Success',ptext);
    },
	
	show_info: function(ptext) {
        gl.pnotify('info','Info',ptext);
    },
	
	js_error: function(xhr, ajaxOptions, thrownError) {
        gl.pnotify('error','Error','Something went wrong.');
    },
	
	val : function(e){
		return (typeof($(e).val()) == 'undefined') ? '' : e;
	},
	
	prop_buttons : function(form,state){
		
		try{
			if(form.initiator[0].tagName.toLowerCase() == 'form'){
				form.initiator.find('button[type="submit"]').prop("disabled",state);
				form.initiator.find('button[type="button"]').prop("disabled",state);
				$('button[data-trigger="form"]').prop("disabled",state);
			}
		}catch(e){}
	},
	
	dropdown : function(form){

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
					
				if( form.select_type == 'select2' ){
					mySelect.show();
					mySelect.removeClass("chzn-done").data("chosen", null).next().remove();
				}
				
				if( form.first_row ) {
					mySelect.append(
						$('<option></option>').val("").html( form.select_type == 'select2' ? "" : form.default_text)
					);
				}
				
				$.each(data, function(e, m)
				{
					if(typeof m.params === 'undefined'){
					
						if( typeof m.rows !== 'undefined'){
							
							var opt = $('<optgroup label="'+m.text+'"></option>');
							
							$.each(m.rows, function(k, wt)
							{	
								opt.append($('<option></option>').val(wt.value).html(wt.text))
							});
							
							mySelect.append(opt);
							
						} else {
					
							mySelect.append(
								$('<option></option>').val(m.value).html(m.text)
							);
						}
					} else {
						
						if( typeof m.rows !== 'undefined'){
							
							var opt = $('<optgroup label="'+m.text+'"></option>');
							$.each(m.rows, function(k, wt)
							{	
								opt.append($("<option data-options='"+m.params+"'></option>").val(wt.value).html(wt.text))
							});
							
							mySelect.append(opt);
							
						} else {
						
							mySelect.append(
								$("<option data-options='"+m.params+"'></option>").val(m.value).html(m.text)
							);
						}
					}
				});
				
				if( form.select_type == 'select2'){
					mySelect.chosen({'width':'100%','white-space':'nowrap',allow_single_deselect:true});
				}
				
				
				if(form.callback_fun){
					eval(form.callback_fun);
				}
            }
			
			,error: function(xhr, ajaxOptions, thrownError){
				gl.log_it(xhr.responseText);
			}
        });
	},
	
	select2 : function(form){
	
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
	},
	
	_form: function(form){
		
		var options = $.extend(
			{"role" : false, "callback" : false, 'params' : false, 'created_new' : false, 'title' : '', "beforesend_callback" : false, "success_callback" : false, "reload" : false, "loader" : "default", initiator : false}
			,{data_type : "json" , form_method : "POST", form_data : {}}
			,form
		);
		
		gl._wdp_ajax(options);
	},
	
	_get: function(form){
		
		var options = $.extend(
			{"role" : false, "callback" : false, 'params' : false, 'created_new' : false, 'title' : '', "beforesend_callback" : false, "success_callback" : false, "reload" : false, "loader" : "default", initiator : false}
			,{data_type : "json" , form_method : "GET"}
			,form
		);
		
		gl._wdp_ajax(options);
	},
	
	_process : function(ctrl){
	
		var $this = $(ctrl)
			, element = $this[0].tagName.toLowerCase()
			, form_data = (element == 'form') ? $this.serialize() : {}
			, url_tag = (element == 'form') ? 'action' : (element == 'a' ?  'href' : 'data-url')
			, form_url = (typeof($this.attr(url_tag)) != 'undefined' ) ? $this.attr(url_tag) : false
			, options = $.extend(
					{"role" : false, "callback" : false, 'params' : false, 'created_new' : false, 'title' : '', "beforesend_callback" : false, "success_callback" : false, "reload" : false, "loader" : "default", initiator : false}
					, { data_type: "json" ,form_method : "POST", 'form_url': form_url, 'form_data' : form_data, 'initiator': $this, "formdateget_callback" : false}
					, $this.data('options')
				);
				
		if(options.formdateget_callback != false){
			options.form_data = eval(options.formdateget_callback);
		}
		
		gl.log_it("gl._process() - options", options);
				
		gl._wdp_ajax(options);
	},
	
	_wdp_ajax : function(form){
	
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
					
					if(form.loader == 'div'){
						form.initiator.append('<div class="padding wdp-loader"><img src="'+ASSET_URL+'images/loaders/loader25.gif"></div>');
					} else if(form.loader == 'default'){
						$( 'div.wdp-loader' ).show();
					} else if(form.loader == 'modal'){
						$(".modal .modal-footer .wdp-loader").show();
					} else if(form.loader == 'fb'){
						form.initiator.after('<div class="ml5 mr5 fb-loader pull-left"><img src="'+ASSET_URL+'images/loaders/loader14.gif"></div>');
					} else if(form.loader == 'fa'){
						form.initiator.after('<div class="ml5 mr5 fb-loader pull-left"><img src="'+ASSET_URL+'images/loaders/loader14.gif"></div>');
					} else {
						$("#qLoverlay").show();
						$("#qLbar").show();
					}
					
					gl.prop_buttons(form, true);
					
				}
				,success: function(response){
				
					gl.log_it("gl._wdp_ajax() - after ajax call - response", response);
					gl.log_it("gl._wdp_ajax() - after ajax call - form", form);
				
					if(form.beforesend_callback){
						eval(form.beforesend_callback);
					}

					if(form.form_method == 'GET' && form.role == 'modal'){
						gl.open_modal(response, form);
					} else if(form.form_method == 'POST' && form.data_type == 'json'){
					
						response = $.extend({"status" : "", "message" : "", 'html' : "","redirect"  : false}, response);
						
						if(response.status != '' && response.message != ''){
						
							if(response.status == "success" &&  response.redirect != false ){
								window.location = response.redirect;
								return;
							}
			
							gl.pnotify(response.status,response.status,response.message);
							
							if(response.status == "success" &&  form.success_callback != false ){
								var g = gl.getGrid(form);
								eval(form.success_callback);
							}
							
							
						} else if( form.role == 'modal' ) {
						
							gl.open_modal(response.html, form);
							
						} else if(response.html != '' && form.reload == 'modal' && response.status != "success"){
						
							gl.close_modal(response,form);
							gl.open_modal(response.html, form);
							
						}
						
					} else if(form.form_method == 'POST' && form.role == 'modal'){
						gl.open_modal(response, form);
					}
						
					if(form.callback != false){
						eval(form.callback);
					}
					
					gl.prop_buttons(form, false);
				}
				,complete : function(xhr,status){
					
					if(form.loader == 'div'){
						form.initiator.find('.wdp-loader').remove();
					} else if(form.loader == 'default'){
						$( 'div.wdp-loader' ).hide();
					} else if(form.loader == 'modal'){
						$(".modal .modal-footer .wdp-loader").hide();
					} else if(form.loader == 'fb'){
						form.initiator.parent().find('.fb-loader').remove();
					} else if(form.loader == 'fa'){
						form.initiator.parent().find('.fb-loader').remove();
					} else {
						$("#qLoverlay").fadeOut(250);
						$("#qLbar").fadeOut(250);
					}
				}
				,error: function(xhr, ajaxOptions, thrownError){
					gl.log_it("gl._wdp_ajax() - after ajax call ajax:ERROR- xhr.responseText", xhr.responseText);				
					/*gl.show_error("status : " + xhr.status +"<br />" + "responseText:" + xhr.responseText);*/
				}
			});
		}catch(e){}
	},
	
	modal_html : function(html, form){

		var _buttons = (typeof(form.modal) != 'undefined' && typeof(form.modal.buttons) != 'undefined' && form.modal.buttons == false) ? false : true;
		var _footer = (typeof(form.modal) != 'undefined' && typeof(form.modal.footer) != 'undefined' && form.modal.footer == false) ? ' style="display:none"' : '';
		var _modal_size = (typeof(form.modal) != 'undefined' && typeof(form.modal.size) != 'undefined' && form.modal.size != '') ? form.modal.size : ''; /* modal-lg, modal-sm*/
		var _wizard = (typeof(form.modal) != 'undefined' && typeof(form.modal.wizard) != 'undefined' && form.modal.wizard == true) ? true : false;
		var _nopadding = (typeof(form.modal) != 'undefined' && typeof(form.modal.nopadd) != 'undefined') ? ( form.modal.nopadd == true ? "nopadding" : '') : ( _wizard ? "nopadding" : '');
		
		if(form.created_new){
		
			_buttons = _buttons ? '<div class="pull-left wdp-loader" style="display:none"><img src="'+ASSET_URL+'images/loaders/loader14.gif" alt=""></div><button class="btn btn-primary" type="button" data-trigger="form"><i class="glyphicon glyphicon-ok mr5"></i> Save Changes</button>' : '';
			
			return '<div id="'+guid()+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
						'<div class="modal-dialog '+_modal_size+'" '+(_modal_size ? ' style="margin-top:80px;"':'')+'>' +
							'<div class="modal-content">' +
								'<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">' + form.title + '</h4></div>' +
								'<div class="modal-body '+_nopadding+'">' + html + '</div>' +
								'<div class="modal-footer"'+_footer+'>' +
									_buttons +
									'<button class="btn" type="button" data-dismiss="modal"><i class="glyphicon glyphicon-remove mr5"></i> Close</button>' +
								'</div>' +
							'</div>' +
						'</div>' +
					'</div>';
		} else {
			return '<div id="'+guid()+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' + html + '</div>';
		}
	},
	
	open_modal: function(html, form){
		
		$dialog = $(gl.modal_html(html, form)).appendTo('body');
		
		$dialog.on('shown.bs.modal', function (e) {
			
			if($("div.modal").length > 1) {
			
				var zindex = 1050 + (10 * ($("div.modal").length - 1)) ;			
				$(this).css({"z-index" : zindex});
				var zindex = 1040 + (10 * ($("div.modal").length - 1)) + 1 ;
				$("div.modal-backdrop").last().css({"z-index" : zindex});/*(this).next*/
			}
			
			if($(this).find("form").length > 0) {
			
				var g = gl.setGrid($(this).find("form")), frm = $(this).find("form");
	
				$(frm).find('select').each(function(i, ctrl){
					
					if( !$(ctrl).hasClass('nostyle')) {
						gl.select2({ form_ctrl : $(ctrl), empty : false});
					}
				});
				
				$options = $(this).find("form").data('options');
				
				if(typeof($options.modal_callback)!='undefined' && $options.modal_callback){
					eval($options.modal_callback);
				}
				
				try{
					//console.log("shown.bs.modal: Modal Form");
					//console.log($options);
					//console.log("shown.bs.modal: _src_initiator");
					//console.log(g);
				}catch(e){}
				
				try{
					
					$(frm).find("div.datepicker").datetimepicker({
						dateFormat: 'dd/mm/yy',
						showButtonPanel: false,
						onSelect : function(dateText, inst){
							$($(frm).find("div.datepicker").closest("div.form-group")).find("input").val(dateText);
						}
					});
					
					$(frm).find('input.dpicker').each(function(i, ctrl){
						$(ctrl).datepicker({dateFormat: 'dd/mm/yy'});
									
						$(ctrl).closest('div').find('.fa-calendar').click(function(){
							$(this).closest('div').find("input.dpicker").datepicker('show');
						});
					});
					
					$(frm).find('input.dtpicker').each(function(i, ctrl){
						$(ctrl).datepicker({dateFormat: 'dd/mm/yy'});
									
						$(ctrl).closest('div').find('.fa-calendar').click(function(){
							$(this).closest('div').find("input.dtpicker").datepicker('show');
						});
					});
					
					$(frm).find("input.dt-time").each(function(i, ctrl){
			
						$(ctrl).timepicker({showMeridian: false, stepMinute : 15}).prop("readonly", true);
						
						$(ctrl).closest('div').find('.fa-clock-o').click(function(){
							$(ctrl).datepicker('show');
						});
					});
					
				} catch(e){}
			}
			
			gl.bind_ajax();
		});
		
		$dialog.on('hidden.bs.modal', function (e) {
		
			try{
				$(this).find("form").find("textarea.tinymce").tinymce().remove();
			}catch(e){}
			
			if($(this).find("form").length <= 0) return;
		
			$options = $(this).find("form").data('options');
			
			var g = gl.getGrid($options);
			
			if(typeof($options.modal_before_close_callback)!='undefined' && $options.modal_before_close_callback){
				eval($options.modal_before_close_callback);
			}
			
			$(this).remove();
		});
		
		if( form.callback !== false && jQuery.trim(form.callback) !=''){
			eval(form.callback);
		}
		
		if($dialog.find('form').length > 0){
			
			$dialog.find('button[data-trigger="form"]').click(function(){
			
				var $this = $(this)
					,$form = $this.closest('div.modal').find('form');
				
				gl._process($form);
			});
			
		} else{
			$dialog.find('button[data-trigger="form"]').hide();
		}
		
		if(form.created_new){
			
			var modal_callback = (typeof(form.modal) != 'undefined' && typeof(form.modal.callback) != 'undefined') ? form.modal.callback : false;
			var modal_callback_override = (typeof(form.modal) != 'undefined' && typeof(form.modal.override) != 'undefined') ? form.modal.override : false;
			var modal_success_callback = (typeof(form.modal) != 'undefined' && typeof(form.modal.modal_success_callback) != 'undefined') ? form.modal.modal_success_callback : '';
			var modal_before_close_callback = (typeof(form.modal) != 'undefined' && typeof(form.modal.modal_before_close_callback) != 'undefined') ? form.modal.modal_before_close_callback : false;
			
			if(modal_callback_override){
				modal_success_callback = "gl.close_modal(response,form);" + modal_success_callback;
			} else {
				$opt = $dialog.find("form").data('options');
				
				if( ($opt != null && typeof($opt) != 'undefined') && (typeof($opt.success_callback) != 'undefined') && ($opt.success_callback != '' || $opt.success_callback != false) ){
					modal_success_callback = "gl.close_modal(response,form);" + modal_success_callback + $opt.success_callback;
				} else{
					modal_success_callback = "gl.close_modal(response,form);";
				}
			}
			
			var _initiator = typeof form.initiator !== 'undefined' ? form.initiator : false;
			
			$dialog.find("form").data('options', $.extend( $dialog.find("form").data('options'), {"success_callback" : modal_success_callback, "modal_callback" : modal_callback, "modal_before_close_callback" : modal_before_close_callback, "_src_initiator" : _initiator}) );
		}
		$dialog.modal({backdrop: 'static', keyboard: false});
		$dialog.modal('show');
	},
	
	close_modal : function(response,form){
		
		form.initiator.closest('.modal').modal('hide');
		
	},
	
	setGrid : function(frm){
	
		var $form = $(frm),
			$options = frm.data('options')
			,_soptions = (typeof $options._src_initiator === 'object') ? $options._src_initiator.data('options') : false
			,_init_grid = (_soptions && typeof _soptions.grid === 'object') ? _soptions.grid._init : false
			,_Filter = (_init_grid && typeof _soptions.grid._Filter !== 'undefined') ? _soptions.grid._Filter : false
			,_grid_type = _init_grid ? _soptions.grid.gType : 'default';
		
		var g = {};
		if(_init_grid && _grid_type == 'next'){
			
			g = $form.data('options');
			
			g.grid = $.extend({
				_bFilter : false,
				_bLengthChange : false,
				_aaSorting : [],
				_init_ctrls : true,
				_frm : false,
				_oTable : false,
				_oSettings : false,
				_sKey : "",
				_default : false,
				_table_id : "",
				_aoColumnDefs : [],
				_grid_url : ""
			}, g.grid,  {_frm : $form}, {_bFilter : _Filter});
			
			g.grid._aaSorting = eval(g.grid._aaSorting);
			g.grid._aoColumnDefs = eval(g.grid._aoColumnDefs);
			
			$(g.grid._frm).data('options',g);
		}
		
		return g;
	},
	
	getGrid : function(options){
		var _soptions = (typeof options._src_initiator === 'object') ? options._src_initiator.data('options') : false
			,_init_grid = (_soptions && typeof _soptions.grid === 'object') ? _soptions.grid._init : false
			,_grid_type = _init_grid ? _soptions.grid.gType : 'default';

		var g = {};
		if(_init_grid && _grid_type == 'next'){
			g = $.extend({}, options);
		} else if(_init_grid && _grid_type == 'default'){
			g = $.extend({},$options._src_initiator.closest(".grid-list").find("form[name='grid-list-param']").data('options'));
		}
		
		return g;
	},
	
	pdialogm : function (title, description){
		
		var html = '<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
						'<div class="modal-dialog">' +
							'<div class="modal-content">' +
								'<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">' + title + '</h4></div>' +
								'<div class="modal-body">' + description + '</div>' +
								'<div class="modal-footer">' +
									'<button class="btn" type="button" data-dismiss="modal"><i class="glyphicon glyphicon-remove mr5"></i> Close</button>' +
								'</div>' +
							'</div>' +
						'</div>' +
					'</div>';
		
		$dialog = $(html).appendTo('body');
		
		$dialog.on('shown.bs.modal', function (e) {
			gl.bind_ajax();
			$(this).find('.btip').tooltip();
		});
		
		$dialog.on('hidden.bs.modal', function (e) {
			$(this).remove();
		});
		
		$dialog.modal('show');
	},
	
	bind_action_process_callback : function(response){
		if(gl.dialog != null) {
			gl.dialog.remove();
		}
		
		gl.dialog = $('<div id="my-form-Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>').appendTo('body');
	
		gl.dialog.on('shown', function (e) {});
		
		gl.dialog.on('hidden', function (e) {
			gl.dialog.remove();			
			gl.dialog = null;
		});
		
		gl.dialog.html(response);
		gl.dialog.modal();
	},
	
	bind_ajax : function(){
		
		$( 'a[data-ajax="wdpajax"], button[data-ajax="wdpajax"], input[data-ajax="wdpajax"], a.btn-download-csv, [data-toggle="wdpsection"]' ).unbind( "click" );
		$( 'form[data-ajax="wdpajax"]' ).unbind( "submit" );
		
		$('form[data-ajax="wdpajax"]').submit(function (e) {
			e.preventDefault();

			gl._process(this);
			return false;
		});
		
		$('a[data-ajax="wdpajax"], button[data-ajax="wdpajax"], input[data-ajax="wdpajax"]').click(function (e) {
			e.preventDefault();
			
			gl._process(this);
			return false;
		});
		
		$('[data-toggle="wdpsection"]').click(function (e) {
			var $this = $(this)
				, href = $this.attr('href')
				, $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, '')))
				, option = $target.data('wdpsection') ? 'toggle' : $.extend({  }, $target.data(), $this.data(),{'initiator':$this});

			e.preventDefault();

			$target
				.wdpsection(option)
				.one('show', function () {
					$this.focus()
				});
		}).css({"cursor":"pointer"});
		
		$('[data-toggle="wdpsection"]').each(function(e){
			var $this = $(this)		
				,$option = $this.data();
			
			$this.show();
			$($option.target).hide();
			$($option.target).find('[data-dismiss="wdpsection"]').show();

		});
	},
	
	round : function(val){
		
		
		return val > 0 ? parseFloat((parseInt(val * 100))/100).toFixed(2) : "0.00";
	},
	
	upload_document : function(form_url, form_data, ctrl_file_id ,success_callback){
		
		gl.upload_doc({
			"form_url" : form_url,
			"form_data" : form_data,
			"ctrl_file_id" : ctrl_file_id,
			"success_callback" : success_callback
		});
	},
	
	upload_doc : function(form){
	
		form = $.extend({"form_url" : false, "ctrl_file_id" : false, 'form_data' : {} ,success_callback  : false}, form);
		
		if(form.form_url == false || form.ctrl_file_id == false){
			gl.show_error("Error uploading document");
			return;
		}
		
		$.ajaxFileUpload({
            url: form.form_url,
            secureuri: false,
            fileElementId: form.ctrl_file_id,
            dataType: 'JSON',
			data: form.form_data,
			
            success: function(data, status) {
                var response = {};
				try {
					response = $.extend({}, response,$.parseJSON(data));
					
					if (response.status != 'error') {
						gl.pnotify('success','Done',response.message);
						eval(form.success_callback);
					} else {
						gl.pnotify('error','Error',response.message);
					}
					
				}catch(e){
					//console.log(e.message);
					eval(form.success_callback);
				}
				
				
            }
			,error: function(xhr, ajaxOptions, thrownError){
			}
        });
	}
}

$(document).ready(function() {
    
    $('.checkbox').click(function(e){
        
       e.stopPropagation(); 
        
    });
    
    /*if ($('textarea').hasClass('limit')) {
		$('.limit').inputlimiter({
			limit: 250
		});
	} */  
        
    $("a[rel=popover]")
	.popover({html:true,container: 'body'})
	.click(function(e) {
		e.preventDefault()
	});
	
	gl.bind_ajax();
	
	$('select').each(function(i, ctrl){
		if( !$(ctrl).hasClass('nostyle')) {
			gl.select2({ form_ctrl : $(ctrl), empty : false});
		}
	});
	
	$('input.dpicker').each(function(i, ctrl){
		$(ctrl).datetimepicker({dateFormat: 'dd/mm/yy'});
					
		$(ctrl).closest('div').find('.fa-calendar').click(function(){
			$(this).closest('div').find("input.dpicker").datepicker('show');
		});
	});
	
	//console.log("width:"+$(window).width());
});

function guid() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random()*16|0, v = c === 'x' ? r : (r&0x3|0x8);
        return v.toString(16);
    });
}