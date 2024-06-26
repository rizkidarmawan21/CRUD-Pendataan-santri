<?php

function convertNumber($number)
{
    $nohp = $number;
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace(" ", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace("(", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")", "", $nohp);
    // kadang ada penulisan no hp 0811.239.345
    $nohp = str_replace(".", "", $nohp);

    // cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($nohp))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if (substr(trim($nohp), 0, 3) == '+62') {
            $hp = trim($nohp);
            return $hp;
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif (substr(trim($nohp), 0, 1) == '0') {
            $hp = '62' . substr(trim($nohp), 1);
            return $hp;
        }
    } else {
        $hp = 0;
        return $hp;
    }
}


function dataPerizinan($status)
{
    switch ($status) {
        case 0:
            return 'Semua Kampus';
            break;
        case 1:
            return 'Kampus 1';
            break;
        case 2:
            return 'Kampus 2';
            break;
        case 3:
            return 'Kampus 3';
            break;
        case 4:
            return 'Kampus 4';
            break;
        default:
            return 'Semua Kampus as';
            break;
    }
}
