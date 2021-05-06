<?php

$count =50;
$coupon_array = array();

for($i=0; $i <$count; $i++){
	$coupon = makeCoupon();
	array_push($coupon_array, $coupon);

}

for($i=0; $i < count($coupon_array); $i++){
	$no = $i +1;
	echo $no." : ". $coupon_array[$i]."   ";
	}

function makeCoupon($j = 16){
$string = "";
    for($i=0;$i < $j;$i++){
        srand((double)microtime()*1234567);
        $x = mt_rand(0,2);
        switch($x){
            case 0:$string.= chr(mt_rand(97,122));break;
            case 1:$string.= chr(mt_rand(65,90));break;
            case 2:$string.= chr(mt_rand(48,57));break;
        }
    }
return strtoupper($string); //to uppercase
}

?>