<!DOCTYPE html>  
 <html>   
 <head>   
  <title>Membuat Kuitansi Sederhana</title>   
 </head>   
 <body>   
 <?php  
 $no   = isset($_GET['no']) ? $_GET['no'] : "";   
 $nama  = isset($_GET['nama']) ? $_GET['nama'] : "";   
 $pembayaran = isset($_GET['pembayaran']) ? $_GET['pembayaran'] : "";   
 $kota  = isset($_GET['kota']) ? $_GET['kota'] : "";   
 $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : "";   
 $tgl = explode("-", $tanggal);  
 $tglbaru = "$tgl[2]/$tgl[1]/$tgl[0]";  
 $nominal = isset($_GET['nominal']) ? $_GET['nominal'] : "0";   
 if ($nominal)   
 {   
     $uang = number_format($nominal, 0, ',','.') ."</br>";   
     $terbilang = ucwords(''.Terbilang($nominal).'')." Rupiah";   
 }   
 ?>  
 <h2>Aplikasi Kuitansi Sederhana</h2>  
 <hr>  
 <?php if (empty($nominal)) { ?>  
 <form action="" method="get">   
 <table width="100%" border="0">  
  <tr>  
   <td width="100">No.</td>  
   <td><input type="text" name="no"></td>  
  </tr>  
  <tr>  
   <td width="100">Diterima dari</td>  
   <td><input type="text" name="nama" required></td>  
  </tr>  
  <tr>  
   <td width="100">Nominal Uang</td>  
   <td><input type="text" name="nominal" required></td>  
  </tr>  
  <tr>  
   <td width="100">Untuk Pembayaran</td>  
   <td>  
   <textarea name="pembayaran" cols="40" rows="3"></textarea>  
   </td>  
  </tr>  
  <tr>  
   <td width="100">Kota</td>  
   <td><input type="text" name="kota" required></td>  
  </tr>  
  <tr>  
   <td width="100">Tanggal</td>  
   <td><input type="date" name="tanggal" required></td>  
  </tr>  
  <tr>  
   <td width="100"></td>  
   <td><input type="submit" value="Buat Kuitansi"></td>  
  </tr>  
 </table>  
 </form>  
 <?php } ?>  
 <?php if (!empty($nominal)) { ?>  
 <table width="800" border="0" cellpadding="4" cellspacing="0" style="border: 1px solid #000;">  
 <tr>  
   <td rowspan="6" width="120" style="border-right:1px solid #000;"> </td>  
   <td width="150" valign="top" > No </td>  
   <td valign="top" > : <?php echo $no;?> </td>  
 </tr>  
 <tr>  
   <td valign="top" > Telah Diterima Dari </td>  
   <td valign="top" > : <?php echo $nama;?> </td>  
 </tr>  
 <tr>  
   <td valign="top" > Uang Sejumlah </td>  
   <td valign="top" > : <?php echo $terbilang;?></td>  
 </tr>  
 <tr>  
   <td valign="top" > Untuk Pembayaran </td>  
   <td valign="top" > : <?php echo $pembayaran;?></td>  
 </tr>  
 <tr>  
   <td valign="bottom"> <h3>Rp <?php echo $uang;?> </h3> </td>  
   <td valign="top" align="right" height="100"> <?php echo "$kota, $tglbaru";?> </td>  
 </tr>  
 </table>  
 <style>  
 a { text-decoration: none; color: #0903E8; font-family: verdana; }  
 a:hover { color: #FA3C3C; }  
 </style>  
 <a href="index.php">Kembali</a>  
 <?php } ?>  
 </body>   
 </html>   
 <?php  
 //thanks to miswanphp10.blogspot.co.id   
 function Terbilang($x)   
 {   
  $bilangan = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");   
  if ($x < 12)   
   return " " . $bilangan[$x];   
  elseif ($x < 20)   
   return Terbilang($x - 10) . "belas";   
  elseif ($x < 100)   
   return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);   
  elseif ($x < 200)   
   return " seratus" . Terbilang($x - 100);   
  elseif ($x < 1000)   
   return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);   
  elseif ($x < 2000)   
   return " seribu" . Terbilang($x - 1000);   
  elseif ($x < 1000000)   
   return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);   
  elseif ($x < 1000000000)   
   return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);    
 }   
 ?>   