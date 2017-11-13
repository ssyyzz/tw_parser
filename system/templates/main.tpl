<form id="main_form" method="POST">
	<div class="form-group">
		<label for="form_url">URL главной страницы сайта</label>
		<input name="url" type="text" class="form-control" id="form_url" placeholder="Введите URL">
		<small id="url_help" class="form-text text-muted"></small>
	</div>
	<div class="form-group">
		<label for="form_type">Тип поиска</label>
		<select name="type" id="form_type" class="form-control">
			<option value="0" selected>Выберите тип поиска</option>
			<option value="link">Ссылки</option>
			<option value="image">Картинки</option>
			<option value="text">Текст</option>
		</select>
		<small id="type_help" class="form-text text-muted"></small>
	</div>
	<div class="form-group" id="show_form_string" style="display:none">
		<label for="form_string">Поиск по строке</label>
		<input name="string" type="text" class="form-control" id="form_string" placeholder="Введите текст">
		<small id="string_help" class="form-text text-muted"></small>
	</div>
	<div class="form-group">
		<input class="btn btn-default btn-right" type="submit" name="submit" value="Найти">
	</div>
</form>