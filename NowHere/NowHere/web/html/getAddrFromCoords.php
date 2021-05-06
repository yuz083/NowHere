
<?php
	function getRegion($x, $y)
	{
		$client_id = "2Q2nvrKJF4f_0PCaTUbb";
		$client_secret = "cXJx8GpAzj";
		$encText = "x=".$x."&y=".$y;
		$url = "https://dapi.kakao.com/v2/local/geo/coord2address.json?".$encText; // json
		// $url = "https://openapi.naver.com/v1/map/geocode.xml?query=".$encText; // xml

		$is_post = false;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $is_post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		$headers[] = "Authorization: KakaoAK a3bd7e576008b3b9a1eb69d698789230";

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//echo "status_code:".$status_code."<br>";
		  
		if($status_code == 200) {
		    /*echo $response;*/
			$arr = json_decode($response,true);
			$arr2 = $arr["documents"][0]["address"];
			 
			$region = $arr2["region_1depth_name"]." ".$arr2["region_2depth_name"]." ".$arr2["region_3depth_name"];
			   
		} else {
			$region ="";
		}
		curl_close ($ch);
		return $region;
	}
		
		
?>