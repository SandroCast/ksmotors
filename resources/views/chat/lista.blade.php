@php
use App\Models\Message;
@endphp
@if($mensagens)
    @foreach ($mensagens as $mensagem)
            @php
                $visa = Message::where([
                    ['duo', $mensagem->duo],
                    ['to', $user->id],
                    ['visa', '<', 2]
                ])->get();

            @endphp

        <a style="text-decoration: none;" href="/chat/{{ $mensagem->id }}">

            <li class="px-4 py-2 text-lg leading-7 font-semibold border-b border-t border-gray-200 hover:bg-gray-200 hover:bg-opacity-50 hover:cursor-pointer @php if(count($visa) > 0){echo 'text-gray-900';}else{echo 'text-gray-600';} @endphp">
                <p class="flex items-center">
                    @if($mensagem->userfrom->name == $user->name)
                        {{ $mensagem->userto->name }}
                    @else
                        {{ $mensagem->userfrom->name }}
                    @endif
                    @if(count($visa) > 0)
                    <span class="ml-2 w-2 h-2 bg-blue-500 rounded-full"></span>
                    @endif
                </p>
            </li>
        </a>
    @endforeach
@endif