@extends('layout')

@section('title')Главная страница@endsection

@section('main_content')
    <main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron bg-warning">
            <div class="container">
                <h1 class="display-3">Привет iTrack!</h1>

                <p><a class="btn btn-danger btn-lg" href="/naselenie" role="button">Население »</a></p>
            </div>
        </div>


    </main>

@endsection
