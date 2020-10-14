@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if( auth()->user()->unreadNotifications()->count() > 0 )
    <a href="{{ route('admin.notifications.mark.All.Read') }}" class="btn btn-dark mb-3">Marcar todas como lidas</a>
    @endif


    <table class="table table-bordered">
        <thead>
            @if( auth()->user()->unreadNotifications()->count() > 0 )
            <tr>

                <th>Notificação</th>
                <th>Criada em</th>
                <th>Ações</th>

            </tr>
            @endif
        </thead>
        <tbody>
            @forelse($userUnreadNotifications as $notification)
            <tr>

                <!-- Pegando o atributo diretamente do objeto json $notification->data['message'] -->
                <td>{{ $notification->data['message'] }}</td>


                <!-- Formatando datas com o pacote carbon, retornado pelo Laravel quando estamos trabalhando com datas -->
                <td>{{ $notification->created_at->locale('pt-br')->diffForHumans() }}</td>

                <td>
                    <a href="{{ route('admin.notifications.mark.single.read', ['notification' => $notification->id]) }}" class="btn btn-primary float-left mr-3 mb-sm-2">Marcar como lida</a>
                </td>
            </tr>

            @empty

        <div class="alert alert-info" role="alert">
            Nenhuma notificação encontrada
        </div>

        @endforelse
        </tbody>

    </table>

</div>




@endsection

