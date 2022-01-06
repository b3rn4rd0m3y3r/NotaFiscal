	// Mostra um aviso (pela DIV#aviso), em local fixo, por 4 segundos
	function mostrAviso(txt){
		$("DIV#aviso").text(txt);
		$("DIV#aviso").css("left","500px");
		$("DIV#aviso").css("display","block");
		setTimeout(escondAviso,4000);
		}
		
	// Esconde o aviso de acordo com o tempo padrão do mostrAviso
	function escondAviso(){
		$("DIV#aviso").css("left","-800px");
		$("DIV#aviso").css("display","none");
		}