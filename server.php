<?php

 require_once('dbconn.php');
 require_once('lib/nusoap.php'); 
 $server = new nusoap_server();

 /* Fungsi insert pasien */
function insertPasien($kode_pasien, $nama_pasien, $umur, $alamat, $no_kamar, $kategori_kamar, $nama_dokter, $keterangan){
  global $dbconn;
  $sql_insert = "INSERT INTO pasien (kode_pasien, nama_pasien, umur, alamat, no_kamar, kategori_kamar, nama_dokter, keterangan) VALUES 
  ( :kode_pasien, :nama_pasien, :umur, :alamat, :no_kamar, :kategori_kamar, :nama_dokter, :keterangan)";
  $stmt = $dbconn->prepare($sql_insert);
  $result = $stmt->execute(array(':kode_pasien'=>$kode_pasien, ':nama_pasien'=>$nama_pasien, ':umur'=>$umur, ':alamat'=>$alamat, ':no_kamar'=>$no_kamar, ':kategori_kamar'=>$kategori_kamar, ':nama_dokter'=>$nama_dokter, ':keterangan'=>$keterangan));
  if($result) {
    return json_encode(array('status'=> 200, 'msg'=> 'success'));
  }
  else {
    return json_encode(array('status'=> 400, 'msg'=> 'fail'));
  }
  
  $dbconn = null;
  }
/* Fungsi menampilkan 1 data */
function tampilPasien($nama_pasien){
	global $dbconn;
	$sql = "SELECT id, kode_pasien, nama_pasien, umur, alamat, no_kamar, kategori_kamar, nama_dokter, keterangan FROM pasien 
	        where nama_pasien = :nama_pasien";
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':nama_pasien', $nama_pasien);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return json_encode($data);
    $dbconn = null;
}

function hapusPasien() {
    global $dbconn;
    if(isset($_GET["id"])){
        $query = $dbconn->prepare("DELETE FROM `pasien` WHERE id=:id");
        $query->bindParam(":id", $_GET["id"]);
        $result = $query->execute();
        header("location: client.php");
        return $result;
    }
}

$server->configureWSDL('pasienServer', 'urn:pasien');
$server->register('tampilPasien',
			array('nama_pasien' => 'xsd:string'),  //parameter
			array('data' => 'xsd:string'),  //output
			'urn:pasien',   //namespace
			'urn:pasien#tampilPasien' //soapaction
      );  
$server->register('insertPasien',
			array('kode_pasien' => 'xsd:string', 'nama_pasien' => 'xsd:string', 'umur' => 'xsd:string', 'alamat' => 'xsd:string', 'no_kamar' => 'xsd:string', 'kategori_kamar' => 'xsd:string', 'nama_dokter' => 'xsd:string', 'keterangan' => 'xsd:string'),  //parameter
			array('data' => 'xsd:string'),  //output
			'urn:pasien',   //namespace
			'urn:pasien#tampilPasien' //soapaction
			);  

$server->register('hapusPasien',
			array('id' => 'xsd:string'),  //parameter
			array('data' => 'xsd:string'),  //output
			'urn:pasien',   //namespace
			'urn:pasien#hapusPasien' //soapaction
			); 
$server->service(file_get_contents("php://input"));

?>