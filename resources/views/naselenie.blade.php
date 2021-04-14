@extends('layout')

@section('title')Население@endsection

@section('main_content')
    <h1>Форма добавления данных</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/naselenie/check">
        @csrf
        <input type="text" name="city" id="city" placeholder="Введите название города" class="form-control"><br>
        <input type="text" name="dohod" id="dohod" placeholder="Введите средний доход в городе" class="form-control"><br>
        <input type="text" name="rashod" id="rashod" placeholder="Введите средний расход в городе" class="form-control"><br>
        <input type="text" name="kol" id="kol" placeholder="Введите количество жителей" class="form-control"><br>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>
    <br>

    <h1>Таблица данных</h1>
    <div class="alert alert-warning">
            <table>
            <th>Название города</th>
            <th>Средние доходы населения</th>
            <th>Средние расходы населения</th>
            <th>Количество жителей</th>
            <th>Место в рейтинге по количеству жителей</th>
            <th>Место в рейтинге по средним доходам населения</th>
            <th>Место по средним расходам населения</th>
    @foreach($naselenie_ as $el)
            <tr>
            <td>{{ $el->city }}</td>
            <td>{{ $el->dohod }}</td>
            <td>{{ $el->rashod }}</td>
            <td>{{ $el->kol }}</td>
            <td>{{ $ratingKol[$el->id] }}</td>
            <td>{{ $ratingDohod[$el->id] }}</td>
            <td>{{ $ratingRashod[$el->id] }}</td>
            </tr>
    @endforeach
            </table>
        </div>
    
@endsection