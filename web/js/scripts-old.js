$(function() {
	
	$('#operations-type_pay').on('change', function() {
		
		var type = $(this);

		if (type.val()=='cash') {
			$('.bwt_div').css('display','none');
			$('.cash_div').css('display','block');
			$('.all_sum_div').css('display','block');
			$('#operations-sum').removeAttr("disabled");
		}
		else{
			$('#operations-sum').attr('disabled','true');
			$('#operations-real_sum').removeAttr("disabled");
			$('.bwt_div').css('display','block');
			$('.cash_div').css('display','none');
			$('.all_sum_div').css('display','none');
		}
		
	});	
	$('#operations-diller_id,#operations-valuta').on('change', function() {
		var diller = $('#operations-diller_id').find(':selected');
		var valuta = $('#operations-valuta').find(':selected');
		var diller_valuta = $('#operations-diller_id').find(':selected').data('valuta');
		if(diller.val()!="" && valuta.val() != ""){
			if(diller_valuta == valuta.val())
				$('#operations-convert').prop('checked', false);
			else
				$('#operations-convert').prop('checked', true);
		}
		
	});	
	$('.percent_change').on('input', function() {
		var sum = $('#operations-sum');
		var percent = $('#operations-percent');
		var real_sum = $('#operations-real_sum');
		var type = $('#operations-type_pay');
		var convert_sum = $('#operations-convert_sum');
		var convert_all_sum = $('#operations-convert_all_sum');
		var course_id = $('#operations-course_id');
		//var convert = $('#operations-convert');
		var valuta = $('#operations-valuta').find(':selected');
		var bonus = $('#operations-bonus');
		var bonus_percent = $('#operations-bonus_percent');
		var all_sum = $('#operations-all_sum');
		var bonus_val;
		var bonus_procent = 0;
		var convert_value;
		var sum_value;

		if (type.val()=='cash') {
			if(sum.val()!=''){
				if(valuta.val()!=""){
					
					if(valuta.val()=="sum"){
						sum_value = Math.round(sum.val() * 100 / course_id.val() ) / 100;
					}else{
						sum_value = sum.val();
					}
					$.ajax({
						'type':'POST',
						'success':function(data) {
							var convert_sum_value;
							
							bonus_percent.val(data);
							bonus_val = Math.round(((sum_value/0.85 + sum_value * Number(data) / 100) - sum_value) * 100) / 100;
							bonus.val(bonus_val);
							convert_sum_value =  Math.round((Number(bonus_val) + Number(sum_value)) * 100) / 100;
							all_sum.val(convert_sum_value);

							if(valuta.val()=="dollar"){
								convert_all_sum.val( Math.round(convert_sum_value * course_id.val() * 100 ) / 100 );
								convert_sum.val( Math.round(sum_value * course_id.val() * 100 ) / 100 );
							}else if(valuta.val()=="sum"){
								convert_all_sum.val( convert_sum_value );
								convert_sum.val( sum_value );
							}
						},
						'error':function(r) {
							//progress.hide();
							console.log(r);
						},
						'url':'/bonus-limit/get-procent?sum='+sum_value,
						'cache':false,
						//'data':'id='+diller+'&type='+type
						//'data': products
					});
				}

				if(percent.val() != ''){
					real_sum.val( Math.round(sum.val() * 10000 / percent.val() ) / 100);
				}			
				
			}
		}
		else{
			if(real_sum.val()!=''){
				if(percent.val() != '')
					sum.val( Math.round(real_sum.val() * percent.val() ) / 100);

				if(valuta.val()!="" && valuta.val()=="dollar"){
					convert_sum.val( Math.round(sum.val() * course_id.val() * 100) / 100 );
				}else if(valuta.val()!="" && valuta.val()=="sum"){
					convert_sum.val( Math.round(sum.val() * 100 / course_id.val()) / 100 );
				}
			}
		}

	});

	$('#productprices-dollar').on('input', function() {
		
		var course = $('#course').val();
		var sum =  $('#productprices-sum');
		var dollar =  $('#productprices-dollar');
		
		sum.val(Math.round((course * dollar.val() * 100 )) / 100);
	});

	$('#productprices-sum').on('input', function() {
		
		var course = $('#course').val();
		var sum =  $('#productprices-sum');
		var dollar =  $('#productprices-dollar');
		
		dollar.val(Math.round(( sum.val() * 100 / course)) / 100);
	});


	$('#dillersales-balance').on('input', function() {
		var product = $('#dillersales-product_id').find(':selected');
		var balance =  $('#dillersales-balance');
		var count =  $('#dillersales-count');
		if(product.val()!=''){
			count.val(product.data('count') - balance.val());
		}
	});

	$('#dillersales-count').on('input', function() {
		
		var product = $('#dillersales-product_id').find(':selected');
		var balance =  $('#dillersales-balance');
		var count =  $('#dillersales-count');
		
		if(product.val()!=''){
			balance.val(product.data('count') - count.val());
		}
	});

	// sotuv qismi
	$('.handle_object').on('change', function() {
		var diller = $('#transactions-diller_id').find(':selected').val();

		//var type = $('#transactions-type_pay').val();
		var type = $('input[type=radio]:checked', '#transactions-type_pay').val();
		
	    var fullProducts = $('.count_input').filter(function() { return this.value != ""; });
	    
	    var products = {};
	    fullProducts.each(function() {
	    	products[this.id] = this.value;
	    });

		if(diller == '') {
			alert('Пожалйста, Заполняете все поле!');
		} else {
			//progress.show();
			$.ajax({
				'type':'POST',
				'success':function(data) {
					//progress.hide();
					//console.log(r);
					$('.products_div').html(data)
				},
				'error':function(r) {
					//progress.hide();
					console.log(r);
				},
				'url':'/transactions/get-products?id='+diller+'&type='+type,
				'cache':false,
				//'data':'id='+diller+'&type='+type
				'data': products
			});
		}
	});

	$('body').on('input','.count_input', function() {
		
		var count = $(this).val();
		var id = $(this).data('id');
		var price = $('#product_price_'+id).val();
		var total = $('#product_total_'+id);
		var total_sum;
		if (price != '' && count != '') {
			total_sum = Math.round((price * count * 100 )) / 100
			total.val(total_sum);
		}else{
			total.val('');
		}
	});
	function number_format(number, decimals, dec_point, thousands_sep) {
	  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	  var n = !isFinite(+number) ? 0 : +number,
	    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	    s = '',
	    toFixedFix = function(n, prec) {
	      var k = Math.pow(10, prec);
	      return '' + (Math.round(n * k) / k)
	        .toFixed(prec);
	    };
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
	    .split('.');
	  if (s[0].length > 3) {
	    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '')
	    .length < prec) {
	    s[1] = s[1] || '';
	    s[1] += new Array(prec - s[1].length + 1)
	      .join('0');
	  }
	  return s.join(dec);
	}
	$('#summa').on('click', function() {
		var sum = 0;
		var aggreement_sum = 0;
		var aggreement = $('#transactions-aggreement_id').find(':selected').val();
		var	aggreementArray = aggreement.split("@");

		var diller = $('#transactions-diller_id').find(':selected');
	    

	    $('.total_input').each(function() {
	        sum += Number($(this).val());
	    });	    
		$('#sum_td').html( number_format(sum, 2, '.', ' '));

		if(diller.data('valuta')=='dollar'){
	    	sum = Number(sum) * Number(aggreementArray[3]);
	    }
	    aggreement_sum = Number(aggreementArray[1]) + Number(sum);
	    
	    $('#sum_trn').html('Transaction sum: ' + number_format(sum, 2, '.', ' '));
	    $('#sum_total_agg').html('Total Agg.Sum: ' + number_format(aggreement_sum, 2, '.', ' '));
	    $('#sum_agg').html('Aggreement Sum: ' + number_format(aggreementArray[2], 2, '.', ' '));
	    $("#aggreement_tr").removeClass('error_aggrement');
	    if(Number(aggreement_sum) > Number(aggreementArray[2])){
	    	$("#aggreement_tr").addClass("error_aggrement");
	    }
	});

	/*$('.handle_input').on('change', function() {
		var diller = $('#transactions-diller_id').find(':selected');
		var warehouse = $('#sales-warehouse_id').find(':selected');
		var product = $('#sales-product_id').find(':selected');
		var formula = $('#sales-formula_id').find(':selected');
		var price = $('#sales-price');
		var count = $('#sales-count');
		var total_sum = $('#sales-total_sum');

		var priceValue = 0;
		
		if(diller.val() != '' && warehouse.val() != '' && diller.val() != undefined && product.text() != ''){

			var productArray = product.val().split('@');
			if(diller.data('valuta') == 'dollar'){
				priceValue = productArray[2];
			}
			else{
				priceValue = productArray[3];
			}
			
			if(formula.val() != ''){
				var formulaArray = formula.val().split('@');
				var fixed = 0;
				if(diller.data('valuta') == 'dollar') fixed = formulaArray[2];
				else fixed = formulaArray[3];
				priceValue = parseFloat(priceValue) + parseFloat(priceValue) * parseFloat(formulaArray[1])/100 + parseFloat(fixed);
			}
			priceValue = Math.round((priceValue * 100 )) / 100;

			if(count.val() != ''){
				total_sum.val(count.val() * priceValue);
			}

			price.val(Math.round((priceValue * 100 )) / 100);

		}

	});
	*/
	

	$("body").on("hidden.bs.modal",'.modal', function() {
		$(this).removeData("modal");
	});
	

	$('body').on('click','[data-get]',function() {
		if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;
		var th = this, afterDelete = function(){};
		jQuery('#operations-grid').yiiGridView('update', {
			type: 'POST',
			url: jQuery(this).attr('href'),
			success: function(data) {
				jQuery('#operations-grid').yiiGridView('update');
				afterDelete(th, true, data);
			},
			error: function(XHR) {
				return afterDelete(th, false, XHR);
			}
		});
		return false;
	});
});