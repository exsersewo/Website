<?php
const Online = 'green';
const Away = 'yellow';
const Busy = 'red';
const Offline = 'grey';

//http://justinhileman.info/article/wrand-a-php-weighted-randomization-function/
function wrand($data) {
    $totalw = array_sum(array_keys($data));
    $rand   = rand(1, $totalw);

    $curw   = 0;
    foreach ($data as $i => $val) {
        $curw += $i;
        if ($curw >= $rand) return $val;
    }

    return end($data);
}

function getBotOnlineStatus($status)
{
    try
    {
        switch($status)
        {
            case 'Online':
            return Online;
            case 'Idle':
            return Away;
            case 'DoNotDisturb':
            return Busy;
            case 'Offline':
            return Offline;
        }
    }
    catch (Exception $e)
    {
        return Offline;
    }
}
function getSocialMediaLink($platform, $url)
{
    $ret = '<a href="'.$url.'" target="_blank">';

    switch($platform)
    {
        case 'Website':
        $ret = $ret.'<i class="fas fa-link"></i>';
        break;
        case 'Mixer':
        $ret = $ret.'<i class="fas fa-satellite-dish"></i>';
        break;
        case 'Twitch':
        $ret = $ret.'<i class="fab fa-twitch"></i>';
        break;
        case 'Twitter':
        $ret = $ret.'<i class="fab fa-twitter"></i>';
        break;
        case 'Youtube':
        $ret = $ret.'<i class="fab fa-youtube"></i>';
        break;
        case 'Facebook':
        $ret = $ret.'<i class="fab fa-facebook-f"></i>';
        break;
        case 'Github':
        $ret = $ret.'<i class="fab fa-github"></i>';
        break;
        case 'Newgrounds':
        $ret = $ret.'<i class="fas fa-video"></i>';
        break;
        default:
        $ret = $ret.$platform;
        break;
    }

    $ret = $ret.'</a>';
    return $ret;
}
?>