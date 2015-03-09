<?php
header('Content-Type: application/json');


if(isset($_GET["c"])) {
    $output = "";
    if($_GET["c"] == "play") {
        $output = shell_exec('mkfifo /tmp/mplayer-control');
        $output .= shell_exec('mplayer -slave -input file=/tmp/mplayer-control http://icecast.omroep.nl/3fm-bb-mp3 > /tmp/mplayer-status.log&'); // TODO maybe point to a file and read it for status?
        $output .= "start finished";
    } elseif($_GET["c"] == "stop") {
        //$output = shell_exec('echo "quit" > /tmp/mplayer-control');
        //$output = shell_exec('echo "volume 0" > /tmp/mplayer-control');
        //$output = "test";
        //$output = shell_exec('/var/www/html/radio-control.sh > /dev/null&');
        //$output = exec('bash -c "exec nohup setsid /var/www/html/radio-control.sh > /tmp/mplayer-error.log 2>&1 &"');
        $output = exec("pkill mplayer");
        $output .= "quit finished";
    } elseif($_GET["c"] == "info") {
        //$output = shell_exec("cat /tmp/mplayer-status.log | grep \"ICY Info:\"");
        $output = shell_exec("cat /tmp/mplayer-status.log | grep \"ICY Info:\" | tail -n 1");
    }
    $arr = array('status' => 'succes', 'message' => $output);
    echo json_encode($arr);


}


/*
if(isset($_GET["c"]) && $_GET["c"] == "start") {
    $output = shell_exec('mplayer http://icecast.omroep.nl/3fm-bb-mp3');
    //echo json_encode("{\"status\": \"success\", \"message\": \"$output\"}");
    //echo "{\"status\": \"success\", \"message\": \"$output\"}";
    $arr = array('status' => 'succes', 'message' => $output);
    echo json_encode($arr);
}
*/

//$output = shell_exec('id -u -n'); // what is the php user? www-data

// if(isset($_GET["c"]) && $_GET["c"] == "play") {
//     $output = shell_exec('mkfifo /tmp/mplayer-control');
//     $output .= shell_exec('mplayer -slave -input file=/tmp/mplayer-control http://icecast.omroep.nl/3fm-bb-mp3 > /tmp/mplayer-status.log&'); // TODO maybe point to a file and read it for status?
//     $output .= "start finished";
//     $arr = array('status' => 'succes', 'message' => $output);
//     echo json_encode($arr);
// }

// if(isset($_GET["c"]) && $_GET["c"] == "stop") {
//     //$output = shell_exec('echo "quit" > /tmp/mplayer-control');
//     //$output = shell_exec('echo "volume 0" > /tmp/mplayer-control');
//     //$output = "test";
//     //$output = shell_exec('/var/www/html/radio-control.sh > /dev/null&');
//     //$output = exec('bash -c "exec nohup setsid /var/www/html/radio-control.sh > /tmp/mplayer-error.log 2>&1 &"');
//     $output = exec("pkill mplayer");
//     $output .= "quit finished";
//     $arr = array('status' => 'succes', 'message' => $output);
//     echo json_encode($arr);
// }

// if(isset($_GET["c"]) && $_GET["c"] == "info") {
//     //$output = shell_exec("cat /tmp/mplayer-status.log");
//     $output = shell_exec("cat /tmp/mplayer-status.log | grep \"ICY Info:\"");
//     $arr = array('status' => 'succes', 'message' => $output);
//     echo json_encode($arr);
// }




/*
martin@broek:~$ echo "quit" > sudo tee /tmp/mplayer-control
martin@broek:~$ echo "q" > sudo tee /tmp/mplayer-control



this works on shell:
mplayer -slave -input file=/tmp/mplayer-control2 http://icecast.omroep.nl/3fm-bb-mp3 > /dev/null&
echo "volume -10" > /tmp/mplayer-control2
echo "quit" > /tmp/mplayer-control2

but doesn't work through site


http://www.mplayerhq.hu/DOCS/tech/slave.txt

slave mode commands:

volume
mute
quite
pause





# now trying VLC
sudo apt-get install vlc-nox

*/

?>