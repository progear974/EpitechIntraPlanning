<?php

function get_range_of_this_week()
{
    $autologin = file_get_contents("autologin");
    $monday = date('Y-m-d', strtotime("monday this week"));
    $sunday = date('Y-m-d', strtotime("sunday this week"));

    echo "https://intra.epitech.eu/{$autologin}/planning/load?format=json&start={$monday}&end={$sunday}";

}

get_range_of_this_week();

?>