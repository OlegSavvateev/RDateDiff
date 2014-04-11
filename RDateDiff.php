<?php
/**
 * PHP класс для нахождения разности между двумя датами
 * 
 * @author Oleg Savvateev <o.savvateev@gmail.com>
 */

class RDateDiff {

    /**
     * Вычисление времени прошедшего между двумя датами
     * @param DateTime $datetime1 Первая дата
     * @param DateTime $datetime2 Вторая дата. Если не задана, то принимается как текущая дата.
     * @return array Кол-во [лет, месяцев, дней, часов, минут, секунд] прошедших между двумя датами
     * @throws InvalidArgumentException
     */
    static function diff($datetime1, $datetime2 = null){

        //Если вторая дата не задана принимаем ее как текущую
        if(is_null($datetime2)) $datetime2 = new DateTime();

        //Проверяем параметры
        if(!($datetime1 instanceof DateTime)) throw new InvalidArgumentException('Параметр date1 должен быть объектом DateTime');
        if(!($datetime2 instanceof DateTime)) throw new InvalidArgumentException('Параметр date2 должен быть объектом DateTime');

        //Преобразуем даты в массив
        $d1 = array_map('intval', explode('-', $datetime1->format('Y-m-d-H-i-s')));
        $d2 = array_map('intval', explode('-', $datetime2->format('Y-m-d-H-i-s')));

        //Если вторая дата меньше чем первая, меняем их местами
        for($i=0; $i<count($d2); $i++) {
            if($d2[$i]>$d1[$i]) break;
            if($d2[$i]<$d1[$i]) {
                list($d1,$d2) = array($d2,$d1);
                break;
            }
        }

        //Вычисляем разность между датами (как в столбик)
        $diff = array(null, null, null, null, null);
        $md1 = array(31, $d1[0]%4||(!($d1[0]%100)&&$d1[0]%400)?28:29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $minV1 = array(null, 1, 1, 0, 0, 0);
        $maxV1 = array(null, 12, $md1[$d1[1]-1], 23, 59, 59);
        for($i=5; $i>0; $i--) {
            if($d1[$i]>$maxV1[$i]){
                $d1[$i-1]++;
                $d1[$i]=$minV1[$i];
            }
            if($d2[$i]<$d1[$i]){
                $d1[$i-1]++;
                $diff[$i] = $d2[$i]+($maxV1[$i]-$minV1[$i]+1)-$d1[$i];
            }
            else {
                $diff[$i] = $d2[$i]-$d1[$i];
            }
        }
        $diff[0] = $d2[0]-$d1[0];

        //Возвращаем результат
        return $diff;
    }
} 