
<?php
// outputs e.g.  somefile.txt was last modified: December 29 2002 22:16:23.

$filename = $_GET['file'];
if (file_exists($filename)) {
    echo date ("F d, Y", filemtime($filename));
}
?>
