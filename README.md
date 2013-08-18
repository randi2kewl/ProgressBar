PHP ProgressBar
==============

*Current implementation is for PHP only. Other languages to come (feel free to contribute).*

This is a CLI progress bar to tell you how far along you are when going through a large set of date.

Great for multiple database queries. Just get the total number from the number of rows returned.

Getting Started
===============

Include the class into your script.

        include 'ProgressBar.php';

Then instantiate the instance with the total number of cycles to run.

        $progress_bar = new ProgressBar($total_cycles);

Finally, call the update method which updates the progress bar with the total completed so far.

        $progress_bar->update($total_done);


