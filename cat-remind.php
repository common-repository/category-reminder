<?php
/*
Plugin Name: Category reminder
Plugin URI: http://blog.robfelty.com/plugins/cat-remind
Description: Forces user to assign a category other than uncategorized to a post before publishing 
Author: Robert Felty
Version: 0.2
Author URI: http://robfelty.com
*/ 

function cat_remind_init() {
  wp_enqueue_script('jquery');
}

function cat_remind() {
  echo "<script type='text/javascript'>\n";
  echo "//<![CDATA[\n";
  //echo "jQuery(document).ready('#category-1').css.display='none';";
  echo "jQuery(document).ready(function() {
    jQuery('#category-1').remove();
    });\n";
  echo "if(document.getElementById('popular-category-1"."'))
  document.getElementById('popular-category-1"."').style.display='none';";
  echo "
  jQuery('#publish').click(function() {
    var cats = jQuery('[id^=\"taxonomy\"]')
      .find('.selectit')
      .find('input');
    catSelected=true;
    if (cats.length>0) catSelected=false;
    for (i=0; i<cats.length; i++) {
      if (cats.get(i).id=='in-category-1' || 
          cats.get(i).id=='in-popular-category-1') {
        cats.get(i).checked=false;
      }
      if (cats.get(i).checked==true) {
        catSelected=true;
        break;
      }
    }
    if (catSelected==false) {
      alert('you must select a category');
      setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\",
      100);
      jQuery('[id^=\"taxonomy\"]').find('.tabs-panel').css('background', '#FFB');
      setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100)
      return false;
    }
  });
  ";
  echo "// ]]>\n";
  echo "</script>\n";
}
add_action('admin_init', 'cat_remind_init');
add_action('edit_form_advanced', 'cat_remind');
?>
