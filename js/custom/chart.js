/**
 * 
 */
var Nme="OT Hours";

var arry1=[1, 3, 4,8];
var arry2=[3,5,7,8];
var Employee_array=[];
var OT_det_array=[];
function fetch_chart()
{
	
	 $.post(site_url+"/testing/fetch_chart_details",function(data){
		 $("#contentData").html("");
			$("#contentData").append(data);
	 });
			/* var Details=data.split("^");
			  var Employee=Details[0];
			  var OT=Details[1];
			  var i,j;
			  var Emp= Employee.split("&");
			 Employee_array.length=Emp.length;
			  for(i=0;i<Emp.length;i++)
				  {
				  Employee_array[i]=Emp[i];
				  }
			 var OT_det=OT.split("!");
			 OT_det_array.length=OT_det.length;
			 for(j=0;j<OT_det.length;j++)
			  {
				 OT_det_array[j]=OT_det[j];
			  }
			
		  
	
	 
	var chart1 = new Highcharts.Chart({
		 
	        chart: {
	            type: 'column'
	        },chart: {
	            renderTo: 'container'
	        },
	        title: {
	            text: 'Employees OT Summary',
	            style:{color:"#FFFFFF",fontsize:"18px",fontweight:"bold"}
	        },subtitle: {
	            text: 'Preipolar'
	        },
	        xAxis: {
	            categories: Employee_array
	        },
	        yAxis: {
	            title: {
	                text: 'OT Field'
	               
	            }
	        },
	        series: [{
	            name: Nme,
	            data:arry1
	           
	        }]
	    });	
		document.getElementById("container").highcharts=chart1;*/
}
$( window ).load(function () { 
   //alert("Loading");
   
});
