<?php
/**
 * Функции шаблона (function.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */

add_theme_support('title-tag');

register_nav_menus(array(
	'top' => 'top',
	'bottom' => 'bottom'
));

add_theme_support('post-thumbnails'); // включаем поддержку миниатюр
set_post_thumbnail_size(250, 150); // задаем размер миниатюрам 250x150
add_image_size('big-thumb', 400, 400, true); // добавляем еще один размер картинкам 400x400 с обрезкой

register_sidebar(array( // регистрируем левую колонку, этот кусок можно повторять для добавления новых областей для виджитов
	'name' => 'Сайдбар', // Название в админке
	'id' => "sidebar", // идентификатор для вызова в шаблонах
	'description' => 'Обычная колонка в сайдбаре', // Описалово в админке
	'before_widget' => '<div id="%1$s" class="widget %2$s">', // разметка до вывода каждого виджета
	'after_widget' => "</div>\n", // разметка после вывода каждого виджета
	'before_title' => '<span class="widgettitle">', //  разметка до вывода заголовка виджета
	'after_title' => "</span>\n", //  разметка после вывода заголовка виджета
));

if (!class_exists('clean_comments_constructor')) { // если класс уже есть в дочерней теме - нам не надо его определять
	class clean_comments_constructor extends Walker_Comment { // класс, который собирает всю структуру комментов
		public function start_lvl( &$output, $depth = 0, $args = array()) { // что выводим перед дочерними комментариями
			$output .= '<ul class="children">' . "\n";
		}
		public function end_lvl( &$output, $depth = 0, $args = array()) { // что выводим после дочерних комментариев
			$output .= "</ul><!-- .children -->\n";
		}
	    protected function comment( $comment, $depth, $args ) { // разметка каждого комментария, без закрывающего </li>!
	    	$classes = implode(' ', get_comment_class()).($comment->comment_author_email == get_the_author_meta('email') ? ' author-comment' : ''); // берем стандартные классы комментария и если коммент пренадлежит автору поста добавляем класс author-comment
	        echo '<li id="comment-'.get_comment_ID().'" class="'.$classes.' media">'."\n"; // родительский тэг комментария с классами выше и уникальным якорным id
	    	echo '<div class="media-left">'.get_avatar($comment, 64, '', get_comment_author(), array('class' => 'media-object'))."</div>\n"; // покажем аватар с размером 64х64
	    	echo '<div class="media-body">';
	    	echo '<span class="meta media-heading">Автор: '.get_comment_author()."\n"; // имя автора коммента
	    	//echo ' '.get_comment_author_email(); // email автора коммента, плохой тон выводить почту
	    	echo ' '.get_comment_author_url(); // url автора коммента
	    	echo ' Добавлено '.get_comment_date('F j, Y в H:i')."\n"; // дата и время комментирования
	    	if ( '0' == $comment->comment_approved ) echo '<br><em class="comment-awaiting-moderation">Ваш комментарий будет опубликован после проверки модератором.</em>'."\n"; // если комментарий должен пройти проверку
	    	echo "</span>";
	        comment_text()."\n"; // текст коммента
	        $reply_link_args = array( // опции ссылки "ответить"
	        	'depth' => $depth, // текущая вложенность
	        	'reply_text' => 'Ответить', // текст
				'login_text' => 'Вы должны быть залогинены' // текст если юзер должен залогинеться
	        );
	        echo get_comment_reply_link(array_merge($args, $reply_link_args)); // выводим ссылку ответить
	        echo '</div>'."\n"; // закрываем див
	    }
	    public function end_el( &$output, $comment, $depth = 0, $args = array() ) { // конец каждого коммента
			$output .= "</li><!-- #comment-## -->\n";
		}
	}
}

if (!function_exists('pagination')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
	function pagination() { // функция вывода пагинации
		global $wp_query; // текущая выборка должна быть глобальной
		$big = 999999999; // число для замены
		$links = paginate_links(array( // вывод пагинации с опциями ниже
			'base' => str_replace($big,'%#%',esc_url(get_pagenum_link($big))), // что заменяем в формате ниже
			'format' => '?paged=%#%', // формат, %#% будет заменено
			'current' => max(1, get_query_var('paged')), // текущая страница, 1, если $_GET['page'] не определено
			'type' => 'array', // нам надо получить массив
			'prev_text'    => 'Назад', // текст назад
	    	'next_text'    => 'Вперед', // текст вперед
			'total' => $wp_query->max_num_pages, // общие кол-во страниц в пагинации
			'show_all'     => false, // не показывать ссылки на все страницы, иначе end_size и mid_size будут проигнорированны
			'end_size'     => 15, //  сколько страниц показать в начале и конце списка (12 ... 4 ... 89)
			'mid_size'     => 15, // сколько страниц показать вокруг текущей страницы (... 123 5 678 ...).
			'add_args'     => false, // массив GET параметров для добавления в ссылку страницы
			'add_fragment' => '',	// строка для добавления в конец ссылки на страницу
			'before_page_number' => '', // строка перед цифрой
			'after_page_number' => '' // строка после цифры
		));
	 	if( is_array( $links ) ) { // если пагинация есть
		    echo '<ul class="pagination">';
		    foreach ( $links as $link ) {
		    	if ( strpos( $link, 'current' ) !== false ) echo "<li class='active'>$link</li>"; // если это активная страница
		        else echo "<li>$link</li>"; 
		    }
		   	echo '</ul>';
		 }
	}
}

add_action('wp_footer', 'add_scripts'); // приклеем ф-ю на добавление скриптов в футер
if (!function_exists('add_scripts')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
	function add_scripts() { // добавление скриптов
	    if(is_admin()) return false; // если мы в админке - ничего не делаем
	    wp_deregister_script('jquery'); // выключаем стандартный jquery
	    wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js','','',true);
	    wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js','','',true);
	    wp_enqueue_script('main', '/public/js/main.js','','',true);
	}
}

add_action('wp_print_styles', 'add_styles'); // приклеем ф-ю на добавление стилей в хедер
if (!function_exists('add_styles')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
	function add_styles() { // добавление стилей
	    if(is_admin()) return false; // если мы в админке - ничего не делаем
	    wp_enqueue_style( 'animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css' );
	    wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css' );
		wp_enqueue_style( 'main', '/public/css/common.css' );
	}
}

function admin_style() {
	wp_enqueue_style( 'main', '/public/css/common.css' );
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/css/admin.css' );
}
add_action('admin_enqueue_scripts', 'admin_style');

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		acf_register_block(array(
			'name'				=> 'intro-header',
			'title'				=> __('Доп заголовок'),
			'description'		=> __('Дополнительный заголовок серого цвета'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'common',
			'icon'				=> '<svg viewBox="0 0 24 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<title>Group</title>
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<g id="Group" fill="#808080">
						<rect id="Rectangle" x="0" y="0" width="24" height="4"></rect>
						<rect id="Rectangle" x="0" y="5" width="18" height="4"></rect>
					</g>
				</g>
			</svg>',
			'example'           => []
		));
		acf_register_block(array(
			'name'				=> 'main-subtitle',
			'title'				=> __('H3'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'common',
			'icon'				=> '<svg width="24px" height="5px" viewBox="0 0 24 5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<title>Group</title>
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<g id="Group">
						<rect id="Rectangle" fill="#FFDA2E" x="4" y="4" width="20" height="1"></rect>
						<rect id="Rectangle" fill="#808080" x="0" y="0" width="18" height="3"></rect>
					</g>
				</g>
			</svg>',
			'example'           => []
		));
		acf_register_block(array(
			'name'				=> 'link-pdf',
			'title'				=> __('Ссылка PDF'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'common',
			'icon'				=> '<svg width="20px" height="24px" viewBox="0 0 20 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<title>pdf</title>
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<g id="pdf" fill="#333333" fill-rule="nonzero">
						<path d="M16.8620903,21.5931871 C16.6679226,21.5931871 16.510529,21.7505806 16.510529,21.9447484 L16.510529,22.9466323 C16.510529,23.1397935 16.3533677,23.2969548 16.160129,23.2969548 L1.15780645,23.2969548 C0.964629677,23.2969548 0.807460645,23.1397935 0.807460645,22.9466323 L0.807460645,4.59223742 C0.807460645,4.39808516 0.650053161,4.24067613 0.455897032,4.24067613 C0.261740903,4.24067613 0.104334968,4.39808516 0.104334968,4.59223742 L0.104334968,22.9466323 C0.104334968,23.5275097 0.576881806,24.0000774 1.15780645,24.0000774 L16.1602065,24.0000774 C16.7410839,24.0000774 17.213729,23.5275097 17.213729,22.9466323 L17.213729,21.9447484 C17.213729,21.7505806 17.0562581,21.5931871 16.8620903,21.5931871 Z" id="Path"></path>
						<path d="M0.455897032,3.30698323 C0.650053161,3.30698323 0.807460645,3.14957419 0.807460645,2.95542194 L0.807460645,1.05346839 C0.807460645,0.860299355 0.964629677,0.703124903 1.15780645,0.703124903 L12.713729,0.703124903 L12.713729,4.14778065 C12.713729,4.34194065 12.8710452,4.49934194 13.0652129,4.49934194 L16.5106065,4.4999071 L16.5106065,11.6712774 C16.5106065,11.8654452 16.668,12.0228387 16.8621677,12.0228387 C17.0563355,12.0228387 17.213729,11.8654452 17.213729,11.6712774 L17.213729,4.14843871 C17.213729,4.05520258 17.1766452,3.96576774 17.1107613,3.89986065 L13.3138839,0.102984 C13.2479226,0.0370312258 13.1585806,0 13.0652903,0 L1.1578529,0 C0.576928258,0 0.104334968,0.472594065 0.104334968,1.05346839 L0.104334968,2.95542194 C0.104334968,3.14957419 0.261740903,3.30698323 0.455897032,3.30698323 Z M13.4168516,1.20027871 L16.0132645,3.79673806 L13.4168516,3.79631226 L13.4168516,1.20027871 Z" id="Shape"></path>
						<path d="M18.8989161,12.6997161 L4.46257548,12.6997161 C4.26841548,12.6997161 4.11101419,12.8571097 4.11101419,13.0512774 L4.11101419,20.5512774 C4.11101419,20.7454452 4.26841548,20.9028387 4.46257548,20.9028387 L7.21005677,20.9028387 C7.40421677,20.9028387 7.56162581,20.7454452 7.56162581,20.5512774 C7.56162581,20.3571097 7.40421677,20.1997161 7.21005677,20.1997161 L4.81413677,20.1997161 L4.81413677,13.4028387 L18.5473548,13.4028387 L18.5473548,20.1997161 L8.83889032,20.1997161 C8.64472258,20.1997161 8.48732903,20.3571097 8.48732903,20.5512774 C8.48732903,20.7454452 8.64472258,20.9028387 8.83889032,20.9028387 L18.8988387,20.9028387 C19.0930065,20.9028387 19.2504,20.7454452 19.2504,20.5512774 L19.2504,13.0512774 C19.2504,12.8571097 19.0930839,12.6997161 18.8989161,12.6997161 Z" id="Path"></path>
						<path d="M12.8729806,6.16254968 L4.46257548,6.16254968 C4.26841548,6.16254968 4.11101419,6.31995871 4.11101419,6.51411097 C4.11101419,6.70827097 4.26841548,6.86567226 4.46257548,6.86567226 L12.8729806,6.86567226 C13.0671484,6.86567226 13.2245419,6.70827097 13.2245419,6.51411097 C13.2245419,6.31995871 13.0671484,6.16254968 12.8729806,6.16254968 Z" id="Path"></path>
						<path d="M12.8729806,8.23579355 L4.46257548,8.23579355 C4.26841548,8.23579355 4.11101419,8.39326452 4.11101419,8.58735484 C4.11101419,8.78152258 4.26841548,8.93891613 4.46257548,8.93891613 L12.8729806,8.93891613 C13.0671484,8.93891613 13.2245419,8.78152258 13.2245419,8.58735484 C13.2245419,8.39326452 13.0671484,8.23579355 12.8729806,8.23579355 Z" id="Path"></path>
						<path d="M12.8729806,10.3506581 L11.2114065,10.3506581 C11.0173161,10.3506581 10.8598452,10.5080516 10.8598452,10.7022194 C10.8598452,10.8963871 11.0173161,11.0537806 11.2114065,11.0537806 L12.8729806,11.0537806 C13.0671484,11.0537806 13.2246194,10.8963871 13.2246194,10.7022194 C13.2246194,10.5080516 13.0671484,10.3506581 12.8729806,10.3506581 Z" id="Path"></path>
						<path d="M4.46257548,10.3506581 C4.26841548,10.3506581 4.11101419,10.5080516 4.11101419,10.7022194 C4.11101419,10.8963871 4.26841548,11.0537806 4.46257548,11.0537806 L9.5568,11.0537806 C9.75096774,11.0537806 9.90836129,10.8963871 9.90836129,10.7022194 C9.90836129,10.5080516 9.75096774,10.3506581 9.5568,10.3506581 L4.46257548,10.3506581 Z" id="Path"></path>
						<path d="M9.41125161,16.0321548 L9.41125161,15.3894194 C9.41125161,14.7712258 8.90833548,14.2683097 8.29014194,14.2683097 L6.80141419,14.2683097 C6.60725419,14.2683097 6.44984516,14.4257032 6.44984516,14.619871 L6.44984516,18.9836129 C6.44984516,19.1777806 6.60725419,19.3351742 6.80141419,19.3351742 C6.99556645,19.3351742 7.15297548,19.1777806 7.15297548,18.9836129 L7.15297548,17.1533419 L8.29014194,17.1533419 C8.90825806,17.1532645 9.41125161,16.6503484 9.41125161,16.0321548 Z M8.70812903,16.0321548 C8.70812903,16.2626323 8.52061935,16.4501419 8.29014194,16.4501419 L7.15297548,16.4501419 L7.15297548,14.9714323 L8.29014194,14.9714323 C8.52061935,14.9714323 8.70812903,15.1589419 8.70812903,15.3894194 L8.70812903,16.0321548 Z" id="Shape"></path>
						<path d="M16.6556903,14.9712774 C16.8498581,14.9712774 17.0072516,14.8138839 17.0072516,14.6197161 C17.0072516,14.4255484 16.8498581,14.2681548 16.6556903,14.2681548 L14.3974452,14.2681548 C14.2032774,14.2681548 14.0458839,14.4255484 14.0458839,14.6197161 L14.0458839,18.9834581 C14.0458839,19.1776258 14.2032774,19.3350194 14.3974452,19.3350194 C14.5916129,19.3350194 14.7490065,19.1776258 14.7490065,18.9834581 L14.7490065,17.1531871 L16.6556903,17.1531871 C16.8498581,17.1531871 17.0072516,16.9957161 17.0072516,16.8016258 C17.0072516,16.6074581 16.8498581,16.4500645 16.6556903,16.4500645 L14.7490065,16.4500645 L14.7490065,14.9712774 L16.6556903,14.9712774 L16.6556903,14.9712774 Z" id="Path"></path>
						<path d="M12.0401032,19.3351742 C12.6582968,19.3351742 13.1612129,18.8322581 13.1612129,18.2140645 L13.1612129,15.3894194 C13.1612129,14.7712258 12.6582968,14.2683097 12.0401032,14.2683097 L10.5514065,14.2683097 C10.3572387,14.2683097 10.1998452,14.4257032 10.1998452,14.619871 L10.1998452,18.9836129 C10.1998452,19.1777806 10.3572387,19.3351742 10.5514065,19.3351742 L12.0401032,19.3351742 L12.0401032,19.3351742 Z M10.9029677,14.9714323 L12.0401032,14.9714323 C12.2705806,14.9714323 12.4580903,15.1589419 12.4580903,15.3894194 L12.4580903,18.2139871 C12.4580903,18.4444645 12.2705806,18.6319742 12.0401032,18.6319742 L10.9029677,18.6319742 L10.9029677,14.9714323 Z" id="Shape"></path>
					</g>
				</g>
			</svg>',
			'example'           => []
		));
	}
}

function my_acf_block_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/templates/block/{$slug}.php") ) ) {
		include( get_theme_file_path("/templates/block/{$slug}.php") );
	}
}

if (!class_exists('bootstrap_menu')) {
	class bootstrap_menu extends Walker_Nav_Menu { // внутри вывод 
		private $open_submenu_on_hover; // параметр который будет определять раскрывать субменю при наведении или оставить по клику как в стандартном бутстрапе

		function __construct($open_submenu_on_hover = true) { // в конструкторе
	        $this->open_submenu_on_hover = $open_submenu_on_hover; // запишем параметр раскрывания субменю
	    }

		function start_lvl(&$output, $depth = 0, $args = array()) { // старт вывода подменюшек
			$output .= "\n<ul class=\"dropdown-menu\">\n"; // ул с классом
		}
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) { // старт вывода элементов
			$item_html = ''; // то что будет добавлять
			parent::start_el($item_html, $item, $depth, $args); // вызываем стандартный метод родителя
			if ( $item->is_dropdown && $depth === 0 ) { // если элемент содержит подменю и это элемент первого уровня
			   if (!$this->open_submenu_on_hover) $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"', $item_html); // если подменю не будет раскрывать при наведении надо добавить стандартные атрибуты бутстрапа для раскрытия по клику
			   $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html); // ну это стрелочка вниз
			}
			$output .= $item_html; // приклеиваем теперь
		}
		function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) { // вывод элемента
			if ( $element->current ) $element->classes[] = 'active'; // если элемент активный надо добавить бутстрап класс для подсветки
			$element->is_dropdown = !empty( $children_elements[$element->ID] ); // если у элемента подменю
			if ( $element->is_dropdown ) { // если да
			    if ( $depth === 0 ) { // если li содержит субменю 1 уровня
			        $element->classes[] = 'dropdown'; // то добавим этот класс
			        if ($this->open_submenu_on_hover) $element->classes[] = 'show-on-hover'; // если нужно показывать субменю по хуверу
			    } elseif ( $depth === 1 ) { // если li содержит субменю 2 уровня
			        $element->classes[] = 'dropdown-submenu'; // то добавим этот класс, стандартный бутстрап не поддерживает подменю больше 2 уровня по этому эту ситуацию надо будет разрешать отдельно
			    }
			}
			parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output); // вызываем стандартный метод родителя
		}
	}
}

?>
