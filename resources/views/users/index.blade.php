@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-12">

            @if (Session::has('success'))
                <div class="alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            @endif

            <a href="{{ route('users.create')}}" class="btn btn-outline-success">Добавить <i class="fas fa-user-plus"></i></a></br></br>
            <div class="table-responsive">
                <table class="table table-condensed table-striped table-hover">
                    <thead>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Администратор</th>
                    <th>Транспорт</th>
                    <th></th>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id }}</td>
                            <td>{{$user->name }}</td>
                            <td>{{$user->email }}</td>
                            <td>{{ !empty($user->is_admin)?'yes':'no' }}</td>
                            <td>{{isset($user->transport->name)?$user->transport->name:'нет' }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id)}}" class="btn btn-outline-primary"><i class="fas fa-user-edit"></i></a>
                                <form action="{{ route('users.destroy', $user->id)}}" style="display: inline" method="Post">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Вы действительно хотите удалить?')" type="submit"
                                            class="btn btn-outline-danger delete"><i class="fas fa-user-slash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
