<table class="table table-bordered">
	<thead>
		<tr>
			<td>№</td>
			<td>Дата</td>
			<td>URL</td>
			<td>Тип поиска</td>
			<td>Результаты</td>
		</tr>
	</thead>
	<tbody>
		{foreach from=$data.results item=result}
			<tr>
				<td>{$result.n}</td>
				<td>{$result.date}</td>
				<td><a href="/results/show/{$result.id}" target="_blank">{$result.url}</a></td>
				<td>{$result.type}{if ($result.string != '')} (<b>{$result.string|escape:'html'}</b>){/if}</td>
				<td>{$result.count}</td>
			</tr>
		{/foreach}
	</tbody>
</table>