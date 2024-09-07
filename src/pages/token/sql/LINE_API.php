<?php 
    include_once('../../php/authen.php');

    $sql = "SELECT `line` FROM `line` WHERE `id` = '1'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $GLOBALS["token"] = $row['line'];

       sendToLine();
    
    function sendToLine (){
        $text = "การแจ้งเตือนใหม่จะถูกส่งที่ไลน์นี้";
        $message = array(
            'message' => $text
        );
        notify_message($message);
    }

    function notify_message($message) {
        define('LINE_API',"https://notify-api.line.me/api/notify");
        define('LINE_TOKEN',  $GLOBALS["token"]); 
       
    
       
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
            echo '<script> alert("บันทึกสำเร็จ")</script>'; 
            header('Refresh:0; url="../index.php"');
        } else {
           echo '<script> alert("โทเคนนี้ไม่มีจริง กรุณากรอกใหม่")</script>'; 
           header('Refresh:0; url="../index.php"');
        }
    }

?>