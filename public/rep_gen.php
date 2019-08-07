<?php
if (session_id() == '') {session_start();}
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);

header('Access-Control-Allow-Origin: *');

$action = $_GET['action'];

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "123";
$dbport = "7188";
$dbname = "instagram_smm";

// connetcion to DB
$link = new mysqli($dbservername, $dbusername, $dbpassword, $dbname, $dbport);
$link->set_charset("utf8");


// if connection errod
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} 

if ($action == 'addtowork'){
    $result  = $link->query("UPDATE rep_gen set state = 'at work' WHERE id = $_GET[id]");
}

if ($action == 'getList'){
    echo "[";
    $nEl = 0;
    #
    $result  = $link->query("SELECT id, s_date, e_date, state, file from rep_gen");
    while ($row = $result->fetch_assoc()) {
        if ($nEl > 0) {echo ",";} $nEl++;
        if ($row[state] == ''){$row[icon] = 'play_arrow';}
        if ($row[state] == 'at work'){$row[icon] = 'timer';}
        if ($row[state] == "ready"){
            $row[icon] = 'check';
            $row[state] = "true";
            $row[file2] = "http://10.28.11.66:4001/rep-gen/reports/" + $row[id] + ".hrml";
        } else {
            $row[state] = "false";
        }
        echo "{\"id\":\"$row[id]\",\"s_date\":\"$row[s_date]\", \"e_date\":\"$row[e_date]\", \"state\":\"$row[state]\", \"icon\":\"$row[icon]\", \"file\":\"http://10.28.11.66:4001/rep-gen/reports/$row[file2].html\"}";
    }
    echo "]";
}

?>