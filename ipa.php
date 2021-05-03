<?php

function anonymize_ip($ip) {
    // Check type of ip address
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        // Split IPv6 address in parts
        $ipparts = explode(":", $ip);
        // Check whether address has maximum of 8 parts
        if(count($ipparts) == 8) {
            // Only keep the first three parts
            $ip = $ipparts[0].":".$ipparts[1].":".$ipparts[2]."::";
        } else {
            // Handle special cases
            if($ipparts[2] == "") {
                $ip = $ipparts[0].":".$ipparts[1]."::";
            } else if($ipparts[1] == "") {
                $ip = $ipparts[0]."::";
            } else {
                $ip = $ipparts[0].":".$ipparts[1].":".$ipparts[2]."::";
            }
        }
    } else if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        // Split IPv4 address in parts
        $ipparts = explode(".", $ip);
        // Check whether address consists of four parts
        if(count($ipparts) == 4) {
            // Set the last part to 0
            $ip = $ipparts[0].".".$ipparts[1].".".$ipparts[2].".0";
        }
    }
    return $ip;
}
