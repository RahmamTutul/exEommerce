<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <table>
        <tr>
            <td><h4>Dear: {{$name}}</h4></td>
        </tr>
        <tr>
            <td>Please click on activation link given below!</td>
        </tr>
        <tr>
            <td><a target="__blank" href="{{url('confirm/'.$code)}}">Click to confirm</a></td>
        </tr>
        <tr>
            <td>Thank You!</td>
        </tr>

    </table>

</body>
</html>
