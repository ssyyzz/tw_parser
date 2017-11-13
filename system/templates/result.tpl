<table class="table table-bordered">
	<thead>
		<tr>
			<td>Дата</td>
			<td>URL</td>
			<td>Тип поиска</td>
			<td>Результаты</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{$data.result.date}</td>
			<td>{$data.result.url}</td>
			<td>{$data.result.type}{if ($data.result.string != '')} (<b>{$data.result.string|escape:'html'}</b>){/if}</td>
			<td>{$data.result.count}</td>
		</tr>
		{foreach from=$data.result.result item=result}
			<tr>
				<td colspan="4">
					<pre>{$result}</pre>
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>