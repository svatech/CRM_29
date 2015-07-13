<script type="text/javascript" src="<?php echo base_url(); ?>Highcharts/js/themes/grid.js"></script>
<script type="text/javascript">

var date=<?php echo json_encode($dates)?>;
var sale=<?php echo json_encode($sales)?>;

$(document).ready(function(){
	
	var Nme="DIESEL";
	var Nme1="PETROL";
	var Nme2="2TOIL_LOOSE";
	var chart1= new Highcharts.Chart({
		chart: {
			renderTo: 'container',
            type: 'column',
            height:600
        },
      
      title: {
          text: 'Fuel Sales Report'
          
      },subtitle: {
          text: 'Pricol Fuel & Lube Services'
      },
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f} Ltr</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },xAxis: {
          categories: date
      }, yAxis: {
    	  title: {
              text: 'Sales'
             }
         
                    },
      series: [
               {name: Nme,
            	   data: [<?php echo join($DT_sales, ',') ?>]
     	 		},{
          name: Nme1,
          data: [<?php echo join($sales, ',') ?>]
      },{
          name: Nme2,
          data: [<?php echo join($TT_sales, ',') ?>]
      }],dataLabels: {
          enabled: true,
          rotation: -90,
          color: '#FFFFFF',
          align: 'right',
          x: 4,
          y: 10,
          style: {
              fontSize: '13px',
              fontFamily: 'Verdana, sans-serif',
              textShadow: '0 0 3px black'
          }
      }
     
});
document.getElementById("container").highcharts=chart1;

});
</script>

<div id="container" style="width:100%; height:400px;">Please Reload the page to view the chart</div>
