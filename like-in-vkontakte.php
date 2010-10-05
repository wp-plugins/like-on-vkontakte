	<?php
	/*
	Plugin Name: Like in Vkontakte
	Version: 0.3
	Plugin URI: http://blog.chekalskiy.ru/post/647/
	Description: Добавляет к постам виджет "Мне нравится" из ВКонтакте.
	Author: Ilya Chekaslkiy
	Author URI: http://www.chekalskiy.ru/

	Основан на "Share on Vkontakte Plugin"
	*/


	// Create the options page
	function like_in_vkontakte_options_page() {
		$current_options = get_option('like_in_vkontakte_options');
		
		$in_page =  $current_options["in_page"];
		$in_post =  $current_options["in_post"];
		$in_frontpage =  $current_options["in_frontpage"];
		$in_arhives =  $current_options["in_arhives"];
		$align_vertical =  $current_options["align_vertical"];
		$css =  $current_options["css"];
		$addtype =  $current_options["addtype"];
		$btn_width =  $current_options["btn_width"];
		$app_id =  $current_options["app_id"];


		if ($_POST['action']){ ?>
			<div id="message" class="updated fade"><p><strong>Настройки сохранены.</strong></p></div>
		<?php } ?>
		<div class="wrap" id="like-in-vkontakte-options">
			<h2>Настройки плагина Like in Vkontakte</h2>

			<form method="post" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
				<fieldset>
					<input type="hidden" name="action" value="save_like_in_vkontakte_options" />
					<table width="100%" cellspacing="2" cellpadding="5" class="editform">
						<colgroup width="200" align="left" valign="top" span="1" />
						<colgroup width="*" align="left" valign="top" span="1" />
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td valign="top">Отображать</td>
							<td><input type="checkbox" name="in_post" value="1" <?php echo ($in_post)?' checked="checked"':''; ;?> /> <label for="in_post">В постах</label></td>
						</tr>
						<tr>
							<td valign="top"></td>
							<td><input type="checkbox" name="in_frontpage" value="1" <?php echo ($in_frontpage)?' checked="checked"':''; ;?> /> <label for="in_frontpage">На главной</label></td>
						</tr>
						<tr>
							<td valign="top"></td>
							<td><input type="checkbox" name="in_arhives" value="1" <?php echo ($in_arhives)?' checked="checked"':''; ;?> /> <label for="in_arhives">В архивах (категория, тэги, поиск)</label></td>
						</tr>
						<tr>
							<td valign="top"></td>
							<td><input type="checkbox" name="in_page" value="1" <?php echo ($in_page)?' checked="checked"':''; ;?> /> <label for="in_page">На страницах</label></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td valign="top"><label for="align_vertical">Вставлять в запись:</label></td>
							<td><select name="align_vertical" style="width: 250px;">
							<option value ="top" <?php if ($align_vertical === "top") echo 'selected="selected"';?>>Сверху</option>
							<option value ="bottom"<?php if ($align_vertical === "bottom") echo 'selected="selected"';?>>Снизу</option>
							</select></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td valign="top"> <label for="css">Inline CSS:</label></td>
							<td><textarea name="css" style="width: 300px;height: 100px;"><? echo $css; ?></textarea></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td valign="top"><label for="addtype">Добавлять:</label></td>
							<td><select name="addtype" style="width: 250px;">
							<option value ="auto" <?php if ($addtype === "auto") echo 'selected="selected"';?>>Автоматически</option>
							<option value ="manual"<?php if ($addtype === "manual") echo 'selected="selected"';?>>Вручную</option>
							</select></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><td colspan="2"><hr /></td></tr>
						<tr><td colspan="2"><h2>Настройки виджета</h2></td></tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td valign="top"><label for="btn_width">Ширина области</label></td>
							<td><input type="text" name="btn_width" style="width: 250px;" value="<?php echo ($btn_width); ;?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="app_id">ID приложения</label></td>
							<td><input type="text" name="app_id" style="width: 250px;" value="<?php echo ($app_id); ;?>" /></td>
						</tr>
					</table>
				</fieldset>
				<p class="submit">
					<input type="submit" name="Submit" value="Сохранить настройки &raquo;" />
				</p>
			</form>
			<ul>
				<li>Для ручного добавления виджета необходимо вставить &lt;!--vklike--&gt; в текст поста.</li>
				<li>Настраивать внешний вид кнопки можно с помощью класса "vklike".</li>
				<li>© <a href="http://www.chekalskiy.ru/" target="_blank">Чекальский Илья</a>.</li>
			</ul>
		</div>
	<?php
	}

	// Add a new menu under Options
	function like_in_vkontakte_add_options_page() {
		add_options_page('Like in Vkontakte', 'Like in Vkontakte', 10, __FILE__, 'like_in_vkontakte_options_page');
	}

	// Save options
	function like_in_vkontakte_save_options() {
		$like_in_vkontakte_options["in_page"] =  $_POST["in_page"];
		$like_in_vkontakte_options["in_post"] =  $_POST["in_post"];
		$like_in_vkontakte_options["in_frontpage"] =  $_POST["in_frontpage"];
		$like_in_vkontakte_options["in_arhives"] =  $_POST["in_arhives"];
		$like_in_vkontakte_options["align_vertical"] =  $_POST["align_vertical"];
		$like_in_vkontakte_options["css"] =  $_POST["css"];
		$like_in_vkontakte_options["addtype"] =  $_POST["addtype"];
		$like_in_vkontakte_options["btn_width"] =  $_POST["btn_width"];
		$like_in_vkontakte_options["app_id"] =  $_POST["app_id"];


		update_option('like_in_vkontakte_options', $like_in_vkontakte_options);
		$options_saved = true;
	}

	function like_in_vkontakte_add_js ($str) {
		$current_options = get_option('like_in_vkontakte_options');
		$app_id = intval($current_options["app_id"]);	
		echo '<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?1"></script>
		<script type="text/javascript">
		  VK.init({apiId: '.$app_id.', onlyWidgets: true});
		</script>';
		return false;
	}

	function like_in_vkontakte_add_to_page($postval) {
		global $post;
		$current_options = get_option('like_in_vkontakte_options');	
		$in_page =  $current_options["in_page"];
		$in_post =  $current_options["in_post"];
		$in_frontpage =  $current_options["in_frontpage"];
		$in_arhives =  $current_options["in_arhives"];
		$align_vertical =  $current_options["align_vertical"];
		$align_horizontal =  $current_options["align_horizontal"];
		$css =  $current_options["css"];
		$addtype =  $current_options["addtype"];
		$btn_width =  $current_options["btn_width"];
		$app_id =  $current_options["app_id"];

		$style = '';
		if ($align_horizontal != 'none')
			$style='';
		$style ='style="'.$style.$css.'"';
		
		$btn_width = ($btn_width)?$btn_width:'496';
		$id_post = get_the_ID();
		$vk = "<div id=\"vk_like{$id_post}\"{$style} class=\"vklike\"></div>
			<script type=\"text/javascript\">
				VK.Widgets.Like(\"vk_like{$id_post}\", {width: \"{$btn_width}\", pageTitle: '".the_title('', '', false)."', pageUrl: '".get_permalink($post->ID)."', page_id: {$id_post}});
			</script>";
		
		if (
				(is_home() && $in_frontpage) ||
				(is_front_page() && $in_frontpage) ||
				(is_single() && $in_post) ||
				(is_page() && $in_page) ||
				(is_archive() && $in_arhives)
			) {
			if ($addtype == 'auto') {
				if ($align_vertical == 'top') {
					$postval = $vk.$postval;
				} else {
					$postval .= $vk;
				}
				$postval = str_replace ('<!--vklike-->', '', $postval);
			} else {
				$postval = str_replace ('<!--vklike-->', $vk, $postval);
			}
		}

		return $postval;
	}

	// Create default options
	if (!get_option('like_in_vkontakte_options')){
		$like_in_vkontakte_options["in_page"] = '0'; // 1 or 0
		$like_in_vkontakte_options["in_post"] = '1'; // 1 or 0
		$like_in_vkontakte_options["in_frontpage"] = '1'; // 1 or 0
		$like_in_vkontakte_options["in_arhives"] = '0'; // 1 or 0
		$like_in_vkontakte_options["align_vertical"] = 'top'; // top, bottom
		$like_in_vkontakte_options["css"] = 'display:inline;margin: 5px 0;'; // css inline
		$like_in_vkontakte_options["addtype"] = 'auto'; // auto or manual
		$like_in_vkontakte_options["btn_width"] =  '496';
		$like_in_vkontakte_options["app_id"] =  '';

		update_option('like_in_vkontakte_options', $like_in_vkontakte_options);
	}

	if ($_POST['action'] == 'save_like_in_vkontakte_options'){
		like_in_vkontakte_save_options();
	}

	add_action('wp_head', 'like_in_vkontakte_add_js');
	add_action('admin_menu', 'like_in_vkontakte_add_options_page');
	add_action('the_content', 'like_in_vkontakte_add_to_page');

	?>