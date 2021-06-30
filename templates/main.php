<section class="page__main page__main--popular">
    <div class="container">
        <h1 class="page__title page__title--popular">Популярное</h1>
    </div>
    <div class="popular container">
        <div class="popular__filters-wrapper">
            <div class="popular__sorting sorting">
                <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
                <ul class="popular__sorting-list sorting__list">
                    <li class="sorting__item sorting__item--popular">
                        <a class="sorting__link sorting__link--active" href="#">
                            <span>Популярность</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Лайки</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Дата</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="popular__filters filters">
                <b class="popular__filters-caption filters__caption">Тип контента:</b>
                <ul class="popular__filters-list filters__list">
                    <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                        <?php if ($id) {$style_all = ''; } else
                                                        {$style_all = 'active';}
                        ?>
                        <a class="filters__button filters__button--ellipse filters__button--all filters__button--<?=$style_all; ?>" href="/index.php">
                            <span>Все</span>
                        </a>
                    </li>
                    <?php foreach ($types as $type): ?>
                        <li class="popular__filters-item filters__item">
                        <?php if ($type['id'] == $id) $style = 'active'; ?>
                            <a class="filters__button filters__button--<?=$type['filters_icon']; ?> filters__button--<?=$style; ?> button" href="/index.php?id=<?=$type['id']; ?>">
                                <span class="visually-hidden"><?=$type['name']; ?></span>
                                <svg class="filters__icon" width="<?=$type['width']; ?>" height="<?=$type['height']; ?>">
                                    <use xlink:href="#icon-filter-<?=$type['filters_icon']; ?>"></use>
                                </svg>
                        </a>
                        <?php $style=''; ?>
                        </li>
                    <?php endforeach; ?>

<!--                <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--photo button" href="#">
                            <span class="visually-hidden">Фото</span>
                            <svg class="filters__icon" width="22" height="18">
                                <use xlink:href="#icon-filter-photo"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--video button" href="#">
                            <span class="visually-hidden">Видео</span>
                            <svg class="filters__icon" width="24" height="16">
                                <use xlink:href="#icon-filter-video"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--text button" href="#">
                            <span class="visually-hidden">Текст</span>
                            <svg class="filters__icon" width="20" height="21">
                                <use xlink:href="#icon-filter-text"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--quote button" href="#">
                            <span class="visually-hidden">Цитата</span>
                            <svg class="filters__icon" width="21" height="20">
                                <use xlink:href="#icon-filter-quote"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--link button" href="#">
                            <span class="visually-hidden">Ссылка</span>
                            <svg class="filters__icon" width="21" height="18">
                                <use xlink:href="#icon-filter-link"></use>
                            </svg>
                        </a>
                    </li>
-->
                </ul>
            </div>
        </div>
        <div class="popular__posts">
        <!--итерируем массив и меняем вид карточек от типа данных -->
        <?php foreach ($posts as $key => $value): ?>
            <article class="popular__post post post-<?=$value['type']; ?>">
                <header class="post__header">
                    <a href="post.php?id=<?=$value['id']; ?>">
                        <h2><?= htmlspecialchars($value['title']); ?></h2> <!--преобразование спецсимволов-->
                    </a>
                </header>
                <div class="post__main">
                    <!--здесь содержимое карточки-->
                <?php if ($value['type'] == 'quote'): ?>
                    <blockquote>
                    <p><?= htmlspecialchars($value['content']); ?></p>  <!--преобразование спецсимволов-->
                    <cite>Неизвестный Автор</cite>
                    </blockquote>
                <?php endif; ?>
                <?php if ($value['type'] == 'link'): ?>
                    <div class="post-link__wrapper">
                        <a class="post-link__external" href="http://" title="Перейти по ссылке">
                        <div class="post-link__info-wrapper">
                            <div class="post-link__icon-wrapper">
                                <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                            </div>
                            <div class="post-link__info">
                                <h3><?= htmlspecialchars($value['title']); ?></h3>  <!--преобразование спецсимволов-->
                            </div>
                        </div>
                        <span><?= htmlspecialchars($value['link_path']); ?></span>   <!--преобразование спецсимволов-->
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($value['type'] == 'photo'): ?>
                    <div class="post-photo__image-wrapper">
                    <img src="img/<?=$value['photo_path']; ?>" alt="Фото от пользователя" width="360" height="240">
                    </div>
                <?php endif; ?>
                <?php if ($value['type'] == 'video'): ?>
                    <div class="post-video__block">
                    <div class="post-video__preview">
                        <?=embed_youtube_cover(/* вставьте ссылку на видео */); ?>
                        <img src="img/coast-medium.jpg" alt="Превью к видео" width="360" height="188">
                    </div>
                    <a href="post-details.html" class="post-video__play-big button">
                        <svg class="post-video__play-big-icon" width="14" height="14">
                            <use xlink:href="#icon-video-play-big"></use>
                        </svg>
                        <span class="visually-hidden">Запустить проигрыватель</span>
                    </a>
                    </div>
                <?php endif; ?>
                <?php if ($value['type'] == 'text') {
                        $text_flag = cut_text($value['content']); // получаем данные от функции проверки длины текста
                            if ($text_flag === $value['content']) {
                                $text = htmlspecialchars($value['content']);    //преобразование спецсимволов
                                echo ("<p>{$text}</p>");
                            }    
                            else {
                                $text_flag = htmlspecialchars($text_flag);      //преобразование спецсимволов
                                echo ("<p>$text_flag</p>");
                                echo ("<a class='post-text__more-link' href='#'>Читать далее</a>");
                            }
                        }
                ?>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <!--укажите путь к файлу аватара-->
                                <img class="post__author-avatar" src="img/<?=$value['avatar']; ?>"
                                alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name"><!--здесь имя пользоателя-->
                                <?= htmlspecialchars($value['author']); ?>      <!--преобразование спецсимволов-->
                                </b>
            <?php
            $post_date = generate_random_date($index); //генерируем случайную дату поста
            $index++;
            ?>
                                <time class="post__time" datetime="<?=$post_date?>" title="<?=date_format(date_create($post_date), 'd.m.Y H:i');?>"><?=relative_date($post_date);?></time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
        <?php endforeach; ?>
        </div>
    </div>
</section>