<?php get_header(); ?>
<?php
/*
Template Name: projects
*/
?>
<div class="project">
<?php
$argys = array('cat=3', 'posts_per_page' => -1);
$posts = get_posts( $argys );
foreach($posts as $post) :

?>
<?php
$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' =>'any', 'post_parent' => $post->ID ); 
$attachments = get_posts($args);
if ($attachments) {
	foreach ( $attachments as $attachment ) {
		
		$imageName = basename(wp_get_attachment_url( $attachment -> ID));

		if (strpos($imageName,'_Main') !== false) {
			$postID =  $attachment ->ID;
			$imagePath = wp_get_attachment_url( $attachment -> ID);
			$rollPath = str_replace("_Main","_Rollover",$imagePath);
			$projectName = get_the_title($attachment -> ID);
			$name = str_replace("_Main","",$projectName);
			$fullName = str_replace("-"," ",$name);

			echo '<div class="roll">';
			echo "<img class='regular' src='" . $imagePath . "'</img>";
			// echo "<a class='projectTitle' href='test/?id=" . $post -> ID . "'><img class='rollover' src='". $rollPath . "'>" . $fullName . "</img></a>";
			echo "<a class='projectTitle' href='test/?id=" . $post -> ID . "'><img class='rollover' src='". $rollPath . "'></img></a>";
			echo "</div>";
		}
	}
}
?>
<?php endforeach; ?>
</div>
<?php get_footer(); ?> 