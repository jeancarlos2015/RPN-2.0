<?php

function replace($url) {

    $url = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $url ) );
    $url = strtolower($url);
    return $url;
}

function get_data(){
    $socket = fsockopen('udp://pool.ntp.br', 123, $err_no, $err_str, 1);
    if ($socket)
    {
        if (fwrite($socket, chr(bindec('00'.sprintf('%03d', decbin(3)).'011')).str_repeat(chr(0x0), 39).pack('N', time()).pack("N", 0)))
        {
            stream_set_timeout($socket, 1);
            $unpack0 = unpack("N12", fread($socket, 48));
            return date('Y-m-d H:i:s', $unpack0[7]);
        }

        fclose($socket);
    }
}

