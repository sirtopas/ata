<?php get_header(); ?>
<?php
/*
Template Name: test
*/
?>
<?php
/*
Grabbing images for each project:
  Take ID from projects page
  Go to 'wp-content/themes/ata/images/' + $id
  Cycle through images
  Show as numerical: 
    0.jpg as cover
    1.jpg as image 1
    2.jpg as image 2
*/

    // $result[] = "<div class=\"hero-unit\"><img src=\"$filename\"></div>";
    // echo '<div class=\"hero-unit\"><img src=\"$filename\"></div>';
    // echo '<div class="hero-unit"><img src="../' $filename">TESTSETSETSETESTS</div>';
	// echo '<div class="project"><a href="#"><img src="../'.$filename.'" width="100%">test</a></div>';
	// echo '<div class="project"><a href="#">test</a></div>';
  // echo '<div class="hero-unit">';
  // echo '<a href="projectFullScreen"><img class="rollover" src="../'.$filename.'" data-rollover="/images/1.jpg" width="100%" height="100%/></a>';
  // echo '</div>';

?>
<!-- <img class="rollover" src="http://dummyimage.com/600x400/000/fff" data-rollover="http://dummyimage.com/600x400/fff/000" />
 -->
<div id="bg"><a href="#" class="nextImageBtn" title="next"></a><a href="#" class="prevImageBtn" title="previous"></a><img src="/images/1.jpg" width="1680" height="1050" alt="Test" title="Test" id="bgimg" /></div>
<div id="preloader"><img src="/images/ajax-loader_dark.gif" width="32" height="32" /></div>
<div id="img_title"></div>
<div id="toolbar"><a href="#" title="Maximize" onClick="ImageViewMode('full');return false"><img src="/images/toolbar_fs_icon.png" width="50" height="50"  /></a></div>
<div id="thumbnails_wrapper">
<div id="outer_container">
<div class="thumbScroller">
  <div class="container">


<?php
echo $_REQUEST['id']; // $_REQUEST catches $_GET and $_POST
$id = $_REQUEST['id'];
$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' =>'any', 'post_parent' => 150 ); 
$attachments = get_children($args);
if ($attachments) {
foreach ( $attachments as $filename ) {
  // $result[] = "<div class=\"hero-unit\"><img src=\"$filename\"></div>";
  // echo '<div class=\"hero-unit\"><img src=\"$filename\"></div>';
  // echo '<div class="hero-unit"><img src="../' $filename">TESTSETSETSETESTS</div>';
  // echo '<div class="project"><a href="#"><img src="../'.$filename.'" width="100%">test</a></div>';
  // echo '<div class="project"><a href="#">test</a></div>';
  // echo '<div class="hero-unit">';
  // echo '<a href="projectFullScreen"><img class="rollover" src="../'.$filename.'" data-rollover="/images/1.jpg" width="100%" height="100%/></a>';
  // echo '</div>';
echo'<div><a href="../'.wp_get_attachment_url($filename->ID).'"><img src="../'.$filename.'" width="200px" height="130px" title="Testt" alt="test" class="thumb" /></a></div>';
     echo'<div class="content">';
          echo'<div><a href="../'.wp_get_attachment_url($filename->ID).'"><img src="../'.$filename.'" width="200px" height="130px" title="Testt" alt="test" class="thumb" /></a></div>';
        echo'</div>';
}
}
?>
<?php
$gallery = get_children( 'posts_per_page=5post_type=attachment&post_mime_type=image&post_parent=' . $id->ID );
$attr = array(
    'class' => "attachment-$size wp-post-image",
);
foreach( $gallery as $image ) {
     echo '<a href="' . wp_get_attachment_url($image->ID) . '" rel="gallery-' . get_the_ID() . '">';
     echo wp_get_attachment_image($image->ID, 'thumbnail', false, $attr);
     echo '</a>';
}
?>
</div>
</div>
</div>
</div>


<script>
//config
//set default images view mode
$defaultViewMode="full"; //full, normal, original
$tsMargin=30; //first and last thumbnail margin (for better cursor interaction) 
$scrollEasing=600; //scroll easing amount (0 for no easing) 
$scrollEasingType="easeOutCirc"; //scroll easing type 
$thumbnailsContainerOpacity=0.8; //thumbnails area default opacity
$thumbnailsContainerMouseOutOpacity=0; //thumbnails area opacity on mouse out
$thumbnailsOpacity=0.6; //thumbnails default opacity
$nextPrevBtnsInitState="show"; //next/previous image buttons initial state ("hide" or "show")
$keyboardNavigation="on"; //enable/disable keyboard navigation ("on" or "off")

//cache vars
$thumbnails_wrapper=$("#thumbnails_wrapper");
$outer_container=$("#outer_container");
$thumbScroller=$(".thumbScroller");
$thumbScroller_container=$(".thumbScroller .container");
$thumbScroller_content=$(".thumbScroller .content");
$thumbScroller_thumb=$(".thumbScroller .thumb");
$preloader=$("#preloader");
$toolbar=$("#toolbar");
$toolbar_a=$("#toolbar a");
$bgimg=$("#bgimg");
$img_title=$("#img_title");
$nextImageBtn=$(".nextImageBtn");
$prevImageBtn=$(".prevImageBtn");

$(window).load(function() {
  $toolbar.data("imageViewMode",$defaultViewMode); //default view mode
  if($defaultViewMode=="full"){
    $toolbar_a.html("<img src='toolbar_n_icon.png' width='50' height='50'  />").attr("onClick", "ImageViewMode('normal');return false").attr("title", "Restore");
  } else {
    $toolbar_a.html("<img src='toolbar_fs_icon.png' width='50' height='50'  />").attr("onClick", "ImageViewMode('full');return false").attr("title", "Maximize");
  }
  ShowHideNextPrev($nextPrevBtnsInitState);
  //thumbnail scroller
  $thumbScroller_container.css("marginLeft",$tsMargin+"px"); //add margin
  sliderLeft=$thumbScroller_container.position().left;
  sliderWidth=$outer_container.width();
  $thumbScroller.css("width",sliderWidth);
  var totalContent=0;
  fadeSpeed=200;
  
  var $the_outer_container=document.getElementById("outer_container");
  var $placement=findPos($the_outer_container);
  
  $thumbScroller_content.each(function () {
    var $this=$(this);
    totalContent+=$this.innerWidth();
    $thumbScroller_container.css("width",totalContent);
    $this.children().children().children(".thumb").fadeTo(fadeSpeed, $thumbnailsOpacity);
  });

  $thumbScroller.mousemove(function(e){
    if($thumbScroller_container.width()>sliderWidth){
        var mouseCoords=(e.pageX - $placement[1]);
        var mousePercentX=mouseCoords/sliderWidth;
        var destX=-((((totalContent+($tsMargin*2))-(sliderWidth))-sliderWidth)*(mousePercentX));
        var thePosA=mouseCoords-destX;
        var thePosB=destX-mouseCoords;
        if(mouseCoords>destX){
          $thumbScroller_container.stop().animate({left: -thePosA}, $scrollEasing,$scrollEasingType); //with easing
        } else if(mouseCoords<destX){
          $thumbScroller_container.stop().animate({left: thePosB}, $scrollEasing,$scrollEasingType); //with easing
        } else {
        $thumbScroller_container.stop();  
        }
    }
  });

  $thumbnails_wrapper.fadeTo(fadeSpeed, $thumbnailsContainerOpacity);
  $thumbnails_wrapper.hover(
    function(){ //mouse over
      var $this=$(this);
      $this.stop().fadeTo("slow", 1);
    },
    function(){ //mouse out
      var $this=$(this);
      $this.stop().fadeTo("slow", $thumbnailsContainerMouseOutOpacity);
    }
  );

  $thumbScroller_thumb.hover(
    function(){ //mouse over
      var $this=$(this);
      $this.stop().fadeTo(fadeSpeed, 1);
    },
    function(){ //mouse out
      var $this=$(this);
      $this.stop().fadeTo(fadeSpeed, $thumbnailsOpacity);
    }
  );

  //on window resize scale image and reset thumbnail scroller
  $(window).resize(function() {
    FullScreenBackground("#bgimg",$bgimg.data("newImageW"),$bgimg.data("newImageH"));
    $thumbScroller_container.stop().animate({left: sliderLeft}, 400,"easeOutCirc"); 
    var newWidth=$outer_container.width();
    $thumbScroller.css("width",newWidth);
    sliderWidth=newWidth;
    $placement=findPos($the_outer_container);
  });

  //load 1st image
  var the1stImg = new Image();
  the1stImg.onload = CreateDelegate(the1stImg, theNewImg_onload);
  the1stImg.src = $bgimg.attr("src");
  $outer_container.data("nextImage",$(".content").first().next().find("a").attr("href"));
  $outer_container.data("prevImage",$(".content").last().find("a").attr("href"));
});

function BackgroundLoad($this,imageWidth,imageHeight,imgSrc){
  $this.fadeOut("fast",function(){
    $this.attr("src", "").attr("src", imgSrc); //change image source
    FullScreenBackground($this,imageWidth,imageHeight); //scale background image
    $preloader.fadeOut("fast",function(){$this.fadeIn("slow");});
    var imageTitle=$img_title.data("imageTitle");
    if(imageTitle){
      $this.attr("alt", imageTitle).attr("title", imageTitle);
      $img_title.fadeOut("fast",function(){
        $img_title.html(imageTitle).fadeIn();
      });
    } else {
      $img_title.fadeOut("fast",function(){
        $img_title.html($this.attr("title")).fadeIn();
      });
    }
  });
}

//mouseover toolbar
if($toolbar.css("display")!="none"){
  $toolbar.fadeTo("fast", 0.4);
}
$toolbar.hover(
  function(){ //mouse over
    var $this=$(this);
    $this.stop().fadeTo("fast", 1);
  },
  function(){ //mouse out
    var $this=$(this);
    $this.stop().fadeTo("fast", 0.4);
  }
);

//Clicking on thumbnail changes the background image
$("#outer_container a").click(function(event){
  event.preventDefault();
  var $this=$(this);
  GetNextPrevImages($this);
  GetImageTitle($this);
  SwitchImage(this);
  ShowHideNextPrev("show");
}); 

//next/prev images buttons
$nextImageBtn.click(function(event){
  event.preventDefault();
  SwitchImage($outer_container.data("nextImage"));
  var $this=$("#outer_container a[href='"+$outer_container.data("nextImage")+"']");
  GetNextPrevImages($this);
  GetImageTitle($this);
});

$prevImageBtn.click(function(event){
  event.preventDefault();
  SwitchImage($outer_container.data("prevImage"));
  var $this=$("#outer_container a[href='"+$outer_container.data("prevImage")+"']");
  GetNextPrevImages($this);
  GetImageTitle($this);
});

//next/prev images keyboard arrows
if($keyboardNavigation=="on"){
$(document).keydown(function(ev) {
    if(ev.keyCode == 39) { //right arrow
        SwitchImage($outer_container.data("nextImage"));
    var $this=$("#outer_container a[href='"+$outer_container.data("nextImage")+"']");
    GetNextPrevImages($this);
    GetImageTitle($this);
        return false; // don't execute the default action (scrolling or whatever)
    } else if(ev.keyCode == 37) { //left arrow
        SwitchImage($outer_container.data("prevImage"));
    var $this=$("#outer_container a[href='"+$outer_container.data("prevImage")+"']");
    GetNextPrevImages($this);
    GetImageTitle($this);
        return false; // don't execute the default action (scrolling or whatever)
    }
});
}

function ShowHideNextPrev(state){
  if(state=="hide"){
    $nextImageBtn.fadeOut();
    $prevImageBtn.fadeOut();
  } else {
    $nextImageBtn.fadeIn();
    $prevImageBtn.fadeIn();
  }
}

//get image title
function GetImageTitle(elem){
  var title_attr=elem.children("img").attr("title"); //get image title attribute
  $img_title.data("imageTitle", title_attr); //store image title
}

//get next/prev images
function GetNextPrevImages(curr){
  var nextImage=curr.parents(".content").next().find("a").attr("href");
  if(nextImage==null){ //if last image, next is first
    var nextImage=$(".content").first().find("a").attr("href");
  }
  $outer_container.data("nextImage",nextImage);
  var prevImage=curr.parents(".content").prev().find("a").attr("href");
  if(prevImage==null){ //if first image, previous is last
    var prevImage=$(".content").last().find("a").attr("href");
  }
  $outer_container.data("prevImage",prevImage);
}

//switch image
function SwitchImage(img){
  $preloader.fadeIn("fast"); //show preloader
  var theNewImg = new Image();
  theNewImg.onload = CreateDelegate(theNewImg, theNewImg_onload);
  theNewImg.src = img;
}

//get new image dimensions
function CreateDelegate(contextObject, delegateMethod){
  return function(){
    return delegateMethod.apply(contextObject, arguments);
  }
}

//new image on load
function theNewImg_onload(){
  $bgimg.data("newImageW",this.width).data("newImageH",this.height);
  BackgroundLoad($bgimg,this.width,this.height,this.src);
}

//Image scale function
function FullScreenBackground(theItem,imageWidth,imageHeight){
  var winWidth=$(window).width();
  var winHeight=$(window).height();
  if($toolbar.data("imageViewMode")!="original"){ //scale
    var picHeight = imageHeight / imageWidth;
    var picWidth = imageWidth / imageHeight;
    if($toolbar.data("imageViewMode")=="full"){ //fullscreen size image mode
      if ((winHeight / winWidth) < picHeight) {
        $(theItem).attr("width",winWidth);
        $(theItem).attr("height",picHeight*winWidth);
      } else {
        $(theItem).attr("height",winHeight);
        $(theItem).attr("width",picWidth*winHeight);
      };
    } else { //normal size image mode
      if ((winHeight / winWidth) > picHeight) {
        $(theItem).attr("width",winWidth);
        $(theItem).attr("height",picHeight*winWidth);
      } else {
        $(theItem).attr("height",winHeight);
        $(theItem).attr("width",picWidth*winHeight);
      };
    }
    $(theItem).css("margin-left",(winWidth-$(theItem).width())/2);
    $(theItem).css("margin-top",(winHeight-$(theItem).height())/2);
  } else { //no scale
    $(theItem).attr("width",imageWidth);
    $(theItem).attr("height",imageHeight);
    $(theItem).css("margin-left",(winWidth-imageWidth)/2);
    $(theItem).css("margin-top",(winHeight-imageHeight)/2);
  }
}

//Image view mode function - fullscreen or normal size
function ImageViewMode(theMode){
  $toolbar.data("imageViewMode", theMode);
  FullScreenBackground($bgimg,$bgimg.data("newImageW"),$bgimg.data("newImageH"));
  if(theMode=="full"){
    $toolbar_a.html("<img src='toolbar_n_icon.png' width='50' height='50'  />").attr("onClick", "ImageViewMode('normal');return false").attr("title", "Restore");
  } else {
    $toolbar_a.html("<img src='toolbar_fs_icon.png' width='50' height='50'  />").attr("onClick", "ImageViewMode('full');return false").attr("title", "Maximize");
  }
}

//function to find element Position
  function findPos(obj) {
    var curleft = curtop = 0;
    if (obj.offsetParent) {
      curleft = obj.offsetLeft
      curtop = obj.offsetTop
      while (obj = obj.offsetParent) {
        curleft += obj.offsetLeft
        curtop += obj.offsetTop
      }
    }
    return [curtop, curleft];
  }
</script>