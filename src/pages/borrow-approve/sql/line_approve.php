<?php
sendToLine ();

    function sendToLine (){
        $text = "อนุมัติการขอเบิกอุปกรณ์! \n";
        $text .= "เลขที่เอกสาร : ".$GLOBALS["docno"]."\n"; 
        $text .= "อนุมัติโดย : ".$_SESSION['emp_name']."\n";
        $text .= "วันที่อนุมัติ : ".date("Y-m-d H:i:s")."";
        $message = array(
            'message' => $text
        );
        notify_message($message);
    }

    function notify_message($message) {
        define('LINE_API',"https://notify-api.line.me/api/notify");
        define('LINE_TOKEN',$GLOBALS["token"]); 
    
        $queryData = http_build_query($message,'','&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                            ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                            ."Content-Length: ".strlen($queryData)."\r\n",
                'content'=> $queryData
            )
        );

        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API,FALSE,$context);
        $resp = json_decode($result);
        if ($resp->status == 200) {
            if(!empty($GLOBALS["tokenMe"])){
                sendToLineMe ();
            } else {
                echo '<script> alert("อนุมัติแล้ว!")</script>'; 
                header('Refresh:0; url="../index.php"');
            }
        } else {
            echo '<script> alert("ส่งข้อมูลไม่สำเร็จ โปรดติดต่อผู้ดูแลระบบ")</script>'; 
            header('Refresh:0; url="../index.php"');
        }
    }

    /////////////////////////////////////

    function sendToLineMe (){
        $text = "อนุมัติการขอเบิกอุปกรณ์! \n";
        $text .= "เลขที่เอกสาร : ".$GLOBALS["docno"]."\n"; 
        $text .= "อนุมัติโดย : ".$_SESSION['emp_name']."\n";
        $text .= "วันที่อนุมัติ : ".date("Y-m-d H:i:s")."";
        $message = array(
            'message' => $text
        );
        notify_messageMe($message);
    }
    error_reporting( error_reporting() & ~E_NOTICE );
    function notify_messageMe($message) {
        // define('LINE_API',"https://notify-api.line.me/api/notify");
        // define('LINE_TOKEN',$GLOBALS["tokenMe"]); 
       
        $queryDataMe = http_build_query($message,'','&');
        $headerOptionsMe = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                            ."Authorization: Bearer ".$GLOBALS["tokenMe"]."\r\n"
                            ."Content-Length: ".strlen($queryDataMe)."\r\n",
                'content'=> $queryDataMe
            )
        );

        $contextMe = stream_context_create($headerOptionsMe);
        $resultMe = file_get_contents(LINE_API,FALSE,$contextMe);
        $respMe = json_decode($resultMe);
        if ($respMe->status == 200) {
            echo '<script> alert("อนุมัติแล้ว!")</script>'; 
            header('Refresh:0; url="../index.php"');
        } else {           
           //echo '<script> alert("ส่งข้อมูลไม่สำเร็จ โปรดติดต่อผู้ดูแลระบบ")</script>'; 
           error_reporting( error_reporting() & ~E_NOTICE );
           header('Refresh:0; url="../index.php"');
        }
    }
?>