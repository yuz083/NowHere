		<?php
			function date_status($stdate, $endate)
			{
				$ret = array();
				$now = date("Y-m-d H:i:s");
				$st = $stdate;
				$end = $endate;
				
				if ( $end < $now )
				{
					array_push($ret,"danger","종료됨");
				}
				elseif ($now > $st)
				{
					array_push($ret,"primary", "진행중");
				}
				else
				{
					array_push($ret,"warning", "시작전");
				}
				return $ret;
			}

			function statusString($status)
			{
				switch ($status) {
					case 0:
						$ret =array("label-danger","발급전");
						break;
					case 1:
						$ret =array("label-warning","사용전");
						break;
					case 2:
						$ret =array("label-success","사용함");
						break;
				}
				return $ret;
			}
		?>