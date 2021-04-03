<?php
require_once('helpers.php'); // подключаем файл с функциями
$is_auth = rand(0, 1);
$user_name = 'Oleg';         // укажите здесь ваше имя
$index = 0;//переменная-счётчик для функции generate_random_date
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

/**
 * Функция возврата даты в относительном формате
 * @param string $post_date дата публикации блога в виде строки
 */
function relative_date(string $post_date) {
    //define('WEEK', 7); //Warning: Constant WEEK already defined in ...
    $date_int = null;
    $noun_plural_form = null;

    $dt_current = date_create('now');
    $dt_date = date_create($post_date);
    $dt_diff = date_diff($dt_current, $dt_date);
    $date_diff_unix = strtotime(date_interval_format($dt_diff, '%Y-%M-%D %H:%I'));

    switch(true){
        case ($date_diff_unix < strtotime ('00-00-00 01:00')):
            $date_int = idate('i', $date_diff_unix);
            $noun_plural_form = get_noun_plural_form($date_int, "минуту", "минуты", "минут");
            break;
        case ($date_diff_unix < strtotime('00-00-01 00:00')):
            $date_int = idate('H', $date_diff_unix);
            $noun_plural_form = get_noun_plural_form    ($date_int, "час", "часа", "часов");
            break;
        case ($date_diff_unix < strtotime('00-00-07 00:00')):
            $date_int = idate('d', $date_diff_unix);
            $noun_plural_form = get_noun_plural_form   ($date_int, "день", "дня", "дней");
            break;
        case ($date_diff_unix   < strtotime('00-01-00 00:00')):
            $date_int = floor(idate('d', $date_diff_unix) /7); //вместо WEEK
            $noun_plural_form = get_noun_plural_form   ($date_int, "неделю", "недели", "недель");
            break;
        default:
            $date_int = idate('m', $date_diff_unix) + 1; //считает на 1 месяц меньше
            $noun_plural_form = get_noun_plural_form    ($date_int, "месяц", "месяца", "месяцев");
            break;
    }
    return "$date_int $noun_plural_form назад";
}

$page_content = include_template('main.php', [
    'posts' => $posts,
    'index' => $index
    ]);
$layout_content = include_template ('layout.php', [
    'contents' => $page_content,
    'title' => 'readme: популярное',
    'is_auth' =>  $is_auth,
    'user_name' => $user_name,
]);

print($layout_content);
?> 