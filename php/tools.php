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
    $ret = '<a href="'.$url.'">';

    switch($platform)
    {
        case 'Website':
        $ret = $ret.'<i class="fa fa-chain"></i>';
        break;
        case 'Mixer':
        case 'Twitch':
        $ret = $ret.'<i class="fa fa-twitch"></i>';
        break;
        case 'Twitter':
        $ret = $ret.'<i class="fa fa-twitter"></i>';
        break;
        case 'Youtube':
        $ret = $ret.'<i class="fa fa-youtube-play"></i>';
        break;
        case 'Facebook':
        $ret = $ret.'<i class="fa fa-facebook"></i>';
        break;
        case 'Github':
        $ret = $ret.'<i class="fa fa-github"></i>';
        break;
        default:
        $ret = $ret.$platform;
        break;
    }

    $ret = $ret.'</a>';
    return $ret;
}
?>