<?php
require_once("../config/config.php");
require_once("../config/function.php");
$num = 0;
 foreach($NNL->get_list(" SELECT * FROM `license` ORDER BY id DESC ") as $row2){
                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                        $exptool2;
                                        $now2 = time();
                                        if ($row2['time'] != "") {
                                            $time2 = $row2['time'];//lấy thời gian của csdl ra
                                        
                                            $time2 = date_parse_from_format('Y-m-d H:i:s', $time2);
                                            $time_stamp2 = mktime($time2['hour'], $time2['minute'], $time2['second'], $time2['month'], $time2['day'], $time2['year']);
                                            $exptool2=($now2 - $time_stamp2) / 86400;
                                            $hsd2 =(int)$row2['day'] - (int)$exptool2;
                                            if($hsd2 > 0)
                                            {
                                            }
                                            else
                                            {    $NNL->query("DELETE from `license` where `id`='".$row2['id']."'");
                                            $num++;
                                            }
                                        }
                                    }
                                    echo "Đã xóa: ".$num." key hết hạn";
?>