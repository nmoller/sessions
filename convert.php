<?php
/**
 * Created by PhpStorm.
 * User: nmoller
 * Date: 23/08/16
 * Time: 3:56 PM
 */
//$file = '/home/nmoller/moodle/my_cron/logged_sessions.txt';
$file = '/home/nmoller/moodle/my_cron/sessions1.txt';
$file_data_out = "sessions1.js";
//effacer le ficher avant commencer
unlink($file_data_out);
$out_file = new SplFileObject($file_data_out, "w");

$out_file->fwrite("data = [" . PHP_EOL);

$in_file = new SplFileObject($file);
while ($line = $in_file->fgets()) {
    // Le format lu est:
    //2016-08-23 11:36:02	826
    $content = explode(' ', $line);
    $content2 = explode("\t", $content[1]);

    $date = explode('-', $content[0]);
    $hour = explode(':', $content[1]);
    convert_array_values_to_int($date);
    convert_array_values_to_int($hour);

    // Mois commencent à zero en js
    $date[1] = $date[1] - 1;

    $parsed_line = "{ time : new Date($date[0], $date[1], $date[2], $hour[0], $hour[1]), nbr : $content2[1]},";

    $out_file->fwrite($parsed_line . PHP_EOL);

}

$out_file->fwrite(PHP_EOL. "];");

/**
 * Le zero devant un chiffre génére un message d'erreur dans js.
 * @param array $array
 */
function convert_array_values_to_int(array &$array) {
    foreach ($array as $key => $value) {
        $array[$key] = (int) $value;
    }
}