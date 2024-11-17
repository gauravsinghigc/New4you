 <section class="carousel-slider-main text-center border-top border-bottom bg-white">
         <div class="owl-carousel owl-carousel-slider">
            <?php 
            $sql = "SELECT * FROM slider where slider_type='WEBSITE' ORDER BY sortby ASC";
                            $query = mysqli_query($con, $sql);
                            $CountSlides = 0;
                            while ($fetch = mysqli_fetch_assoc($query)){
                              $slider_img = $fetch["slider_img"];
                              $target_url = $fetch["target_url"];
                              $slider_title = $fetch["slider_title"];
                              if($target_url == "No Url Required"){
                                $target_url = "";
                              } else {
                                $target_url = "href='$target_url'";
                              }?>
            <div class="item">
               <a <?php echo $target_url;?>><img class="img-fluid" src="<?php echo $img_url;?>/img/store_img/slider/<?php echo $slider_img;?>" alt="<?php echo $slider_title;?>" title="<?php echo $slider_title;?>"></a>
            </div>
         <?php } ?>
         </div>
      </section>
