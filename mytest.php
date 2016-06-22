<?php
require 'PHPMailerAutoload.php';
require_once 'phpexcel/PHPExcel.php';
date_default_timezone_set('Asia/Shanghai');
//header("Content-type: text/html; charset=utf-8");

$mail = new PHPMailer;

//$receivers = array('18062458952@163.com','2486148831@qq.com');
//$mail->SMTPDebug = 2;                               // 开启详细debug输出

$mail->isSMTP();               
$mail->Host = 'smtp.163.com'; 
$mail->SMTPAuth = true;                               
$mail->Username = '18062458952@163.com';                 // 用户名
$mail->Password = '1996wjj17';                           // 注意！！！这里是授权码，不是密码
$mail->SMTPSecure = 'tls';                            // tls加密，也可设置为ssl
$mail->Port = 25;
//$mail->CharSet='GB2312';                                    

$mail->setFrom('18062458952@163.com');
// if (is_array($receivers)) {
// 	foreach ($receivers as $val) {
// 		//$mail -> ClearAddresses();  //清除保存在类中的邮件地址
// 		$mail->addAddress($val);
// 	}
// }else{
// 	$mail->addAddress($receivers);
// }
//$mail->addAddress('2486148831@qq.com', 'mhwgo');     // 接收方
//$mail->addAddress('18062458952@163.com');               // 名字可选

$filename = "contact2.xls";
$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
$objPHPExcel = $objReader->load($filename);

$column = 'C';
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	$lastRow = $worksheet->getHighestRow();
	for ($row = 2; $row <= $lastRow; $row++) {
		$cell = $worksheet->getCell($column.$row);
		if ($cell != "") {
		    echo $cell.'<br>';
			$mail->addBCC($cell); 
		}
	}
}

$mail->addReplyTo('18062458952@163.com', 'Information');//回复的人，应设置与发件人相同

//$mail->addCC('cc@example.com');//抄送
//$mail->addBCC('bcc@example.com');//密送

$mail->addAttachment('DianNewsletter_20160616_165.pdf');         // 添加附件
//$mail->addAttachment('test.png', '附件.png');    // 会识别后面名字的扩展名，如这里的pdf变成jpg就打不开了
$mail->isHTML(true);                                  // 是网页

$mail->Subject = utf8_encode('上学');//主题写成haha之类的有可能被当成垃圾邮件
// $mail->addEmbeddedImage("test.png", "my-attach", "test.png"); //设置邮件中的图片
// $mail->Body    = '<img src="cid:my-attach">';//src正确格式：cid:my-attach,如果src里写的是图片的路径的话，图片会作为附件发送;注意图片有可能会被当成垃圾邮件发不出去
$txt = GetContent('essay.txt');
echo $txt;
$mail->Body    = $txt;
$mail->AltBody = '测试';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

//读取文件内容
function GetContent($filename){
    $content = "";
	$fp = fopen($filename,"r") or die("Unable to open file!");
    $content = fread($fp,filesize($filename));
    fclose($fp);
    return $content;
}
