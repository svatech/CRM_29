<script type="text/javascript" >


var emp=<?php echo json_encode($employee)?>;
$(document).ready(function(){
	
	var Nme="OT Hours";
	var chart1= new Highcharts.Chart({
		chart: {
			renderTo: 'container',
            type: 'bar'
        },
      
      title: {
          text: 'Employees OT Summary'
      },subtitle: {
          text: 'Preipolar'
      },xAxis: {
          categories: emp
      }, yAxis: {
          title: {
              text: 'OT Field'
          }
      },
      series: [{
    	  name: Nme,
    	  data: [<?php echo join($result, ',') ?>]
      }]
});
document.getElementById("container").highcharts=chart1;

});

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>Highcharts/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Highcharts/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Highcharts/js/themes/gray.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/chart.js"></script>
<h2></h2>
<br>

<div id="container" style="width:100%; height:400px;"></div>