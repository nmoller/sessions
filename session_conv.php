<?php
/**
 * Created by PhpStorm.
 * User: nmoller
 * Date: 12/09/16
 * Time: 2:16 PM
 */

$file = 'infos_sessions.txt';
$file_data_out = "infos_sessions.js";
//effacer le ficher avant commencer
unlink($file_data_out);
$out_file = new SplFileObject($file_data_out, "w");

$out_file->fwrite("data2 = " . PHP_EOL);

$in_file = new SplFileObject($file);
$res = array(
  'web4' =>array(),
  'web5' =>array(),
  'web6' =>array()
  );
while (!$in_file->eof() && $line = $in_file->fgets() ) {
    // Le format lu est:
    //2016-08-23 11:36:02	826
    $content = explode(' ', $line);

    array_push($res[$content[0]],array($content[1], (int)$content[2], (int)trim($content[3])));



}

$parsed_data = json_encode($res);

$out_file->fwrite($parsed_data . PHP_EOL);

