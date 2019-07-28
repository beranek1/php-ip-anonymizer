<?php
<?php
/*
#-----------------------------------------
| IP Anonymizer
| https://github.com/beranek1/ip-anonymizer
#-----------------------------------------
| made by beranek1
| https://github.com/beranek1
#-----------------------------------------
*/

function anonymize_ip($ip) {
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        $ipparts = explode(":", $ip);
        if(count($ipparts) == 8) {
            $ip = $ipparts[0].":".$ipparts[1].":".$ipparts[2]."::";
        } else {
            if($ipparts[2] == "") {
                $ip = $ipparts[0].":".$ipparts[1]."::";
            } else if($ipparts[1] == "") {
                $ip = $ipparts[0]."::";
            } else {
                $ip = $ipparts[0].":".$ipparts[1].":".$ipparts[2]."::";
            }
        }
    } else if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $ipparts = explode(".", $ip);
        if(count($ipparts) == 4) {
            $ip = $ipparts[0].".".$ipparts[1].".".$ipparts[2].".0";
        }
    }
    return $ip;
}