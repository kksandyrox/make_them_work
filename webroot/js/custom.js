$(document).ready(function(e) {
    $('.dropify').dropify();

    function createBackgroundColor() {
    	var bgColors = [];
   		for(var i = 0; i < 40 ; i++) {
   			var rgbaString = 'rgba(' + getRandom() + ',' + getRandom() + ',' + getRandom() + ', 0.2)';
   			bgColors.push(rgbaString);
   		}
   		return bgColors;
    }

    function createBorderColor() {
    	var bdColors = [];
   		for(var i = 0; i < 40 ; i++) {
   			var rgbaString = 'rgba(' + getRandom() + ',' + getRandom() + ',' + getRandom() + ', 1)';
   			bdColors.push(rgbaString);
   		}
   		return bdColors;
    }

    function getRandom() {
    	return Math.floor(Math.random() * 255) + 1  
    }

    function getConstituencyLabels() {
    	var result = [];
    	 $.ajax({
	        url: '/potholes/getConstituencyLabels',
	        type: 'get',
	        dataType: 'html',
	        async: false,
	        success: function(data) {
	            result = JSON.parse(data);
	        } 
	     });
	     return result
    }

    function getValues() {
    	var result = [];
    	 $.ajax({
	        url: '/potholes/getValues',
	        type: 'get',
	        dataType: 'html',
	        async: false,
	        success: function(data) {
	            result = JSON.parse(data);
	        } 
	     });
	     return result
    }

    if($("#myChart").length) {
	    var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: getConstituencyLabels(),
		        datasets: [{
		            label: 'Number of Potholes',
		            data: getValues(),
		            backgroundColor: createBackgroundColor(),
		            borderColor: createBorderColor(),
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }],
		           	xAxes: [{
		                ticks: {
		                    autoSkip:false
		                }
		            }]
		        }
		    }
		});
    }


    $("#constituency-filter").on('change', function(e) {
    	window.location.href = "/potholes/dashboard?filter=" + e.target.value;
    });

    $(".verify-now").click(function(e) {
    	var potholeId = $(this).data('pothole-id');
    	var userId = $(this).data('user-id');
    	$("#verify-modal").attr('action', '/potholes/verify-pothole/' + potholeId + '/' + userId);
    });

});
