
    
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="<?php echo $this->config->base_url(); ?>javascript/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $this->config->base_url(); ?>javascript/jquery.flot.js"></script>
 </head>

  


<script type="text/javascript">
$(function () {
    
  <?php
    
    echo 'var d4';
    echo ' = ';
    echo '[';
    
    
    foreach($records as $row)
    {
    	
    	echo '[';
    	//echo $row->entry_number;
    	echo ($row->day - 1);
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
    	echo ($row->day - 1);
    	echo ',';
    	echo $row->energy_used;
    	echo ']';
    	echo ',';
    		
    	
    	
    }
    echo ']';
    echo ';';
    
    
  
    
    ?>

    
    
    
	/*
	
	var d4 = [[0,5], [1,2] , [2,10] , [3,4], [8,6] , [10.3,5] , [11,3] , [29,2]];
    
    var d6 = [[0,1], [1,5] , [3,10] , [4,5], [5,6] , [6,7]];
    */
    
    
    
    
    $.plot($("#placeholder"), [
        { label: "Kw/H Generated",  data: d4}
       // { label: "Kw/H Consumed",  data: d6}
    ], 
    
    {
        series: {
            lines: { show: true },
            points: { show: true }
        },
        
        
            
        <?php
        
        echo 'xaxis:{';
        echo 'ticks:[';
        
        
        //$data['days'];
        
        
        
        for($i=0;$i<$days;$i++)
        {
        	echo ' [';
        	echo $i;
        	echo ',';
        	echo '"';
        	echo $month;
        	echo '/';
        	echo $i+1;
        	echo '"';
        	echo ']';
        	if($i<$days-1)
        	{
        	echo ',';
        	}
        	
        }
        
        echo ']';
        
        
      
        
        /*
        echo '[0,"12/1"], [1,"12/2"], [2, "12/3"], [3,"12/4"], [4,"12/5"], [5,"12/6"], [6,"12/7"] , [7,"12/8"],
        	[8,"12/9"], [9,"12/10"] , [10,"12/11"] , [11,"12/12"] , [12,"12/13"], [13,"12/14"], [14,"12/15"], [15,"12/16"],
        	[16,"12/17"], [17,"12/18"], [18,"12/19"], [19,"12/20"], [20,"12/21"], [21,"12/22"], [22,"12/23"], [23,"12/24"], [24,"12/25"],
        	[25,"12/26"], [26,"12/27"], [27,"12/28"], [28,"12/29"], [29,"12/30"], [30,"12/31"]
        	]';
        */
        
        
        
  
        
        echo '},';
        
        
        
        
        ?>
     
        
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