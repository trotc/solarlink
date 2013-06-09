
    <script language="javascript" type="text/javascript" src="<?php echo $this->config->base_url(); ?>javascript/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $this->config->base_url(); ?>javascript/jquery.flot.js"></script>
<script type="text/javascript">
$(function () {
    
   
    <?php
    
    echo 'var d4';
    echo ' = ';
    echo '[';
       
    foreach($records as $row)
    {
    	
    	echo '[';
    	echo $row->entry_number / 60;
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
    	echo $row->entry_number / 60;
    	echo ',';
    	echo $row->energy_used;
    	echo ']';
    	echo ',';
    		
    	
    	
    }
    
    
    echo ']';
    echo ';';
    
    
  
    
    ?>
        
    
    $.plot($("#placeholder"), [
        { label: "Kw/H Generated",  data: d4}
       // { label: "Kw/H Consumed",  data: d6}
    ], 
    
    {
        series: {
            lines: { show: true },
           // points: { show: true }
        },
        
        
              
        xaxis:{
        	ticks: [
        	[0,"12am"], [1,"1am"], [2,"2am"],[3,"3am"],[4,"4am"],[5,"5am"],[6,"6am"],[7,"7am"],[8,"8am"],[9,"9am"],
        	[10,"10am"], [11,"11am"] , [12,"12pm"] , [13,"1pm"] , [14,"2pm"] , [15, "3pm"], [16,"4pm"] , [17,"5pm"] ,
        	[18, "6pm"] , [19,"7pm"] , [20,"8pm"] , [21,"9pm"] , [22,"10pm"] , [23,"11pm"] , [24,"12am"]
        	]
        },
        
     
        

        
        grid: {
            backgroundColor: { colors: ["#fff", "#eee"] }
        }
    });
});
</script>





<html>
<head>
<title>Key Form</title>
</head>
<body>









<div class="content">
<div class="pretable">&nbsp;</div>
<div class="usernameform_form">

<Br /><br />

<table border="1">
<tr>
<td>

<?Php

echo form_open('solarview/dailyview');

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