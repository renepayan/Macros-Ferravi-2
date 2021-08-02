<?php    
    function dohttp($url, $npost, $post, $curl) {
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, $npost);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSLVERSION, 6);
        curl_setopt($curl, CURLOPT_COOKIEFILE, "c:/cookies/cookie.txt");
        curl_setopt($curl, CURLOPT_COOKIEJAR, "-");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_VERBOSE, false);
        $respuesta = curl_exec($curl);
        return $respuesta;
    }
?>

