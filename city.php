<style>
  p{
   font-size: 30px; 
  }
  @media (max-width: 540px){
 p{
  font-size: 20px;
 }
  
}
</style>


  <div align="center" class="row">
  <?php
    if(isset($_GET[$dbtable])){
      $citylink_get=$_GET[$dbtable];
    }else{
      $citylink_get=base64_encode($dbtable);
    }

    foreach ($city as $row){  
       $sql="SELECT * FROM ".$dbtable." WHERE Region like '%".$row['City_ch']."%'";
       $hotelnum=sqldatabaselink($link,$sql);

  ?>
  <div class="col-md-4 ">
  
    <a href="<?php echo "?citylink=".base64_encode($row['City_ch'])."&".$citylink."=".$citylink_get;?>"  class=" card  rounded-circle">
      
          <div class="view  zoom  rounded-circle">
            <img class="card-img rounded-circle cityimg img-thumbnail"  src="img/<?php echo $row['City_img'];?>" >
            <div class="card-img-overlay" style="top:30%">
              <div class="card-body ">
                <div class=" text-white" >

                  <p style="text-shadow:2px 2px 2px #000000,-2px -2px 2px #000000;"><?php echo $row['City_ch'];  ?></p>
                   <span class="badge badge-pill badge-info"><?php echo count($hotelnum);?></span>
                </div>
                
               
              </div>
              
            </div>
          </div>  

    </a>
    <!-- Card -->
    <br>
  </div>
  <?php } ?>

  </div>

