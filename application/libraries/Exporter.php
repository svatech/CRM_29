<?php
/* 
 * Allow User to download data in CSV or XSL Format
 * 
 */

class Exporter{


  var $CI;      
              
        public function Export($type,$query){
        
        	$this->CI =& get_instance();
        	$resource=$this->CI->db->query($query)->result_array();
   
      
         if($type=='csv'){
          $v=0;
          $str="";
          while($line=mysql_fetch_array($resource)){

              if($v==0){// getfields names only once
                  $fieldNames=array_keys($line);
                  for($i=0;$i<count($fieldNames);$i++){
                   $str.="\"".$fieldNames[$i]."\",";   // include the column names
                  }
                  $str=substr($str,0,-1);
                   $str.="\r\n";
                  $v=1;
              }

              for($i=0;$i<count($fieldNames);$i++){
              $str.="\"".$line[$fieldNames[$i]]."\","; // create the field values
              }

             $str=substr($str,0,-1);
             $str.="\r\n";             
          }

             header("Content-type: application/csv");
             header("Content-Disposition: attachment; filename=".date('dmY')."_snohistory.csv");
             echo $str;
            

        }
        else{
                                                    // save as an Xls file
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".date('dmY')."_snohistory.xls");
            print("<table border='1' align='center'><tr><td align='center' colspan='5'><b>Serial No History on ".date('d_m_Y_His')."</b></td></tr></table>");
        	$v=0;
        	$str="<table border='1'>";
        	$str.="<tr >";
            //while($line=mysql_fetch_array($resource)){
            foreach ($resource as $line){
            if($v==0){                        // getfields names only once
                  $fieldNames=array_keys($line);
                  for($i=0;$i<count($fieldNames);$i++){
                   $str.="<th style='color: white; background-color: #3090C7; font-size:10pt'>".$fieldNames[$i]."</th>";   // include the column names
                  }
                  $v=1;
               }
              $str.="</tr>";
              
              for($i=0;$i<count($fieldNames);$i++){
              $str.="<td style='background: #eeeeee; color: #07c;font-size: 15px;'>".$line[$fieldNames[$i]]."</td>"; // create the field values
              }

              $str.="</tr>";
  
            }
       
        echo $str;
        }


        }
}

?>
