
<form action="/index.php?action=add" method="post"  enctype="multipart/form-data">
	<table>
	<tr>
		<td><label for="form_input_file"> Выберите картинку:</label></td>
		<td>
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
			<input id="form_input_file" type="file" name="file">
		</td>
		
	</tr>
	<br>
	<tr>
		<td><label for="form_input_tags"> Введите теги через запятую:</label></td>
		<td><input id="form_input_tags" type="text" name="tags"></td>
		
	</tr>
	<tr>
		<td><input type="hidden" name="task" value="add"></td>
		<td><input type="submit" value="Загрузить"></td>
		
	</tr>
	</table>
</form>