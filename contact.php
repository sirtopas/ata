<?php get_header(); ?>
<?php
/*
Template Name: contact
*/
?>

<div class="leftArrow" style="display:inline" onclick="javascript:location.href='http://www.firststrikecomputing.co.uk/blog/newProjects/'"></div>
<div class="rightArrow" style="display:inline" onclick="javascript:location.href='http://www.firststrikecomputing.co.uk/blog/new/'"></div>
<div class="contactItem">

<?php
	$argys = array('category' => '12', 'posts_per_page' => 1);
	$posts = get_posts( $argys );
	foreach ( $posts as $post ) {
		setup_postdata($post);
		the_content();
	}
?>

</div>

   <script>
 $(function() {      
      //Enable swiping...
      $(".contactItem").swipe( {
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