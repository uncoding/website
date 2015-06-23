(function($) {
	jQuery.fn.ajaxDropdown = function(settings) {

		var debug = false; function log(message){if(!debug)return;console.log(message);}
		
		var dropdowns = this;
		
		var config = {
				showDefaultOption: true,
				defaultOptionLabel: 'select',
				defaultOptionValue: '',
				defaultSelectedValue:'',
				initSelectedValue:null,
				selectedValue:null,
				reverse: false,
				cache: true,
				onStart: function(dropdown){
					dropdown.after("<span class='loading'>&nbsp;&nbsp;&nbsp;&nbsp;</span>");
				},
				onFinish: function(dropdown){
					dropdown.next("span").remove();
				}
		};

		if (settings)
			jQuery.extend(config, settings);

		var fnLoadData = function(parentValue, dropdowns){
			
			log("load data for:" + dropdowns.selector + ", parentValue: " + parentValue);
			
			if(parentValue){
				config.params.parentValue = parentValue;
				var cacheOpts = dropdowns.data(parentValue);
				if(config.cache && cacheOpts){
					dropdowns.each(function(){
						$(this).empty();
						var _selectedValue = $(this).attr("selectedValue")!=null?$(this).attr("selectedValue"):config.selectedValue;
						var _initSelectedValue = config.initSelectedValue;
						if(_selectedValue){
							cacheOpts.each(function(){
								$(this).removeAttr("selected");
								if($(this).attr("value") == _selectedValue){
									$(this).attr("selected", "selected");
								}
							});
						}else{
							cacheOpts.each(function(){
								$(this).removeAttr("selected");
								if($(this).attr("value") == _initSelectedValue){
									$(this).attr("selected", "selected");
								}
							});
						}
						
						$(this).append(cacheOpts);
					});

					return;
				}
			}
			if(parentValue==null || parentValue!=''){
			dropdowns.each(function(){
				config.onStart($(this));
				$(this).empty();
			});
			
			$.ajax({
			  url: config.url,
			  type: "GET",
			  dataType: "json",
			  data: config.params,
			  complete: function() {
			  	dropdowns.each(function(){
			  		config.onFinish($(this));	
			  	});
			  },
			
			  success: function(data, textStatus) {

			  	dropdowns.each(function(){
				  	if(config.showDefaultOption){
						$("<option/>").attr("value", config.defaultOptionValue).html(config.defaultOptionLabel).appendTo(this);
					}
				  	
				  	var _selectedValue = $(this).attr("selectedValue")!=null?$(this).attr("selectedValue"):config.selectedValue;
					var _initSelectedValue = config.initSelectedValue;

					for ( var k in data) {
						if(!config.reverse){
							optLabel = k;
							optValue = data[k];
						}else{
							optLabel = data[k];
							optValue = k;
						}
						var option = $("<option/>").attr("value", optValue).html(optLabel);
						if(_selectedValue!=null && _selectedValue!=""){
							if(optValue == _selectedValue){
								option.attr("selected", "selected");
							}
						}else{
							if(optValue == _initSelectedValue){
								option.attr("selected", "selected");
							}
						}
						option.appendTo(this);
					}
					
					if(_selectedValue || _initSelectedValue){
						//$(this).attr("selectedValue","");
						$(this).change();
					}
					
					if(parentValue){
						var opts = $(this).children("option");
						if(config.cache){
							dropdowns.data(parentValue, opts);
						}
					}
				});

			  }, 
			
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			  	dropdowns.each(function(){
			  		$("<option/>").html("数据加载失败")
			  		.appendTo($(this));
			  	});
			  }
			  
			});
			}else{
				dropdowns.each(function(){
				  	if(config.showDefaultOption){
						$("<option/>").attr("value", config.defaultOptionValue).html(config.defaultOptionLabel).appendTo(this);
					}
				});
			}
			
			
		};
		if (!config.parentSelector) {
			this.ready(function(){
				fnLoadData(null, dropdowns);
			});
		} else {
			var parentObj = $(config.parentSelector);
			var p_hierachy = parentObj.attr("hierachy");
			if(p_hierachy){
				var t_hierachy = p_hierachy + "," + parentObj.selector;
			}else{
				var t_hierachy = parentObj.selector;
			}
			this.attr("hierachy", t_hierachy);
			
			$(t_hierachy).change(function(){
				dropdowns.each(function(){
					$(this).empty();
				});
			});

			log("attach " + $(this).selector + " to " + parentObj.selector);
			parentObj.change(function(){
				fnLoadData($(this).val(), dropdowns);
			});
		}

		return this;
	};

})(jQuery);