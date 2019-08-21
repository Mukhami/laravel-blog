<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel-Blog</title>
    <!-- Latest compiled and minified CSS -->
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"--}}
{{--          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
<!--    Font Awesome Link-->
    <script src="https://kit.fontawesome.com/8a8859a4e6.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/bootstrap.min.css') }}">
    <script src="https://cdn.tiny.cloud/1/70a3se1ik7fxxbergcdpl25k3u2ci4bxxbis2ju2inop1pqu/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#content'

        });
    </script>
</head>
<body>

@include('partials.header')
<div class="container">
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
</body>
</html>
