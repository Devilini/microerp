@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Здравствуйте, {{$user->name}}<br>
                        Информация по Вашему транспорту:
                    </div>
                </div>
                @if ($user->transport)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <th>№</th>
                            <th>Название</th>
                            <th>Цвет</th>
                            <th>Год</th>
                            <th>Статус</th>
                            <th>Тип</th>
                            <th>Дата регистрации</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$user->transport->id }}</td>
                                <td>{{$user->transport->name  }}</td>
                                <td>{{$user->transport->color  }}</td>
                                <td>{{$user->transport->year  }}</td>
                                <td>{{$user->transport->status  }}</td>
                                <td>{{$user->transport->type->name  }}</td>
                                <td>{{$user->transport->created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body">
                        На данный момент у вас нет Транспорта
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-12">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-header"></div>--}}
    {{--                    <div class="card-body">--}}
    {{--                        Здравствуйте, {{$user[0]->name}}--}}
    {{--                        Ваш служебный транспорт {{$user[0]->transport->name}}--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="table-responsive">--}}
    {{--                    <table class="table">--}}
    {{--                        <thead>--}}
    {{--                        <th>№</th>--}}
    {{--                        <th>Название</th>--}}
    {{--                        <th>Цвет</th>--}}
    {{--                        <th>Год</th>--}}
    {{--                        <th>Статус</th>--}}
    {{--                        <th>Тип</th>--}}
    {{--                        <th>Дата регистрации</th>--}}
    {{--                        </thead>--}}
    {{--                        <tbody>--}}
    {{--                        <tr>--}}
    {{--                            <td>{{$user[0]->transport->id }}</td>--}}
    {{--                            <td>{{$user[0]->transport->name  }}</td>--}}
    {{--                            <td>{{$user[0]->transport->color  }}</td>--}}
    {{--                            <td>{{$user[0]->transport->year  }}</td>--}}
    {{--                            <td>{{$user[0]->transport->status  }}</td>--}}
    {{--                            <td>{{$user[0]->transport->type->name  }}</td>--}}
    {{--                            <td>{{$user[0]->transport->created_at}}</td>--}}
    {{--                        </tr>--}}
    {{--                        </tbody>--}}
    {{--                    </table>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
