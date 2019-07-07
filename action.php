<?php
require 'widget.class.php';

$widget = new Widget;
if(isset($_GET['packsizes'])){
    $widget->setPacks($_GET['packsizes']);
}

if($_GET['action']=='Add Order'){
     if(isset($_GET['widgetCount'])){ //Check the widget count is set. 
         if($_GET['widgetCount']>0){  // Process if quantity > 0. 
         
            // output the row for the display    
              echo  "<tr><td  class='text-center'>" .  htmlentities($_GET['ordernumber']) . "</td>
              <td>" .  htmlentities($_GET['customerName']) . "</td>
              <td  class='text-center'>" . number_format(htmlentities($_GET['widgetCount'])). "</td>
              <td  class='text-center'>";  
              $widget->calculateOrder(htmlentities($_GET['widgetCount'])); // Calculate the order size
              echo "</td></tr>";// output the row for the display
         } else{
                // Throw error - no quantity.
                echo "<tr class='alert'><td colspan='4' class='text-center'><strong>INVALID ORDER #" .  htmlentities($_GET['ordernumber']) . " - <em>No Quantity</em></strong></td></tr>"; 
                
            }
     }
}
?>
