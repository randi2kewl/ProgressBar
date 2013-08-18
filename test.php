<?php

include 'ProgressBar.php';

$progress = new ProgressBar(20, 20);

for($i = 0; $i <= 20; $i++) {
       $progress->update($i);
       sleep(1);
}