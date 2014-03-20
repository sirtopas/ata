<?php get_header(); ?>

<?php
/*
Template Name: projectsH
*/
?>
<ul class="images">

<?php
	$argys = array('cat=3', 'posts_per_page' => -1);
	$posts = get_posts( $argys );
	
	foreach($posts as $post){
		$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' =>'any', 'post_parent' => $post->ID ); 
		$attachments = get_posts($args);
		
		if ($attachments) {
			
			foreach ( $attachments as $attachment ) {
				$postID =  $attachment ->ID;
				$imagePath = wp_get_attachment_url( $attachment -> ID);
						$imageName = basename(wp_get_attachment_url( $attachment -> ID));

				// echo '<li><img src="' . $imagePath . '" width="300px" height="300px"></img></li>';
						if (strpos($imageName,'_Main') !== false) {
			$rollPath = str_replace("_Main","_Rollover",$imagePath);
			$projectName = get_the_title($attachment -> ID);
			$name = str_replace("_Main","",$projectName);
			$fullName = str_replace("-"," ",$name);
			// echo '<span class="roll">';
			// 	echo '<li><img class="regular" src="' . $imagePath . '" width="80%" height="80%"></img></li>';
			// // echo "<a class='projectTitle' href='test/?id=" . $post -> ID . "'><img class='rollover' src='". $rollPath . "'>" . $fullName . "</img></a>";
			// 	echo "<a href='test/?id=" . $post -> ID . "'><li><img class='rollover' src='". $rollPath . "' width='80%' height='80%'></img></li></a>";
			// echo "</span>";
			// echo '<a href="test/?id=' . $post -> ID . '"><li><img src="' . $imagePath . '" alt="" class="button" onmouseover="changeImage("' . $imagePath . '","' . $rollPath . '")" /></li>';
			echo '<li class="images"><a href="test/?id=' . $post -> ID . '"><img src="' . $imagePath . '" alt="" class="projectImage" onmouseover="this.src=\'' . $rollPath . '\'" onmouseout="this.src=\'' . $imagePath . '\'"/></a></li>';
		}
			}
		}
	}
?>

</ul>