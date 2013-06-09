<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Flot Examples</title>
    
   
    
    <link href="layout.css" rel="stylesheet" type="text/css">
    
     <style type="text/css">
    
      #placeholder{font-family: Arial; font-size: 80%};
    
    
    //.tickLabel { font-size: 80%; font-family:  	Arial };
 
    
    </style>
    
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="<?php echo $this->config->base_url(); ?>javascript/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $this->config->base_url(); ?>javascript/jquery.flot.js"></script>
 </head>

<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}



var count=60;

var counter=setInterval(timer, 1000); //1000 will  run it every 1 second

function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     return;
  }

 document.getElementById("timer").innerHTML=count + " secs"; // watch for spelling
}




//   -->
</script>


<script type="text/javascript">
$(function () {
    
   
    
    
	
	/*
	var d4 = [[0,5], [1,2] , [2,10] ,];
    
    var d6 = [[0,1], [1,5] , [3,10] , ];
    */
    
   
    <?php
    
    echo 'var d4';
    echo ' = ';
    echo '[';
    
    
    foreach($records as $row)
    {
    	
    	echo '[';
    	//echo $row->entry_number;
    	echo ($row->month - 1);
    	echo ',';
    	echo $row->energy_stored;
    	echo ']';
    	echo ',';
    		
    	
    	
    }
    echo ']';
    echo ';';
    
    
    echo 'var d6';
    echo ' = ';
    echo '[';
    
    
    foreach($records as $row)
    {
    	
    	echo '[';
    	//echo $row->entry_number;
    	echo ($row->month - 1);
    	echo ',';
    	echo $row->energy_used;
    	echo ']';
    	echo ',';
    		
    	
    	
    }
    echo ']';
    echo ';';
    
    
  
    
    ?>

    
    
    
    
    $.plot($("#placeholder"), [
        { label: "Watt Generated",  data: d4}
        //{ label: "Kw/H Consumed",  data: d6}
    ], 
    
    {
        series: {
            lines: { show: true },
            points: { show: true }
        },
        
        
      
      <?php
      
           
      ?>
      
      
          xaxis:{
        	ticks: [
        	[0,"Jan/<?php echo $year;?>"] , [1,"Feb/<?php echo $year;?>"], [2,"Mar/<?php echo $year;?>"], [3,"Apr/<?php echo $year;?>"], [4,"May/<?php echo $year;?>"], [5,"Jun/<?php echo $year;?>"], [6,"Jul/<?php echo $year;?>"],
        	[7,"Aug/<?php echo $year;?>"] , [8,"Sep/<?php echo $year;?>"], [9,"Oct/<?php echo $year;?>"], [10,"Nov/<?php echo $year;?>"], [11,"Dec/<?php echo $year;?>"]
        	]
        },
        
     
        
        /*
        yaxis: {
            ticks: 10,
            min: -2,
        
        },
        */
        grid: {
            backgroundColor: { colors: ["#fff", "#eee"] }
        }
    });
});
</script>

 

  <body>









<div class="content">
<div class="pretable">&nbsp;</div>
<div class="usernameform_form">

<Br /><br />

<table border="1">
<tr>
<td>

<?Php

echo form_open('solarview/monthlyview');

foreach($dropyears as $yeararray)
{
	$options[$yeararray] = $yeararray;

}






$shirts_on_sale = array('small', 'large');

echo form_dropdown('yearinput', $options, $yearchosen);
echo '&nbsp;&nbsp;&nbsp;';
echo form_dropdown('monthinput', $dropmonths, $monthchosen);
echo '&nbsp;&nbsp;&nbsp;';
echo form_dropdown('dayinput', $dropdays, $daychosen);
echo '&nbsp;&nbsp;&nbsp;';
echo form_submit('viewchartsort','View Chart');



echo '<div class="leanright">';


echo 'Next Report in <span id="timer"></span>';

echo ' / ';

echo '<span class="wattsaved">';
echo number_format($energytotal,2). ' Watthours Saved';
echo '</span>';



echo '<br />';
echo '<br />';

echo form_close();

?>

    <div id="placeholder" style="width:1000px;height:300px"></div>
    </td>
</tr>
</table>



</div>
</div>





</body>



</html>
</html>
