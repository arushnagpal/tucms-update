<?php
if (function_exists('date_default_timezone_set'))
{
  date_default_timezone_set('Asia/Calcutta');
}
function format_date($str) {
    $month = array(" ", "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec");
    $y = explode(' ', $str);
    $x = explode('-', $y[0]);
    $date = "";
    $m = (int) $x[1];
    $m = $month[$m];
    $st = array(1, 21, 31);
    $nd = array(2, 22);
    $rd = array(3, 23);
    if (in_array($x[2], $st)) {
        $date = $x[2] . 'st';
    } else if (in_array($x[2], $nd)) {
        $date .= $x[2] . 'nd';
    } else if (in_array($x[2], $rd)) {
        $date .= $x[2] . 'rd';
    } else {
        $date .= $x[2] . 'th';
    }
    $date .= ' ' . $m . ' ' . $x[0];
    return $date;
}

?>