<?php get_header(); ?>
<?php  
/*
	Template Name: newProjects
*/
?>
<!-- Load home -->

<div class="projectContent" id="home" style="width:100%" >
  <div class="absolute-center">
    <div class="center-container">
<center><img id="homeLogo" src="../wp-content/themes/ata/LOGO.jpg"></center>
</div>
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
		echo '<div class="arrowDown"></div>';
        $imageName = basename(wp_get_attachment_url( $image -> ID));
		$link = wp_get_attachment_url($image->ID);
	    $full = "'" . $link . "'"; 
		echo '<a class="lightbox_trigger" href="' . $link . '">';
		echo '<img class="lazy" src="loader.gif" data-original="' . $link . '" id="" title="" alt=""/>';
		echo '</a>';
	}
	
	echo '<div class="projectText"><div class="textHolder">' . get_field('project_text') . '</div></div>';
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
<div class="indexSortMenu">
Sort By<br>
<a href="javascript:sortProject()">PROJECT</a><br>
<a href="javascript:sortDate()">DATE</a><br>
<a href="javascript:sortLocation()">LOCATION</a><br>
<a href="javascript:sortCategory()">CATEGORY</a><br>
<a href="javascript:sortStatus()">STATUS</a><br>
</div>
<div class="indexBlock">
<div id="indexCont" class="indexContainer">

<?php
    $argys = array('category' => '4', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order ID');
	$posts = get_posts( $argys );
	$currentIndex = 0;
	$firstPost = true; 
	$idTest = 100;
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
		if(strpos(get_field('location'), ', UK') !== FALSE)
		{
			$isUK = false;
		}
		else
		{
			$isUK = true;
		}
		$icon = get_field('icon');
		$icon_rollover = get_field('icon_rollover');
		//echo '<div id="'. $postId . '_th"  class="indexProjectBox">';
		
		echo '<div id="'. $postId . '"  class="indexProjectBox" data-yearstarted="' .  get_field('year_started') . '" data-yearcompleted="' .  get_field('year_completed') . '" data-category="' .  get_field('category') . '" data-status="' .  get_field('status') . '" data-location="' .  get_field('location') . '" data-uk="' .  $isUK . '">';
		echo "<a class=\"indexProjectBoxImgLink\"  href=\"javascript:loadProject('" . $postId . "', 'index')\">";
		echo '<div class="indexProjectBoxImgHolder" style="background-image: url(' . $icon_rollover['url'] . ')">'; 
		echo "<img src='" . $icon['url'] . "'><br>";
		echo "</div></a>";
		echo strtoupper(get_field('project_title')) . "<br>";
		if(get_field('year_completed') == '0')
		{
			echo get_field('year_started') . "<br>";
		}
		else
		{
			echo get_field('year_started') . " - " . get_field('year_completed') . "<br>";
		}
		echo get_field('category') . "<br>";
		echo get_field('location') . "<br>";
		echo get_field('description') . "<br>";
		echo get_field('status') . "<br>";
	$idTest = $idTest - 1;
	echo '</div>';
	endforeach; 
	
	?>
</div>
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