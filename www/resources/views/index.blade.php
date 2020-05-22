<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовое задание</title>
    <link href="{!! asset('css/app.css')  !!}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div class="content-form">
    <div class="title">Введите данные населённого пункта</div>
    <form action="{{ route('marker.store') }}" method="POST" id="marker" class="form">
        <div class="result-info"></div>
        @csrf
        <fieldset>
            <div class="row">
                <div class="side-left">
                    <label for="name">Название:<span class="red">*</span> </label>
                </div>
                <div class="side-right">
                    <input name="name" type="text" id="name" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="side-left">
                    <label for="latitude">Широта:<span class="red">*</span> </label>
                </div>
                <div class="side-right">
                    <input name="latitude" type="text" id="latitude" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="side-left">
                    <label for="longitude">Долгота:<span class="red">*</span> </label>
                </div>
                <div class="side-right">
                    <input name="longitude" type="text" id="longitude" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="side-left">
                    <label for="count_population">Количество населения (чел.):<span class="red">*</span></label>
                </div>
                <div class="side-right">
                    <input name="count_population" type="text" id="count_population" class="form-control">
                </div>
            </div>

            <div class="send">
                <input class="btn" type="submit" value="Отправить">
            </div>
        </fieldset>
    </form>
</div>
@if (count($markers =  App\Models\Marker::all()) > 0)
    <div class="content-table">

        <table class="markers" border="1">
            <tbody>
            <tr>
                <td>Название населенного пункта</td>
                <td>Широта</td>
                <td>Долгота</td>
                <td>Количество населения (чел.)</td>
            </tr>
            @foreach($markers as $marker)
                <tr>
                    <td>{{ $marker['name'] }}</td>
                    <td>{{ $marker['latitude'] }}</td>
                    <td>{{ $marker['longitude'] }}</td>
                    <td>{{ $marker['count_population'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endif
<script src="{!! asset('js/jquery-3.5.1.js') !!}"></script>
<script src="{!! asset('js/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('js/scripts.js') !!}"></script>
</body>
</html>
