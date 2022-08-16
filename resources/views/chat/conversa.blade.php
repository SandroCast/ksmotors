@if($mensagens)
    @foreach ($mensagens as $mensagem)

        <div class="w-full mb-3 message  @php if($mensagem->from == $user->id){echo 'text-right';}else{echo '';}@endphp">

            <p class="inline-block p-2 rounded-md @php if($mensagem->from == $user->id){echo 'me';}else{echo 'to';}@endphp" style="max-width: 75%;">
                {{ $mensagem->content }}
            </p>

            @if($mensagem->from == $user->id && $mensagem->visa == 2)
            <img class="inline-block" style="max-width: 75%;" src="{{URL::asset('/ico/visualizado.ico')}}" alt="profile Pic" height="15" width="15">
            @elseif($mensagem->from == $user->id && $mensagem->visa == 1)
            <img class="inline-block" style="max-width: 75%;" src="{{URL::asset('/ico/entregue.ico')}}" alt="profile Pic" height="15" width="15">
            @elseif($mensagem->from == $user->id && $mensagem->visa == 0)
            <img class="inline-block" style="max-width: 75%;" src="{{URL::asset('/ico/enviado.ico')}}" alt="profile Pic" height="15" width="15">
            @endif

            <span class="block mt-1 @php if($mensagem->from == $user->id){echo 'mx-5';}@endphp text-xs text-gray-500">{!! date('d/m/Y H:i', strtotime($mensagem->created_at)) !!}</span>
            
        </div>
        
    @endforeach
@endif