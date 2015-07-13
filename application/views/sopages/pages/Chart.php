
<script type="text/javascript" src="<?php echo base_url(); ?>Highcharts/js/themes/sand-signika.js"></script>
<script type="text/javascript">
var emp=<?php echo json_encode($employee)?>;
var res=<?php echo json_encode($result)?>;
$(document).ready(function(){
	
	var Nme="Sales in Rupees";
	var chart1= new Highcharts.Chart({
		chart: {
			renderTo: 'container',
            type: 'column',
            height:600
        },
      
      title: {
          text: 'Sales Report'
          
      },subtitle: {
    	  text: 'Pricol Fuel & Lube Services'
      },
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f} Rs</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },xAxis: {
          categories: res
      }, yAxis: {
          title: {
              text: 'Sales'
             }
      },
      series: [{
    	
    	  name: "Sales",
    	  data: [<?php echo join($employee, ',') ?>]
     
     
      }]
});
document.getElementById("container").highcharts=chart1;

});
</script>

<div id="container" style="width:100%; height:400px;">Please Reload the page to view the chart</div>
