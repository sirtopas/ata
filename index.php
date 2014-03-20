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
<?php get_footer(); ?> 