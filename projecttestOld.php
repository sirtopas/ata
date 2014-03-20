<?php
/*
Template Name: test
*/
?>
<?php
$type = 'c';
$imagesDir = '/wp-content/themes/ata/images/';
echo $imagesDir;
$images = glob($imagesDir . $type . '*[TYPE].{jpg,jpeg,png,gif}', GLOB_BRACE);
print_r(glob("images/*.*"));
?>
<ul>
<?php foreach($images as $image): ?>
   <li>here 
   	<?php echo $image; ?>
   	<a href="<?php echo str_replace('[TYPE]', 'F', $image); ?>"><img src="<?php echo str_replace('[TYPE]', 'T', $image); ?></a>" alt="" /></li>
<?php endforeach; ?>
</ul>

<?php

if ($handle = opendir('http://firststrikecomputing.co.uk/images')) {
    echo "Directory handle: $handle\n";
    echo "Entries:\n";

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        echo "$entry\n";
    }

    /* This is the WRONG way to loop over the directory. */
    while ($entry = readdir($handle)) {
        echo "$entry\n";
    }

    closedir($handle);
}
?>
<?php
$files = scandir('http://www.firststrikecomputing.co.uk/images/');
foreach($files as $file) {
   	echo $file;
	echo str_replace('[TYPE]', 'F', $image); 
	// <li>echo str_replace('[TYPE]', 'F', $image); </li>
}
?>