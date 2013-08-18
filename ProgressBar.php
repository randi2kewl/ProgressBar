<?php

/*

The MIT License (MIT)

Copyright (c) 2013 Randi Miller <Randi@randimiller.me>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

class ProgressBar {

      private $bar_length;
      private $total;
      private $start_time = null;

      /*
            Only value needed is the total number of cycles to be completed

            Optional: bar_length is the length of the bar (total number of '=')
      */
      public function __construct($total, $bar_length = 40) { 
	     $this->bar_length = $bar_length;
	     $this->total = $total;
      }

      /*
            Updates the progress bar and meta data

            The only param needed is the number that has been completed
            thus far
      */
      public function update($done) {
            $output = "";

            // Get the current time when running for the first time
            if($this->start_time === null) {
                  $this->start_time = new DateTime();
            }

            // Get the amount of current run time
            $interval = $this->start_time->diff(new DateTime());
            $runtime = $interval->format("%H:%I:%S");

            // Find out the percentage completed
            $percent = $done / $this->total;
            
            // Starting point of the progress bar
            $output .= "\r |";

            // Stop division by zero
            if($percent > 0) {
                  // Calculate the number of blocks that should be shown
                  $blocks = round($percent * $this->bar_length );

                  // Display the progress
                  $output .= str_repeat("=", $blocks) . ">";
                  $output .= str_repeat(" ", ($this->bar_length - $blocks));
                  $output .= "|   ";
            } else {
                  $output .= str_repeat(" ", $this->bar_length) . "|   ";
            }

            // Show some meta data
            $percent = number_format($percent * 100, 2);
            $output .= "{$done}/{$this->total} -- Complete: {$percent}% -- Time: {$runtime}";

            // Yippee! All finished!
            if($percent == 100) {
	           $output .= "\n\nStatus: Complete\n";
                 $output .= "Runtime: {$runtime}\n";
                 $output .= "Total cycles: {$done} \n\n";
            }

            echo $output;
      }
}