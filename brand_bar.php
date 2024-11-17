<!--top brand panel start-->
<section class="brand-panel">
  <div class="brand-panel-box">
    <div class="brand-panel-contain ">
      <ul>
        <li><a href="javascript:void(0)">top brand :</a></li>
        <?php 
         $sql = "SELECT * FROM pro_brands where brand_status='active' ORDER BY brand_id ASC limit 0, 11";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)){
                              $brand_title = $fetch["brand_title"];
                              $brand_id = $fetch['brand_id'];
                  ?>
        <li><a href="products.php?brand_id=<?php echo $brand_id;?>"><?php echo $brand_title;?></a></li>
      <?php  }  ?>
      </ul>
    </div>
  </div>
</section>
<!--top brand panel end-->