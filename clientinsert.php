<?php

	/*  
	  ini_set('display_errors', true);
	  error_reporting(E_ALL); 
	 */
  
	require_once('lib/nusoap.php');
	$error  = '';
	$result = array();
	$response = '';
	$wsdl = "http://localhost/webservices/server.php?wsdl";

	if(isset($_POST['addbtn'])){
		$kode_pasien = trim($_POST['kode_pasien']);
		$nama_pasien = trim($_POST['nama_pasien']);
		$umur = trim($_POST['umur']);
		$alamat = trim($_POST['alamat']);
		$no_kamar = trim($_POST['no_kamar']);
        $kategori_kamar = trim($_POST['kategori_kamar']);
        $nama_dokter = trim($_POST['nama_dokter']);
        $keterangan = trim($_POST['keterangan']);


		if(!$kode_pasien || !$nama_pasien || !$umur || !$alamat || !$no_kamar || !$kategori_kamar || !$nama_dokter || !$keterangan ){
			$error = 'Semua kolom sudah terisi';
		}

		if(!$error){
			//create client object
			$client = new nusoap_client($wsdl, true);
			$err = $client->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
				// At this point, you know the call that follows will fail
			    exit();
			}
			 try {
				/** Call insert book method */
				 $response =  $client->call('insertPasien', array($kode_pasien, $nama_pasien, $umur, $alamat, $no_kamar, $kategori_kamar, $nama_dokter, $keterangan));
				 $response = json_decode($response);
			  }catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Informasi Pasien SOAP Web Service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div class="container">
<br>
<h1 style="text-align: center">SOAP WSDL SEPASYSTEM</h1><br>
  <h2 style="text-align: center">Search Pasien System</h2>
	<div class='row'>
	<h2>Tambah Pasien</h2><br>
	 <?php if(isset($response->status)) {
	  if($response->status == 200){ ?>
		 <script>alert("Berhasil menambahkan data");window.location="client.php"</script>';
		</div>
	  <?php }elseif(isset($response) && $response->status != 200) { ?>
		<div class="alert alert-danger" role="alert">
		<strong>Error!</strong> data tidak ditambahkan.
		</div>
	 <?php } 
	 }
	 ?>
	 <br>
  	<form class="form-inline" method = 'post' name='form1' action="">
  		<?php if($error) { ?> 
	    	<div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp;<?php echo $error; ?> 
	        </div>
		<?php } ?>
		<div class="col-lg-3">
	    <div class="form-group">
	        <input type="text" class="form-control" name="kode_pasien" id="kode_pasien" placeholder="Masukan Kode Pasien" required><br>
		    <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Masukan Nama Pasien" required><br>
			<input type="text" class="form-control" name="umur" id="umur" placeholder="Masukan Umur" required><br>
			<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan Alamat" required><br>
			<input type="text" class="form-control" name="no_kamar" id="no_kamar" placeholder="Masukan No Kamar" required><br>
            <input type="text" class="form-control" name="kategori_kamar" id="kategori_kamar" placeholder="Masukan Kategori Kamar" required><br>
            <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" placeholder="Masukan Nama Dokter" required><br>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukan Keterangan" required><br>
        </div>
		</div>
	    <button type="submit" name='addbtn' class="btn btn-success btn-md"><span class="fa fa-check"></span>Simpan</button><br><br>
    </form>
   </div>
</div>
</body>
</html>



