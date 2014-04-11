RDateDiff
=========
Вычисление времени прошедшего между двумя датами.
Возвращает кол-во [лет, месяцев, дней, часов, минут, секунд] прошедших между двумя датами.
Работает правильно в отличие от встроенной в PHP <http://php.net/manual/ru/function.date-diff.php>

Небольшая дискуссия в блоге автора <http://savvateev.org/blog/39/>

Пример использования
--------------------
    $datetime2 = new DateTime('2014-04-01');
    $datetime1 = new DateTime('2014-02-28');

    echo '<pre>';
    print_r(RDateDiff::diff($datetime1, $datetime2));
    echo '</pre>';