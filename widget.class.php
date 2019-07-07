<?php 
class Widget{
    public $shipment; // Container for the output
    public  $packs =array(250,500,1000,2000,5000); // The default packs array - this could easily be pulled from a DB. 
    
    function setPacks($input){
        $this->packs = $this->createPackArray($input);
    }
    
    private function createPackArray($input){
        
        if(!isset($input)){ return $this->packs;} // if no array use the defaults. 
        if($input==''){ return $this->packs;} // if it's an empty array use the defaults. 
        
         $packs = array_map('intval', // cast array to integers for sort
                       array_unique(    // Remove duplicate entries from the array
                           explode("\n", // Convert the string to array by new line,
                                   trim($input,"\n"))));  // trim additional new lines
        foreach($packs as $k=>$v){
            if($v==0){ unset($packs[$k]); // Sanitize Array to remove 0's/string entries
                     }
        }
        sort($packs); // Can't assume that they are in numerical order. 
        return($packs);
    }
    
    private function displayResult($result){
        $out ="";
        foreach($result as $pack=>$qty){
            if($qty>1){     // Check to see if multiple packs are equal to 1 larger pack. 
                $total = $pack*$qty; 
                if(in_array($total,$this->packs)){ //is the total in the packs array
                    $qty =1; 
                    $pack = $total;
                }   
            }
            $out .= $qty . "x " . number_format($pack) . "<br>"; // Pretty display for the array.
        }
        echo $out;
    }
    
    function calculateOrder($count){
        if($count < 1){ return  "Invalid Order"; } // LESS THAN THE MIN ORDER of 1. 
                                    
       if(in_array($count,$this->packs)){ // Exact pack size match
             $this->shipment[$count]++;
            return $this->displayResult($this->shipment);
        }
                                    
        // Quantity is less or equal to the smallest pack size
        if($count <= min($this->packs)){  
            $this->shipment[min($this->packs)]++;
            return $this->displayResult($this->shipment);
           
        }  

        // Quantity is between the min and 2nd pack size
    /*    if($count > min($this->packs) && $count < $this->packs[1]){   
             $this->shipment[$this->packs[1]]++;
             return $this->displayResult($this->shipment);
             
        }  */

        // Quantity > than pack size 2. 

        rsort($this->packs); // Reverse the array to start from largest to smallest

        foreach($this->packs as $packsize){  // Loop through pack sizes
           
            if($count >= $packsize){   // If the required quantity bigger or equal to this packsize add it to the shipment.   
              $this->shipment[$packsize]++;  // Add a count to the packsize in the shipment
                $remainingWidgets = $count - $packsize; // Take this packsize away from the quantity required
                     if($remainingWidgets>0){   // if the remainder is more than 0 loop the entire function
                          $this->calculateOrder($remainingWidgets); // Re run the function with the remaining quantity
                    }  else{
                        
                        return $this->displayResult($this->shipment);       // Display the result 
                     }
                break; // Exit the If loop
            }  
        }
    }
    
}
?>