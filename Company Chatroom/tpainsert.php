<?php
    $uname = $_REQUEST['uname'];
    $uname = strtoupper($uname);
    $msg = $_REQUEST['msg'];
    $msg = ucfirst($msg);

    $con = mysql_connect('localhost','root','');
    mysql_select_db('chatbox',$con);

    mysql_query("INSERT INTO logs (`username`, `msg`) VALUES ('$uname', '$msg')");

    $result1 = mysql_query("SELECT * FROM logs ORDER by date_added ASC");

    while($extract = mysql_fetch_array($result1)){
        echo $extract['username'] . ": " . $extract['msg'] . "<br>";
    }
?>


<!-- echo "<td style='color:" . ($row['Alpha'] <= 100 ? "red;": "black;") . "'>" . $row['Alpha'] . "</td>";
echo "<td style='color:" . ($row['Beta'] <= 100 ? "red;": "black;") . "'>" . $row['Beta'] . "</td>";

while($extract = mysql_fetch_array($result1)){
        echo $extract['username'] . ": " . $extract['msg'] . "<br>";
    } -->