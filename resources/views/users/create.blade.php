@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form action="{{route('users.store')}}" method="Post">
                @csrf
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email"
                           placeholder="name@example.com" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label>Администратор</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_admin" id="is_admin0" value="0" checked>
                        <label class="form-check-label" for="is_admin0">
                            Нет
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_admin" id="is_admin1" value="1">
                        <label class="form-check-label" for="is_admin1">
                            Да
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="transport_id">Транспорт</label>
                    <select class="form-control" id="transport_id" name="transport_id">
                        <option value=""></option>
                        @foreach($transport as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </div>
@endsection
