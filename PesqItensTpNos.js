function relatTpitemNos(){
	const controller = new AbortController(); // Controller de fetch
	const signal = controller.signal;
	var headerUTFtxt = 'text/plain; charset=utf-8';
	var myHeaders = new Headers();
	myHeaders.append('Content-Type',headerUTFtxt);
	myHeaders.append('signal',signal);		
	urlTxt = "lstPedidoItens.php";
	
	fetch(urlTxt, myHeaders)
		.then(function (response) {
			if (!response.ok) { 
				mostrAviso("Pedido sem itens.");
				abortFetch();
				return;
				//throw response ;
				}
			return response.arrayBuffer();
		})
		.then(function (buffer) {
			if( typeof(buffer) == "undefined" ){
				return;
				}
			const decoder = new TextDecoder('iso-8859-1');
			const text = decoder.decode(buffer);
			$("DIV#relint").html(text);
			console.log(text);	
			})
		.catch(function() {
			console.log("relatTpitemNos: " + "Erro na pesquisa.");
			return;
			});
	
	}
