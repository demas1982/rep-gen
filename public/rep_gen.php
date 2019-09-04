<?php
if (session_id() == '') {session_start();}
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);

header('Access-Control-Allow-Origin: *');

$action = $_SERVER['PATH_INFO'];

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

if ($action == '/startWork'){
    system('c://ts//server2go-ts//server//Perl2//bin//perl.exe c://ts//server2go-ts//cgi-bin//pvd_scan//scan2.pl');
    system('c://ts//server2go-ts//server//Perl2//bin//perl.exe c://ts//server2go-ts//cgi-bin//rep-gen-pl//script.pl');
}

if ($action == '/delete'){
    $result  = $link->query("DELETE from rep_gen where id = ". $_GET['id']);
    echo "delete from rep_gen where id = $_GET[id]";
}

if ($action == '/addReport'){
    $s_date = explode(".", $_GET[s_date]);
    $e_date = explode(".", $_GET[e_date]);
    $result  = $link->query("INSERT into rep_gen (created, s_date, e_date, state, reportid) values (curdate(),'$s_date[2]-$s_date[1]-$s_date[0]', '$e_date[2]-$e_date[1]-$e_date[0]', '', $_GET[reportid])");
}

if ($action == '/getList'){
    echo "[";
    $nEl = 0;
    #
    $result  = $link->query("SELECT id, created, s_date, e_date, state, file from rep_gen where reportid = $_GET[id] order by id desc");
    while ($row = $result->fetch_assoc()) {
        if ($nEl > 0) {echo ",";} $nEl++;
        if ($row[state] == ''){$row[icon] = 'play_arrow';}
        if ($row[state] == 'at work'){$row[icon] = 'timer';}
        if ($row[state] == "ready"){
            $row[icon] = 'check';
            $row[state] = "true";
            $row[file2] = "http://10.28.11.66:4001/rep-gen/reports/" + $row[id] + ".hrml";
        } else {
            $row[state] = "";
        }
        echo "{\"id\":\"$row[id]\",\"created\":\"$row[created]\",\"s_date\":\"$row[s_date]\", \"e_date\":\"$row[e_date]\", \"state\":\"$row[state]\", \"icon\":\"$row[icon]\", \"file\":\"http://10.28.11.66:4001/rep-gen/reports/$row[file2].html\",  \"file2\":\"http://10.28.11.66:4001/rep-gen/reports/$row[file2].csv\"}";
    }
    echo "]";
}

if ($action == '/getReports'){
    echo "[";
    $nEl = 0;
    #
    $result  = $link->query("SELECT id, name from rep_gen_reports order by id desc");
    while ($row = $result->fetch_assoc()) {
        if ($nEl > 0) {echo ",";} $nEl++;
        echo "{\"id\":\"$row[id]\",\"name\":\"$row[name]\"}";
    }
    echo "]";
}
?>