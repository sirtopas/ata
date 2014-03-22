<?php get_header(); ?>
<?php  
/*
	Template Name: newProjects
*/
?>
<!-- Load home -->

<div class="projectContent" id="home" style="width:100%" >
<div class="homeContainer">
<center><img src="../wp-content/themes/ata/LOGO.jpg"></center>


</div>
</div>
<?php 
	echo '<div class="rightArrow" id="Rhome" onclick="loadProjects()"></div>';
?>
<!-- Load all projects -->
<?php
	$argys = array('category' => '4', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order ID');
	$posts = get_posts( $argys );
	$currentIndex = 0;
	$firstPost = true;
	foreach($posts as $post) :
		$postName = $post -> ID;
		$previous = $posts[$currentIndex - 1];
		$next = $posts[$currentIndex + 1];
		$thisPost = "'" . $postName . "'";
		$nextPost = "'" . $next -> ID  . "'";
		$prevPost = "'" . $previous -> ID . "'"; 
		$currentPost = "'" . $postName . "'";
		$currentIndex = $currentIndex + 1;
		
		setup_postdata($post);

		$content = get_the_content();
		$content = preg_replace('/(<)([img])(\w+)([^>]*>)/', '', $content);
		$content = preg_replace("/<a href=.*?>(.*?)<\/a>/","",$content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		$content = str_replace('<p>&nbsp;</p>', '', $content);
		$content = preg_replace("/<p[^>]*><\\/p[^>]*>/", '', $content); 
		$content = preg_replace("#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#", '', $content); 
		
		$frames = explode("-slide-", trim($content));
		if($firstPost == true)
		{
			echo '<div class="leftArrow" id="L'. $postName . '" onclick="loadProject(' . "'home'" . ',' . $thisPost . ')"></div>';
			$firstPost = false;
		}
		else
		{
			echo '<div class="leftArrow" id="L'. $postName . '" onclick="loadProject(' . $prevPost . ',' . $thisPost . ')"></div>';
		}
		if($nextPost != "''") 
		{
			echo '<div class="rightArrow" id="R'. $postName . '" onclick="loadProject(' . $nextPost . ',' . $thisPost . ')"></div>';
		}
		else
		{
			echo '<div class="rightArrow" id="R'. $postName . '" onclick="loadContact()"></div>';
			$finalPost = $thisPost;
		}
		
		echo '<div class="newProject">';
		echo '<div class="projectContent" id="'. $postName . '" style="width:100%" >';

//Load all images for each project
		$gallery = get_children( 'posts_per_page=-1&order=asc&post_type=attachment&post_mime_type=image&post_parent=' . $post -> ID);
		$attr = array(
    		'class' => "attachment-$size wp-post-image",
		);


	foreach( $gallery as $image ) 
	{
        $imageName = basename(wp_get_attachment_url( $image -> ID));
    	if (strpos($imageName,'_Main') == false) 
    	{
      		if (strpos($imageName,'_Rollover') == false) 
      		{
  				$link = wp_get_attachment_url($image->ID);
  			    $full = "'" . $link . "'"; 
				echo '<a class="lightbox_trigger" href="' . $link . '">';
				echo '<img class="lazy" src="loader.gif" data-original="' . $link . '" id="" title="" alt=""/>';
				echo '</a>';
   			}
		}
	}

	foreach ($frames as $textItem) 
	{
		$tmpTextItem = $textItem;
		$tmpTextItem = str_replace("<p>","",$tmpTextItem);
		$tmpTextItem = str_replace("</p>","",$tmpTextItem);
		$tmpTextItem = str_replace("<a>","",$tmpTextItem);
		$tmpTextItem = str_replace("</a>","",$tmpTextItem);
		$tmpTextItem = str_replace(" ","",$tmpTextItem);
		$tmpTextItem = trim($tmpTextItem);
	
		if (strlen($tmpTextItem) > 3)
		{
		
			echo '<div class="projectText"><div class="textHolder">' . $textItem . '</div></div>';
			echo '';
		}
	}

	echo '</div>';
	echo '</div>';
	endforeach; 
	echo '<div class="projectFooter"></div>';
?>

<!-- Load contact information -->
<?php
	echo '<div class="leftArrow" id="Lcontact" onclick="loadProject(' . $finalPost . ',\'contact\')"></div>';
	echo '<div class="rightArrow" id="Rcontact" onclick="loadNews()"></div>';
?>

<div class="projectContent" id="contact" style="width:100%" >
<div class="contactItem">

<?php 
$argys = array('category' => '2', 'posts_per_page' => 1);
	$posts = get_posts( $argys );
	foreach ( $posts as $post ) 
	{
		setup_postdata($post);
		the_content();
	}
?>

</div>
</div>

<!-- Load news information -->
<?php 
	echo '<div class="leftArrow" id="Lnews" onclick="loadContact()"></div>';
?>

<div class="projectContent" id="news" style="width:100%" >
<div class="newsContainer">

<?php $myposts = get_posts('cat=3&posts_per_page=-1'); // cat 2: news
	foreach($myposts as $post) :
		setup_postdata($post);
?>

<div class="spacer">
<div class="newsItem">

<div class="postDate">
	<b><?php the_time('Y') ?></b>
</div>

<?php the_content(); ?>
</div>
</div>
<?php endforeach; wp_reset_postdata(); ?>
</div>
</div>
<?php 
	echo '<div class="rightArrow" id="Rnews" onclick="loadIndex()"></div>';
?>

<!-- Load index -->
<?php 
	echo '<div class="leftArrow" id="Lindex" onclick="loadNews()"></div>';
?>
<div class="projectContent" id="index" style="width:100%" >
<div class="indexContainer">

<?php
    $argys = array('category' => '4', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order ID');
	$posts = get_posts( $argys );
	$currentIndex = 0;
	$firstPost = true;
	foreach($posts as $post) :
		$postId = $post -> ID;
		setup_postdata($post);
		$content = get_the_content();
		$content = preg_replace('/(<)([img])(\w+)([^>]*>)/', '', $content);
		$content = preg_replace("/<a href=.*?>(.*?)<\/a>/","",$content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		$content = str_replace('<p>&nbsp;</p>', '', $content);
		$content = preg_replace("/<p[^>]*><\\/p[^>]*>/", '', $content); 
		$content = preg_replace("#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#", '', $content); 
		
		$icon = get_field('icon');
		$icon_rollover = get_field('icon_rollover');
		echo '<div id="'. $postId . '_th"  class="indexProjectBox">';
		echo '<div class="indexProjectBoxImgHolder" style="background-image: url(' . $icon_rollover['url'] . ')">'; 
		echo "<img src='" . $icon['url'] . "'><br>";
		echo "</div>";
		echo strtoupper(the_field('project_title')) . "<br>";
		echo the_field('year_started') . "<br>";
		echo the_field('category') . "<br>";
		echo the_field('location') . "<br>";
		echo the_field('description') . "<br>";
		echo the_field('status') . "<br>";

	echo '</div>';
	endforeach; 
	
	?>
</div>
</div>
<div class = "testMenu">
	<ul class="nav">
		<li><a id="homeLink" class="active" href="javascript:loadHome();">Home</a></li>
		<li><a id="projectsLink" class="inactive" href="javascript:loadProjects();">Projects</a></li>
		<li><a id="contactLink" class="inactive" href="javascript:loadContact();">Office</a></li>
		<li><a id="indexLink" class="inactive" href="javascript:loadIndex();">Index</a></li>
	</ul>
</div>
<?php get_footer(); ?>