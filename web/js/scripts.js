
jQuery(document).ready(function() {
	
    $('#submit-button').on('click', function() {
    	$('#confirm').modal('hide');
    });

    $('#members-type_document').on('change', function() {
		var type = $(this);
		if(type.val()=='pasport') {
			$('#members-series').attr("placeholder", "AA");
			$('#members-series').attr("maxlength", "2");
		}else if(type.val()=='certificate'){
			$('#members-series').attr("placeholder", "T-IV");
			$('#members-series').attr("maxlength", "4");
		}
	});	
    $('#members-type_member').on('change', function() {
		var type = $(this);
		if (type.val()=='pupil') {
			$('#organization-div').css('display','block');
			$('#workplace-div').css('display','none');
			$('#degre-div').css('display','none');
			$('#course-div').css('display','block');
			$('#org_region_id-div').css('display','block');
			$('#org_district_id-div').css('display','block');
			$('#org_region_id-div').attr('class', 'col-md-4');			
		}else if(type.val()=='student-kollej'){
			$('#organization-div').css('display','block');
			$('#workplace-div').css('display','none');
			$('#degre-div').css('display','none');
			$('#course-div').css('display','block');
			$('#org_region_id-div').css('display','block');
			$('#org_district_id-div').css('display','none');
			$('#org_region_id-div').attr('class', 'col-md-3');		
		}else if(type.val()=='student'){
			$('#organization-div').css('display','block');
			$('#workplace-div').css('display','none');
			$('#degre-div').css('display','block');
			$('#course-div').css('display','block');
			$('#org_region_id-div').css('display','none');
			$('#org_district_id-div').css('display','none');
			$('#org_region_id-div').attr('class', 'col-md-4');			
		}else if(type.val()=='worker'){
			$('#organization-div').css('display','none');
			$('#workplace-div').css('display','block');
			$('#degre-div').css('display','none');
			$('#course-div').css('display','none');
			$('#org_region_id-div').css('display','none');
			$('#org_district_id-div').css('display','none');
		}else if(type.val()=='jobless'){
			$('#organization-div').css('display','none');
			$('#workplace-div').css('display','none');
			$('#degre-div').css('display','none');
			$('#course-div').css('display','none');
			$('#org_region_id-div').css('display','none');
			$('#org_district_id-div').css('display','none');
		}
	});	
	$("#members-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    /*
        Fullscreen background
    */
    $.backstretch("/img/backgrounds/1.jpg");
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    

	
    
    
});
