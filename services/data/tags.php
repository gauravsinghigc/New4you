<?php
//header tags
//default meta tags for all pages
$H_default = array(
 //paste of type your meta tags below in the form or array like 'abec', 'syx', 'mno' formate
 '<meta charset="UTF-8">',
 '<meta http-equiv="X-UA-Compatible" content="IE=edge">',
 '<meta name="viewport" content="width=device-width, initial-scale=1.0">'
);

//index meta tags or main/home page tags
$H_index = array(
 //paste of type your meta tags below in the form or array like 'abec', 'syx', 'mno' formate
);



//footer tags
$F_default = array();






//--########################################################################################
//--###############------------------Meta Tags------------------------######################
//--########################################################################################
//Enter new page or all page in the page array list then create a variable having name as page name in the array then create meta  list in the declared array whose name is mention in the page array list. make sure name must be same other wise it not shown
$HEADER_TAGS = array("H_default", "H_index", "H_aboutus");
$FOOTER_TAGS = array("F_default");

//display meta tags tags
function HEADER_TAGS(array $P)
{
 foreach ($P as $pages) {
  global $$pages;
  $page = $$pages;
  foreach ($page as $pagetags) {
   return $pagetags;
  }
 }
}

//display meta tags tags
function FOOTER_TAGS(array $P)
{
 foreach ($P as $pages) {
  global $$pages;
  $page = $$pages;
  foreach ($page as $pagetags) {
   return $pagetags;
  }
 }
}

//--########################################################################################
//--###############################---End of Tags -----------------#########################
//--########################################################################################
