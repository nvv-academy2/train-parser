<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

</head>
<body>
<div class="container">
    <table class="table">
        <thead>
            <th>111111</th>
            <th>Code</th>
        </thead>
        <tbody>
        @foreach($cities as $city)
            <tr>
                <td>{{$city['name']}}</td>
                <td>{{$city['code']}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <br>

    <form action="/cities" method="POST">
        <input type="text" name="name" class="form-control" placeholder="Name">
        <input type="number" name="code"class="form-control" placeholder="Code">
        <input type="submit" value="Add" class="btn btn-success">
    </form>
    <br>

    <h3>Search</h3>

    <span>FROM</span>
    <select class="form-control" id="from">
        @foreach($cities as $city)
            <option value="{{$city['code']}}">{{$city['name']}}</option>
        @endforeach
    </select>

    <span>TO</span>
    <select class="form-control" id="to">
        @foreach($cities as $city)
            <option value="{{$city['code']}}">{{$city['name']}}</option>
        @endforeach
    </select>
    <span>DATE:</span>
    <input type="text" value="Add" class="form-control" id="date">
    <input type="button" value="Search Trains" class="btn btn-primary" id="searchTrains"><br>
    <br>
    <table class="table table-bordered">
        <thead>
        <th>Train</th>
        <th>Per/Arr</th>
        </thead>
        <tbody id="trainsBody">

        </tbody>
    </table>

    <br>
    <input type="text" id="search" class="form-control">
    <button id="makeSearch" class="btn btn-success">Search</button>

    <table class="table table-bordered">
        <thead>
        <th>City</th>
        <th>Code</th>
        </thead>
        <tbody id="searchBody">

        </tbody>
    </table>
</div>
<script>
    $("document").ready(function () {
        console.log("READY");


        $("#makeSearch").click(function () {
            $("#searchBody").empty();
            let string = $("#search").val();
            console.log(string);

            $.get('/cities/search?search=' + string, function (res) {
               console.log(res);
               var len = res.length;
               for (var i = 0; i < len; i++) {
                   console.log(res[i].title + " => " + res[i].value);

                   $("#searchBody").append("<tr><td>" + res[i].title + "</td><td>"  +  res[i].value + "</td></tr>");
               }
            });

            console.log("test");
        });

        $("#searchTrains").click(function (){
            $("#trainsBody").empty();
            var data = {};
            data.from = $("#from").val();
            data.to = $("#to").val();
            data.date = $("#date").val();

            $.post("parser/search", data, function (res) {
                var data = res.data.list;
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    $("#trainsBody").append("<tr><td>" + data[i].num + "</td><td>"  +  data[i].from.time + "/" + data[i].to.time + "</td></tr>");
                }
            });
        });
    });
</script>
</body>
</html>
