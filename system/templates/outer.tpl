<html>
	<head>
		<title>Парсер</title>
		<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="/assets/css/style-main.css">
		<script src="/assets/js/jquery-3.2.1.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		{if isset($data.js)}
			{foreach from=$data.js item=js}
				<script src="/assets/js/{$js}.js"></script>
			{/foreach}
		{/if}
	</head>
	<body>
	    <nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Парсер</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li {if ($data.menu == 'main')}class="active"{/if}><a href="/">Поиск</a></li>
						<li {if ($data.menu == 'results')}class="active"{/if}><a href="/results">История</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			{$content}
		</div>
		<footer class="footer">
			<div class="container">
				<p class="text-muted">ssyyzz <a href="mailto:ssyyzz@ya.ru">ssyyzz@ya.ru</a></p>
			</div>
		</footer>
	</body>
</html>