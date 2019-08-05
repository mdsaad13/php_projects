<?php 
  include "QrLib/qrlib.php";

  class Qr_generate
  {
      public function Generate_QR($fields)
      {
        $name = array_values($fields)['0'];
        $qty  = array_values($fields)['1'];

        $qc =  "";
        $qc.= "Name = ".$name."\n"."Quantity = ".$qty;
        $qrImgName = "QR".rand();
        
        
        $final      = $qc;
        $qrs        = QRcode::png($final,"usersQr/$qrImgName.png","H","6","6");
        $qrimage    = $qrImgName.".png";
        // $workDir    = $_SERVER['HTTP_HOST'];
        $qrlink     = "../usersQr/".$qrImgName.".png";

        return $qrlink;
      }
  }
  $obj1 = new Qr_generate;

?>


  