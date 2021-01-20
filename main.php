<?php

function get_link_intra()
{
    $autologin = file_get_contents("autologin");
    $monday = date('Y-m-d', strtotime("monday this week"));
    $sunday = date('Y-m-d', strtotime("sunday this week"));

    return ("https://intra.epitech.eu/{$autologin}/planning/load?format=json&start={$monday}&end={$sunday}");

}

function get_url_data($url)
{
    $handle = curl_init();

    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_HEADER, 0);
    $page = curl_exec($handle);
    curl_close();
    return $page;
}

$model = json_decode(get_url_data(get_link_intra()));
$config = json_decode(file_get_contents("config.json"));

// file_put_contents("result", $page);

// $test = "codemodule";
// foreach ($model as $obj) {
//     var_dump($obj->$test);
// }

var_dump($config);

$module = $config->MODULE;
$datedebut = $config->DATE_DEBUT;
$datefin = $config->DATE_FIN;
$activitytitle = $config->ACTIVITI_TITLE;
$sectionregistered = $config->SECTION_REGISTERED;
$moduleregistered = $config->MODULE_REGISTERED;
$semestervalue = $config->SEMESTER_VALUE;
$codebefore = "\033";
$clearcolor = "\033[0m";

foreach ($model as $obj) {
    if ($module->DISPLAY == true) {
        echo $obj->codemodule;
        echo " ";
    }
    if ($datedebut->DISPLAY == true) {
        echo $obj->start;
        echo " ";
    }
    if ($datefin->DISPLAY == true) {
        echo $obj->end;
        echo " ";
    }
    if ($activitytitle->DISPLAY == true) {
        echo $obj->acti_title;
        echo " ";
    }
    if ($sectionregistered->DISPLAY == true) {
        if ($obj->event_registered == true) {
            echo $codebefore;
            echo "[1;32m";
            echo "Yes";
            echo $clearcolor;
        }
        else {
            echo $codebefore;
            echo $sectionregistered->COLOR;
            echo "No";
            echo $clearcolor;
        }
    }
    echo "\n";
    // if ($moduleregistered->DISPLAY == true) {
    //     echo $obj->codemodule;
    //     echo " ";
    // }
}

?>