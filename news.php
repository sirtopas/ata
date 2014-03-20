<?php get_header(); ?>
<?php
/*
Template Name: news
*/
?>
<div class="leftArrow" style="display:inline" onclick="javascript:location.href='http://www.firststrikecomputing.co.uk/blog/contact/'"></div>
<div class="rightArrow" style="display:inline" onclick="javascript:location.href='http://www.firststrikecomputing.co.uk/blog/newProjects/'"></div>

<?php $myposts = get_posts('cat=2&posts_per_page=-1'); // cat 2: news
foreach($myposts as $post) :
setup_postdata($post);
?>
<div class="spacer">
<div class="newsItem">
 <!-- <small><?php the_time('F jS, Y') ?></small> -->
<div class="postDate"><?php the_time('Y') ?></div>

<!-- <?php the_title(); ?>-->

<?php the_content(); ?>
</div>
</div>
<?php endforeach; wp_reset_postdata(); ?>
   <script>
 $(function() {      
      //Enable swiping...
      $(".newsItem").swipe( {
        //Generic swipe handler for all directions
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
    //       alert("test");
    //       var elem = document.getElementById("rightArrow");
    // elem.onclick.apply(elem);
    // loadProject('311', '159');
	$(".rightArrow:visible").each( function() { this.onclick(); });
        },
        swipeRight:function(event, direction, distance, duration, fingerCount){
        $(".leftArrow:visible").each( function() { this.onclick(); });	
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
         threshold:0
      });
    });
</script>  
<?php get_footer(); ?>