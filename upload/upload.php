<?php
session_start();
$file="userinfo_Customer_picture";
$file="userinfo_Customer_picture";
if ((($_FILES[$file]["type"] == "image/gif")
|| ($_FILES[$file]["type"] == "image/jpeg")
|| ($_FILES[$file]["type"] == "image/pjpeg")||($_FILES[$file]["type"] == "image/png"))
)
  {
  if ($_FILES[$file]["error"] > 0)
    {
    echo false;
    }
  else
    { 
    	$imgtype=".".str_replace("image/","",$_FILES[$file]["type"]);
      move_uploaded_file($_FILES[$file]["tmp_name"],
      "photo/" .$_SESSION['OAuth_Id']. $imgtype);
      echo "upload/photo/".$_SESSION['OAuth_Id']. $imgtype;
    }
  }
else
  {
  echo false;
  }
?>