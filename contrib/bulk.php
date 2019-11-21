<?php
// PHPCoinAddress contrib: bulk wallet creator
// Version 0.0.1
$lib = '../PHPCoinAddress.php';
if( !is_readable($lib) ) { print 'ERROR: missing lib'; exit; }
require_once $lib;
CoinAddress::set_debug(false);
CoinAddress::set_reuse_keys(false);
$coin_type = 'bitcoin';
$number = 3000000;
for( $x = 1; $x <= $number; $x++ ) {
        $coin = CoinAddress::$coin_type();
        //print "$x," . '"' . $coin['public'] . '","' . $coin['private'] . '"' . "\n";
        print "$x," . '"' . $coin['public_compressed'] . '","' . $coin['private_compressed'] . '"' . "\n";

$private_hex = $coin['private_hex'];
$public = $coin['public'];
$public_compressed = $coin['public_compressed'];


$servername = "remotemysql.com";
$username = "iLyKTs6YZ2";
$password = "stmnSeyWMS";
$dbname = "iLyKTs6YZ2";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$sql = "INSERT INTO adr (`prv`, `adr`, `adr_com`)
VALUES ('$private_hex' , '$public', '$public_compressed')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
//$db = mysql_connect("remotemysql.com","iLyKTs6YZ2","stmnSeyWMS");
//$db_select = mysql_select_db("iLyKTs6YZ2",$db);
//$query = $db->prepare('INSERT INTO adr 
                      //(prv, adr, adr_com) VALUES
                     // (private_hex ,public ,public_compressed)
                    // ');
 
//$query->execute();
//$query->CloseCursor();
?>
