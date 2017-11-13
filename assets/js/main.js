$(document).ready(function() {
    $("#form_type").change(function() {
		if($(this).val()==="text") $("#show_form_string").show();
		else $("#show_form_string").hide();
	});
	
	$(".form-control").change(function() {
		$(this).parent().removeClass('has-error');
	});
	
	$("#main_form").submit(function(e) {
		e.preventDefault();
		
		error = false;
		
		if($("#form_url").val()==='')
		{
			error = true;
			$("#form_url").parent().addClass('has-error');
			$("#url_help").html('Не указан URL');
		}
		else
		{
			url_match = $("#form_url").val().match(/^(https?:\/\/)?(.*?)(?:\/|$)/i);
			url_puny = punycode.toASCII(url_match[2]);
			re_url = /^(?:[a-z0-9][a-z0-9-]*[a-z0-9]\.)+(?:[a-z0-9][a-z0-9-]*[a-z0-9])(?::\d{0,5})?$/i;
			if(!(re_url.test(url_puny)))
			{
				error = true;
				$("#form_url").parent().addClass('has-error');
				$("#url_help").html('Указан некорректный домен');
			}
			else if($("#form_url").val() != url_match[0])
			{
				error = true;
				$("#form_url").parent().addClass('has-error');
				$("#url_help").html('Укажите адрес главной страницы (без пути, только домен)');
			}
		}
		
		if($("#form_type").val()==='0')
		{
			error = true;
			$("#form_type").parent().addClass('has-error');
			$("#type_help").html('Не выбран тип поиска');
		}
		
		if($("#form_type").val()==='text' && $("#form_string").val()==='')
		{
			error = true;
			$("#form_string").parent().addClass('has-error');
			$("#string_help").html('Не указан текст для поиска');
		}
		
		if(!error)
		{
			$.post("/ajax/", $("#main_form").serialize())
			.done(function(data) {
				data = $.parseJSON(data);
				if (data.error) alert(data.message);
				else window.location.href = '/results/show/'+data.id;
				
			})
			.fail(function() {
				alert("Ошибка");
			});
		}
	});
	
	$("#form_type").trigger("change");
	$(".form-control").trigger("change");
});