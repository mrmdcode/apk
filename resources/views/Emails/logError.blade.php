<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .wrapper
        {
            width: 602px;
            margin: 50px auto;
            padding: 10px 10px 10px 10px;
            border-radius: 5px;
            box-shadow: 0 0 15px 2px #ff0000;
        }
        .header{
            width: 100%;
            /*height: 37px;*/
            text-align: center;
            margin: 5px 0 50px 0;
            padding: 7px;
            border-radius: 8px;
            background-color: red;
            color: #fff;
            font-size: 20px;
            font-weight: 800;
        }

        h2 {
            font-size: 26px;
            margin: 20px 0;
            text-align: center;
            small {
                font-size: 0.5em;
            }
        }
        ul{
            display: flex;
            justify-content: space-around;
            list-style-type: none;
            li{
                margin: 15px;
                font-size: 14px;
                font-weight: 700;
            }
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            Dear company, buyer or seller of engine named {{$details['motor_name']}} and serial {{$details['motor_serial']}}, your engine has violated the requirements of the seller
        </div>
        <div class="body">
            <h2>10 last Error Data</h2>


            <table>
                <thead>
                <th></th>
                </thead>
                <tbody>
                @foreach($details['datas'] as $data)

                    <tr>
                        <td>{{$data->event->name}}</td>
                        <td>{{$data->event->max}} > {{$data->event->normal}} > {{$data->event->min}}</td>
                        <td>{{$data->data}}</td>
                        <td>{{$data->process}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer"></div>
    </div>
</body>
</html>
