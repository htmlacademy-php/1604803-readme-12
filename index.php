<?php
require_once('helpers.php'); // подключаем файл с функциями
$is_auth = rand(0, 1);
$user_name = 'Oleg';         // укажите здесь ваше имя
date_default_timezone_set('Europe/Moscow'); // устанавливаем Московское время

// добавляем массив карточек с данными для поста
$posts = [
    [
    'title' => 'Цитата',
    'type' => 'post-quote',
    'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
    'author' => 'Лариса',
    'avatar' => 'userpic-larisa-small.jpg'
    ],
    [
    'title' => 'Игра престолов',
    'type' => 'post-text',
    'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!',
    'author' => 'Владик',
    'avatar' => 'userpic.jpg',
    ],
    [
    'title' => 'Наконец, обработал фотки!',
    'type' => 'post-photo',
    'content' => 'rock-medium.jpg',
    'author' => 'Виктор',
    'avatar' => 'userpic-mark.jpg',
    ],
    [
    'title' => 'Моя мечта',
    'type' => 'post-photo',
    'content' => 'coast-medium.jpg',
    'author' => 'Лариса',
    'avatar' => 'userpic-larisa-small.jpg'
    ],
    [
    'title' => 'Лучшие курсы',
    'type' => 'post-link',
    'content' => 'www.htmlacademy.ru',
    'author' => 'Владик',
    'avatar' => 'userpic.jpg',
    ],
]; 
// создаём функцию для корректировки текста в текстовом посте ('type' => 'post-text')
function cut_text (string $text, int $num_letters = 300) {
    $text_arr = explode (" ", $text);   // преобразуем полученную строку в массив
    $new_text_arr = [];                 // объявляем новый массив
    $str_length = 0;                     // общая длина строки
    foreach ($text_arr as $key => $value) { // перебираем элементы массива до заданного количества символов
        $val_count = mb_strlen($value);     // считаем количество символов в элементе
        $str_length += $val_count;
            if ($str_length < $num_letters) {
                $new_text_arr[] = $value;
            }
            else {
                $new_cat_text = implode(" ",$new_text_arr); //создаём новую
                $new_cat_text .="...";                      // сокращённую строку
                break;      // и прерываем foreach 
            }
    }
    return $str_length < $num_letters ? $text : $new_cat_text;
}

//создаём функцию для вывода временного интервала
//$date_blog дата публикации блога в формате unix
//$date_curr текущая дата в формате unix
function relative_date(int $date_blog, int $date_curr) {
    $secs_in_minute = 60;         // секунд в минуте;
    $secs_in_hour = 3600;         // секунд в часе
    $secs_in_day = 86400;         // секунд в сутках
    $secs_in_week = 604800;       // секунд в неделе
    $secs_in_five_week = 3024000; //секунд в 5 неделях

    $diff = $date_curr - $date_blog;

    if ($diff<$secs_in_hour) {
        $diff_calc = ceil($diff / $secs_in_minute);
        $plural_form = get_noun_plural_form($diff_calc, "минута", "минуты", "минут");
    }
    if ($diff >= $secs_in_hour && $diff < $secs_in_day) {
        $diff_calc = ceil($diff / $secs_in_hour);
        $plural_form = get_noun_plural_form($diff_calc, "час", "часа", "часов");
    }
    if ($diff >= $secs_in_day && $diff < $secs_in_week) {
        $diff_calc = ceil($diff / $secs_in_day);
        $plural_form = get_noun_plural_form($diff_calc, "день", "дня", "дней");
    }
    if ($diff >= $secs_in_week && $diff < $secs_in_five_week) {
        $diff_calc = ceil($diff / $secs_in_week);
        $plural_form = get_noun_plural_form($diff_calc, "неделя", "недели", "недель");
    }
    if ($diff >= $secs_in_five_week) {
        $diff_calc = ceil($diff / $secs_in_five_week);
        $plural_form = get_noun_plural_form($diff_calc, "месяц", "месяца", "месяцев");
    }
    $relative_time = $diff_calc. " ". $plural_form. " ". "назад";
    return $relative_time;
}

$page_content = include_template('main.php', ['posts' => $posts]);
$layout_content = include_template ('layout.php', [
    'contents' => $page_content,
    'title' => 'readme: популярное',
    'is_auth' =>  $is_auth,
    'user_name' => $user_name,
]);

print($layout_content);
?> 