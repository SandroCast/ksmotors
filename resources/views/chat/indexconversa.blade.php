<!DOCTYPE html>
<html>
<head>
	<title>Chat-Simples</title>
	<script type="text/javascript">
		var cont = 0;
		function ajax(){

			var req = new XMLHttpRequest();
			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
					
					if(document.querySelectorAll('.message').length != num){
						document.querySelectorAll('.message:last-child')[0].scrollIntoView();
					}
					if(cont < 1){
						document.querySelectorAll('.message:last-child')[0].scrollIntoView();
						cont ++;
					}
				}	
			}
			req.open('GET', '/conversa/{{$idconversa}}', true);
			req.send();
			var num = document.querySelectorAll('.message').length;
		}
		setInterval(function(){ajax();}, 5000);
	</script>

	<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">

	<style>
		body{
			background-color: #F4F4F8;
		}
		#chat {
			
		}

		.me {
            opacity: 25;
            background-color:#EBF0FF;
        }
        .to {
            opacity: 25;
            background-color:#F4F4F8;
        }

		
	</style>

</head>
<body onload="ajax();">

	<div class="w-4/12 py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex" style="min-height: 400px; max-height: 400px;">
	
				<!----- box message ----->
				<div class="w-full flex flex-col justify-between">

					<!----- nome ----->
					<div class="w-full bg-gray-500 border border-gray-300 bg-opacity-25 p-3 pl-5 text-lg text-gray-600 leading-7 font-semibold flex">
						<label for="">
							@if($nome->from == $userlogado->id)
								{{ $nome->userto->name }}
							@else
								{{ $nome->userfrom->name }}
							@endif
						</label>

					</div>

					<!----- message ----->
					<div id="chat" class="w-full p-6 flex flex-col overflow-y-scroll">

					</div>

					<!--- form --->
					<div class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
						
						<form  method="post" action="/enviar/{{ $idconversa }}">
							@method('POST')
							@csrf
							<div class="flex rounded-md overflow-hidden border border-gray-300">
								<input type="text"  name="mensagem" class="flex-1 px-4 py-2 text-sm focus:outline-none border-none" placeholder="mensagem" autofocus>
								<button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2">Enviar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>