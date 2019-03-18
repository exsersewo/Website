<?php
    include 'tools.php';
    $apiBaseProd = "https://api.skuldbot.uk/";
    $apiBaseDev = "https://localhost:8081/";
    $apiBase = $apiBaseDev;

    function getGlobalMoneyLB()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiBase.'money/');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $q = "";

        $q = curl_exec($ch);

        curl_close($ch);

        return json_decode($q);
    }

    function getGuildMoneyLB($guildID)
    {
        throw new Exception("Not Implemented");
        return;

        $g = filter_input ( INPUT_GET, 'g', FILTER_VALIDATE_INT, array('options'=>array('min_range' => 1)));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiBase.'money/'.$g);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $q = "";

        $q = curl_exec($ch);

        curl_close($ch);

        return json_decode($q);
    }

    function getGuildExperienceLB($guildID)
    {
        $g = filter_input ( INPUT_GET, 'g', FILTER_VALIDATE_INT, array('options'=>array('min_range' => 1)));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiBase.'experience/'.$g);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $q = "";

        $q = curl_exec($ch);

        curl_close($ch);

        return json_decode($q);
    }

    function getGlobalExperienceLB()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiBase.'experience/');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $q = "";

        $q = curl_exec($ch);

        curl_close($ch);

        return json_decode($q);
    }
?>