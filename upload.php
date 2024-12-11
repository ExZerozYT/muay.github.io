<?php
if(isset($_POST["submit"])) {
  $target_dir = "uploads/"; // กำหนดโฟลเดอร์ที่จะเก็บไฟล์
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 1 

  // ตรวจสอบว่าเป็นไฟล์รูปภาพจริงหรือไม่
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "ไฟล์เป็นรูปภาพ - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "ไฟล์ไม่ใช่รูปภาพ.";
      $uploadOk = 0;
    }
  }

  // ตรวจสอบว่ามีไฟล์นี้อยู่แล้วหรือไม่
  if (file_exists($target_file)) {
    echo "ขออภัย มีไฟล์นี้อยู่ในระบบแล้ว";
    $uploadOk = 0;
  }

  // ตรวจสอบขนาดไฟล์
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "ขออภัย ไฟล์ของคุณมีขนาดใหญ่เกินไป";
    $uploadOk = 0;
  }

  // อนุญาตให้อัพโหลดเฉพาะไฟล์บางประเภท
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "ขออภัย อนุญาตให้อัพโหลดเฉพาะไฟล์ JPG, JPEG, PNG & GIF เท่านั้น";
    $uploadOk = 0;
  }

  // ตรวจสอบว่า $uploadOk ถูกตั้งเป็น 0 ด้วยข้อผิดพลาดหรือไม่
  if ($uploadOk == 0) {
    echo "ขออภัย ไม่สามารถอัพโหลดไฟล์ของคุณได้";
  // ถ้าทุกอย่างเรียบร้อย ให้ลองอัพโหลดไฟล์
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "ไฟล์ ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " อัพโหลดเรียบร้อยแล้ว";
    } else {
      echo "ขออภัย เกิดข้อผิดพลาดขณะอัพโหลดไฟล์ของคุณ";
    }
  }
}
?>