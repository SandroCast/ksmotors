<!DOCTYPE html>
<html>
<head>
	<title>Chat-Simples</title>

	<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

	<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
</head>
<body class="bg-gray-200" onload="ajax();">

	<div class="w-3/12 py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex" style="min-height: 400px; max-height: 400px;">

				<!----- list users ----->
				<div class="w-full bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-scroll">

					<form  method="GET" action="/chat">
						<div class="flex m-2 rounded-md overflow-hidden border border-gray-300">
							<input type="text"  name="novo" class="flex-1 px-4 py-2 text-sm focus:outline-none border-none" placeholder="Nova Conversa">
							<button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2"><ion-icon name="search"></ion-icon></button>
						</div>
					</form>

					@if($novo)
						@foreach ($novo as $usuario)
							@if($usuario->id != $user->id)
								<a style="text-decoration: none;" href="/chat/novo/{{ $usuario->id }}">
						
									<li class="list-none px-4 py-2 text-lg text-gray-600 leading-7 font-semibold border-b border-t border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer">
										<p class="flex items-center">
											{{ $usuario->name }}
										</p>
									</li>
								</a>
							@endif
						@endforeach

					@else
					<script type="text/javascript">

						function ajax(){
							var req = new XMLHttpRequest();
							req.onreadystatechange = function(){
								if (req.readyState == 4 && req.status == 200) {
										document.getElementById('chat').innerHTML = req.responseText;
								}
							}
							req.open('GET', '/load', true);
							req.send();
						}
				
						setInterval(function(){ajax();}, 5000);
					</script>

					<ul id="chat" class="pl-0">

					</ul>
					@endif

				</div>

			</div>
		</div>
	</div>

</body>
</html>