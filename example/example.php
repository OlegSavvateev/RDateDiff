<?php
/**
 * Пример использования RDateDiff::diff
 * 
 * @author Oleg Savvateev <o.savvateev@gmail.com>
 */

require_once('../RDateDiff.php');

$datetime2 = new DateTime('2014-04-01');
$datetime1 = new DateTime('2014-02-28');

echo '<pre>';
print_r(RDateDiff::diff($datetime1, $datetime2));
echo '</pre>';