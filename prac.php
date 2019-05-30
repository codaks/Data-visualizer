<?php 
$command = escapeshellcmd('python C:/xampp/htdocs/Mini/stat.py cereal_breakfast.csv calories n mean');
$output = shell_exec($command);
$str_arr = explode (" ", $output);
printf($str_arr[0]);
?>