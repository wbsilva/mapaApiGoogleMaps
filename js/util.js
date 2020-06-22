function Voltar(){
	location.href="index.php"	
};

function Cadastrar(){
	location.href="cadastrar.php"	
};


$(document).ready(function(){
	$("input [name='afastado']").blur(function() {
		var $type = $("input[name='type']");
		var afastado = $(this).val();

		if (afastado <= 10) {
			$("#type").val("1");
		} else {
			$("#type").val("2");
		}
	});
});

