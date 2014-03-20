<?php get_header(); ?>
<div class="homeImage">
<img src="/images/home.jpg" width="100%"/>
<div class="title">Amin Taha Architects</div>
</div>
<style>
    .postImage{position:relative;}
    .postImage>a{position:absolute; top:0; left:0; z-index:0;}
    .postImage>h1{display:none; position:absolute; top:50%; left:0; z-index:1;}
    .postImage:hover img{opacity:0.5;}
    .postImage:hover h1{display:block;}
</style>
<a name="contact"></a>
<div class="hero-unit">
  <img src="/images/map.png" width="100%"/>
  Amin Taha Architects<br /><br>
15 Clerkenwell Close<br />
London EC1R 0AA<br /><br>
T: 0207 253 9444<br />
F: 0207 253 9555<br />
studio@amintaha.co.uk<br />
</div>
<div class="page">
</div>
<a name="news"></a>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<!-- Test if the current post is in category 3. -->
<!-- If it is, the div box is given the CSS class "post-cat-three". -->
<!-- Otherwise, the div box is given the CSS class "post". -->

<div class="hero-unit">

<!-- Display the Title as a link to the Post's permalink. -->
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="View Details on <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
<small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>

<!-- Display the Post's content in a div box. -->
<div class="entry">
<?php the_content(); ?>
</div>

<!-- Display a comma separated list of the Post's Categories. -->
<!-- <p class="postmetadata">Posted in <?php the_category(', '); ?></p> -->
<a href="<?php the_permalink() ?>" rel="bookmark" title="View Details on <?php the_title_attribute(); ?>">View Details</a>
</div> <!-- closes the first div box -->

<!-- Stop The Loop (but note the "else:" - see next line). -->
<?php endwhile; else: ?>

<!-- The very first "if" tested to see if there were any Posts to -->
<!-- display. This "else" part tells what do if there weren't any. -->
<p>Sorry, no posts matched your criteria.</p>

<!-- REALLY stop The Loop. -->
<?php endif; ?>

<div class="hero-unit">
<h1>Hello, world!</h1>
<p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
<p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
<!-- Example row of columns -->
<div class="row">
<div class="span4">
<h2>Heading</h2>
<img src="/blog/wp-content/themes/ata/images/Golden-Lane.jpg" width:"600px" height:"300px">
<p><a class="btn" href="#">View details &raquo;</a></p>
</div>
<div class="span4">
<h2>Heading</h2>
<img src="/blog/wp-content/themes/ata/images/Ada-Street.jpeg">
<p><a class="btn" href="#">View details &raquo;</a></p>
</div>
<div class="span4">
<h2>Heading</h2>
<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
<p><a class="btn" href="#">View details &raquo;</a></p>
</div>
<div class="span4">
<h2>Heading</h2>
<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
<p><a class="btn" href="#">View details &raquo;</a></p>
</div>
<div class="span4">
<h2>Heading</h2>
<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
<p><a class="btn" href="#">View details &raquo;</a></p>
</div>
<div class="page"></div>
</div>
<div class="hero-unit">
<a name="team"></a>
<img src="/images/team.png" style="width:100%" />
  The practice was formed after winning competitions for an urban regeneration master plan in Manchester and an Arts Complex in East London.
It is lead Amin Taha, Sarah Griffiths and Richard Cheesman and Dominic Kacinskas at associate level. Our current staff includes: Peter Rae, Víctor Jimenez, Dale Elliott, Adam Draper, Mehrnaz Ghojeh and Jason Coe.
</div>
<div class="page"></div>
</div>
</div>
<a name="projects"></a>
<div class="hero-unit">
<img src="/images/Ada-Street.jpg" style="width:100%" />
Ada Street
<img src="/images/Golden-Lane.jpg" style="width:100%" />
Golden Lane
<img src="/images/1.jpg" style="width:100%" />
Westborne Grove
</div>
<?php get_footer(); ?> 