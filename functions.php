<?php 
function getProjectImages() {
  $projects = get_posts( 'cat=3' );

foreach($projects as $image):
  setup_postdata($image);
the_content(); 
echo wp_get_attachment_image(get_post_thumbnail_id($image->ID), 'medium');
endforeach;
}
?>
