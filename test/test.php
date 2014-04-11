<?php
/**
 * Тест RDateDiff::diff
 *
 * Методика тестирования следующая:
 * 1. Генерируется N пар дат.
 * 2. Вычисляется разность между ними, при помощи RDateDiff::diff и встроенной в PHP DateTime::diff (PHP 5 >= 5.3.0).
 * 3. Выводятся все результаты, которые не совпали.
 * 
 * @author Oleg Savvateev <o.savvateev@gmail.com>
 */

require_once('../RDateDiff.php');

$N = 1000;

echo '<table border="1" cellpadding="12"><thead><tr><th>№</th><th>DateTime1</th><th>DateTime2</th><th>RDateDiff::diff</th><th>PHP diff</th></tr></thead>';
$err_count = 0;
for($i=0; $i<$N; $i++){
    $datetime1 = getDateTime();
    $datetime2 = getDateTime();
    $diff1 = RDateDiff::diff($datetime1, $datetime2);
    $interval = $datetime1->diff($datetime2);
    $diff2 = array($interval->y, $interval->m, $interval->d, $interval->h, $interval->i, $interval->s);

    if($diff1 != $diff2){
        $err_count++;
        echo '<tr><td>'.$i.'</td><td>'.$datetime1->format('Y-m-d H:i:s').'</td><td>'.$datetime2->format('Y-m-d H:i:s').'</td><td>['.implode(", ", $diff1).']</td><td>['.implode(", ", $diff2).']</td></tr>';
    }
}
echo '</table>';
echo $err_count/$N * 100 . '%';



// Эта функция генерирует случайный DateTime и возвращает его
function getDateTime(){
    $y = rand(1, 5300);
    $m = rand(1, 12);
    $md = array(31, $y%4?28:29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $d = rand(1, $md[$m-1]);
    $t = array(rand(0,23), rand(0,59), rand(0,59));
    $datetime = new DateTime("$y-$m-$d $t[0]:$t[1]:$t[2]");
    return $datetime;
}