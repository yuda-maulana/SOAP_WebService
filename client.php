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
	if(isset($_POST['sub'])){
		$nama_pasien = trim($_POST['nama_pasien']);
		if(!$nama_pasien){
			$error = 'Nama Pasien tidak boleh kosong.';
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
				$result = $client->call('tampilPasien', array($nama_pasien));
				$result = json_decode($result);
			  }catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}
	}	

	/* Add new book **/
	if(isset($_POST['addbtn'])){
		$kode_pasien = trim($_POST['kode_pasien']);
		$nama_pasien = trim($_POST['nama_pasien']);
		$umur = trim($_POST['umur']);
		$alamat = trim($_POST['alamat']);
		$no_kamar = trim($_POST['no_kamar']);
        $kategori_kamar = trim($_POST['kategori_kamar']);
        $nama_dokter = trim($_POST['nama_dokter']);
        $keterangan = trim($_POST['keterangan']);


		//Perform all required validations here
		if(!$kode_pasien || !$nama_pasien || !$umur || !$alamat || !$no_kamar || !$kategori_kamar || !$nama_dokter || !$keterangan ){
			$error = 'All fields are required.';
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
  <title>SOAP WSDL SEPASYSTEM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
<br>
  <h1 style="text-align: center">SOAP WSDL SEPASYSTEM</h1><br>
  <h2 style="text-align: center">Search Pasien System</h2>
  <!-- <div class="text-center">
  <img src="cuaca.png" class="rounded" alt="...">
</div> -->
  <a href="clientinsert.php" class="btn btn-success btn-md"><span class="fa fa-plus"></span> Tambah Pasien</a><br>
  <br />       
  <div class="col-sm-7">
 	 <form class="row g-3" method = 'post' name='form1'>
  		<?php if($error) { ?> 
	    	<div class="alert alert-danger">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp;<?php echo $error; ?> 
	        </div>
		<?php } ?>
		<div class="col-auto">
	    <div class="form-group">
	      <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Masukan Nama Pasien" required>
		  </div>
		  </div>
		  <div class="col-auto">
	  	  <button type="submit" name='sub' class="btn btn-primary btn-md"><span class="fa fa-search"></span> Cari Pasien<br></button>
		</div>
    </form>
   </div>
   <br />
   
   <h2>Informasi Pasien</h2>
   <br>
  <table class="table table-hover table-bordered">
    <thead class="table table-success">
      <tr>
        <th>Kode Pasien</th>
        <th>Nama Pasien</th>
        <th>Umur</th>
        <th>Alamat</th>
        <th>No Kamar</th>
        <th>Kategori Kamar</th>
        <th>Nama Dokter</th>
        <th>Keterangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php if($result){ ?>
		      <tr class="success">
		        <td><?php echo $result->kode_pasien; ?></td>
		        <td><?php echo $result->nama_pasien; ?></td>
		        <td><?php echo $result->umur; ?></td>
		        <td><?php echo $result->alamat; ?></td>	
		        <td><?php echo $result->no_kamar; ?></td>
                <td><?php echo $result->kategori_kamar; ?></td>
                <td><?php echo $result->nama_dokter; ?></td>
                <td><?php echo $result->keterangan; ?></td>
                <td><a onclick="return confirm('Apakah yakin data akan di hapus?')" href="clientdelete.php?id=<?php echo $result->id?>" 
							class="btn btn-danger btn-md"><span class="fa fa-trash"></span></a>
                </td>
              </tr>
      <?php 
  		}else{ ?>
	
  		<?php } ?>
    </tbody>
  </table>
  <br>
	 <br>
   </>
</div>
</body>
</html>



