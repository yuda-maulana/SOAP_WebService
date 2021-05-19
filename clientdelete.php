<?php
    require_once('dbconn.php');
    require_once('lib/nusoap.php');
    $error  = '';
    $result = array();
    $response = '';
    $wsdl = "http://localhost/webservices/server.php?wsdl";
        global $dbconn;
    
        if(isset($_GET["id"])){
            $query = $dbconn->prepare("DELETE FROM `pasien` WHERE id=:id");
            $query->bindParam(":id", $_GET["id"]);
            $result = $query->execute();
            echo '<script>alert("Berhasil menghapus data");window.location="client.php"</script>';
            return $result;
        }
?>