<?php
// Source - https://codereview.stackexchange.com/q/66660
// Posted by Laura M, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-22, License - CC BY-SA 4.0

error_reporting(0);
$timer = set_time_limit(2);
echo ("<select id='select1' align=center width=10 onchange='javascript:location.href=this.value;'>");
echo ("<option>-- select past date --</option>");
$i=1;
$j=0;
$pickdate = date("m-d-Y"); //today's date
while ($j <= 13) {
    $pickdate = mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y")); //subtract from today's date
    $new_pickdate = date('D. M. j, Y',$pickdate ); //put date in desired format for dropdown
    $postdate = date('Y/m/j',$pickdate); //put date in desired format for url
    $xml=("http://[IPremoved]/NewsLetter/postfeed?type=1&issue=".$postdate);
    $onchangeurl=("http://enews-archive.php?".$postdate);
    $dayofweek = date('N',$pickdate ); //pull day of week
    if ($dayofweek < 6) { //check for weekdays
        $xmlDoc = new DOMDocument(); //load xml to test if empty
        $xmlDoc->load($xml); //load xml to test if empty
        $channel=$xmlDoc->getElementsByTagName('channel')->item(0); //load xml to test if empty
        $pubdate = $channel->getElementsByTagName('PostDate')->item(0)->childNodes->item(0)->nodeValue; //load xml to test if empty
        $pubdatestamp = strtotime($pubdate);
        $checkdate = date('Y/m/j',$pubdatestamp); //put date in desired format to check
        if ($postdate == $checkdate)  //check if dates match
        {
            echo ('<option value='.$onchangeurl.'>'.$new_pickdate.'</option>'); //if weekday & xml not empty print it
            $j++; //add to counter if it's a valid date
        } //end match check
    } //end weekday check
    $i++; //increase subtraction from date
} //end while
echo ("</select>");
?>
