<style>
  table td{
    font-size:3vh;
  }
  .collapse_Name{
    top:35%;
  }

</style>
<?php 

  $Regioncity=base64_decode(str_replace(" ","+",$_GET['citylink']));
  $citylink_dbtable=base64_decode(str_replace(" ","+",$_GET[$citylink]));

  $maxRows = 15;
  $pageNum=0;

  $sqlstr="SELECT * FROM ".$citylink_dbtable." WHERE Region='".$Regioncity."'";
  $Region=sqldatabaselink($link,$sqlstr);
  $totalPages=ceil(count($Region)/$maxRows)-1;

  if(isset($_GET['pageNum'])){
    if($_GET['pageNum']<0){
      $pageNum=0;
    }else if($_GET['pageNum']>$totalPages){
      $pageNum=$totalPages;
    }else{
      $pageNum=base64_decode(str_replace(" ","+",$_GET['pageNum']));
    }  
  }

  $startRow = $pageNum * $maxRows;
  $sql=$sqlstr." limit ".$startRow.",".$maxRows;
	$hotel_ch=sqldatabaselink($link,$sql);
?>

  <h4 >
    <?php echo $Regioncity.":"."共".count($Region).$pagetext;?>
  </h4>
  <hr>
  <div align="center" class="row" id="accordion">
    
    <?php


    foreach ($hotel_ch as $value) {
    ?>  
    <div class="col-md-4 my-3" id="<?php echo $value[$table_Id];?>">
      <div class="card  border border-info rounded-pill ">          
          <a data-toggle="collapse" data-target="#collapse<?php echo $value[$table_Id];?>" aria-expanded="false" aria-controls="collapse<?php echo $value[$table_Id];?>">
            <img class=" card-img  rounded-pill cityimg"  src="<?php echo $value['Picture1']!=""?$value['Picture1']:'img/'.$errorimg;?>" onerror="this.src='img/<?php echo $errorimg;?>'">
            <div class="card-img-overlay collapse_Name">
              <h3  class="card-title  h3 text-white" style="text-shadow:2px 2px 2px #000000,-2px -2px 2px #000000;"><?php echo $value['Name'];?></h3>
            </div>
          </a>
        <div id="collapse<?php echo $value[$table_Id];?>" class="collapse" aria-labelledby="heading<?php echo $value[$table_Id];?>" data-parent="#accordion">
          <div class="card-body text-left "   >
            <hr>
            <p class="h4 card-title font-weight-bold text-center">
              <?php if($value['Website']){?>
              <a href="<?php echo $value['Website'];?>" class="card-link h5 " style="position: relative;" target="new"><i class="fab fa-staylinked"></i></a> <br><?php }?>
             

              <?php  if(!empty($value['Grade'])){
                for($i=1;$i<=(int)$value['Grade'];$i++){ ?>
              <i class="fas fa-star text-warning" style="font-size: 0.1vh;"></i>
            <?php }}?>
            </p>
            <p class="card-text m-4 p-3"><?php echo $value['Description']?mb_substr($value['Description'],0,30,'utf-8')."...":'';?></p>
            <?php if($value['Addr']){?>
            <p class=" m-4"><a href="https://www.google.com.tw/maps/place/<?php echo $value['Py'].",".$value['Px'];?>/" class="card-link " style="position: relative;" target="new"><i class="fas fa-map-marker-alt"></i><span class="card-text ml-2"><?php echo $value['Addr'];?></span></a></p><?php }?>
            <?php if($value['Tel']){?>
             <p class=" m-4"><a href="tel:<?php echo $value['Tel'];?>" class="card-link " style="position: relative;" target="new"><i class="fas fa-phone"></i><span class="card-text ml-2"><?php echo $value['Tel'];?></span></a></p>
            <?php }?>
            <p class="m-4 text-center"><a  href="?<?php echo "citylink=".$_GET['citylink']."&".$tablelink."=".base64_encode($value[$table_Id])."&".$citylink."=".$_GET[$citylink];?>"  class="btn  btn-sm blue-gradient rounded-pill" style="position: relative;" target="_blank"><?php echo "查看詳細內容";?></a></p>
          </div>
        </div>
      </div>


    </div>
  <?php }?>
    
  </div> 

  <hr>

<nav  aria-label="Page navigation example" class="d-flex">
  <ul class="mr-auto ml-auto pagination">
    <?php if ($pageNum > 0) { ?>
    <li class="page-item">
        <a href="?citylink=<?php echo $_GET['citylink'];?>&pageNum=<?php echo base64_encode("0")."&".$citylink."=".$_GET[$citylink];?>" class="page-link"><i class=" fas fa-angle-double-left text-info"></i></a></li>
    <li class="page-item"><a href="?citylink=<?php echo $_GET['citylink'];?>&pageNum=<?php echo base64_encode($pageNum-1)."&".$citylink."=".$_GET[$citylink];?>  "class="page-link"><i class="fas fa-angle-left text-info"></i></a></li><?php }?>
    <li class="page-item"><span><?php echo "第".' '.($pageNum+1).' '.'頁';?></span></li>
    <li class="page-item"><span><?php echo "/共".' '.($totalPages+1).' '."頁";?></span></li>
    <?php if ($pageNum < $totalPages) {?>
    <li class="page-item">
      <a href="?citylink=<?php echo $_GET['citylink'];?>&pageNum=<?php echo base64_encode($pageNum+1)."&".$citylink."=".$_GET[$citylink];?> "class="page-link"><i class="fas fa-angle-right text-info"></i></a>
    </li>
    <li class="page-item"><a href="?citylink=<?php echo $_GET['citylink'];?>&pageNum=<?php echo base64_encode($totalPages)."&".$citylink."=".$_GET[$citylink];?> "class="page-link"><i class="fas fa-angle-double-right text-info"></i></a></li><?php }?>
  </ul>
</nav>

