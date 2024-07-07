<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('Dashboard.Supervisor._partial._css')
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container-fluid {
            #navTab{
                height: 65px;
                #logo{
                    height: 55px;
                }
                #bio{
                    font-size: 21px;
                    font-weight: 100;
                }
            }
        }
        #Imagecontainer {
            position: relative;
            display: inline-block;
        }
        #myImage {
            /*width: %;*/
            height: auto;
        }
        .point {
            position: absolute;
            background-color: red;
            border-radius: 50%;
            width: 10px;
            height: 10px;
        }
        .label {
            position: absolute;
            color: yellow;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="container-fluid ">
        <div class="row bg-secondary" id="navTab">
            <div class="col-3 d-flex mt-1 justify-content-center">
                <img src="{{asset('assets/dashboard/images/logo_dark.png')}}" alt="" id="logo">
            </div>
            <div class="col-6">
                <div class="row d-flex justify-content-around text-center text-light pt-3" id="bio">
                    <div class="col-3 border">{{$motor->seller->company_name}}</div>
                    <div class="col-3 border"> {{$motor->motor_name}}</div>
                    <div class="col-3 border">{{$motor->buyer->company_name}}</div>
                    <input type="hidden" name="motorId" value="{{$motor->id}}">
                    <input type="hidden" name="sellerId" value="{{$motor->seller->id}}">
                    <input type="hidden" name="buyerId" value="{{$motor->buyer->id}}">
                </div>
            </div>
            <div class="col-3 d-flex justify-content-end">
                <button class="btn btn-success m-3">ثبت گزارش</button>
            </div>
        </div>


        <div class="row d-flex justify-content-evenly mt-5">
            <div class="col" >
                <div class="card">
                    <div class="card-body" id="errorManager">

                    </div>
                </div>
            </div>
            <div class="col" >
            <canvas id="myCanvas"></canvas>
            </div>
        </div>



        <div class="row mt-5">
            <div class="col-6">
                <div class="card">
                    <div class="card-body" style="height:450px">
                        <canvas id="linechart" class="chart chart-line" data="data" labels="labels" legend="true" series="series" options="options" click="onClick"></canvas>

                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card ">
                    <div class="card-body">
                        <div id="gaugeContainer_1"></div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card ">
                    <div class="card-body">
                        <div id="gaugeContainer_2"></div>
                    </div>

                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <span id="counter"></span>
                    </div>
                </div>
            </div>
        </div>


    </div>





@include("Dashboard.Supervisor._partial._js")

<!-- App js -->
<script src="{{asset("assets/dashboard/js/app.js")}}"></script>

    <script>
        const motorId =$('input[name="motorId"]').val();
        const sellerId =$('input[name="sellerId"]').val();
        const buyerId =$('input[name="buyerId"]').val();
        console.log(motorId)

        function imageDataSet(points) {
            // انتخاب کانواس و تنظیم اندازه آن برابر با اندازه تصویر
            const canvas = document.getElementById('myCanvas');
            const ctx = canvas.getContext('2d');

            // بارگذاری تصویر
            const img = new Image();
            img.src = '/img/motorImage.jpg';
            img.onload = function() {
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);

                // نقاطی که می‌خواهید داده‌ها را نمایش دهید (X, Y)


                // افزودن نقاط و داده‌ها به تصویر
                points.forEach(point => {
                    // نمایش نقطه

                    // نمایش داده
                    ctx.font = '32px Arial';
                    ctx.fillStyle = 'black';
                    ctx.fillText(point.data, point.x + 10, point.y + 5);
                });
            };
        };

        const errorManager = (data) => {
            $('#errorManager').html("");
          data.map((item)=>{
              payload = item.event.payload.split('->')[1]

              if (item.process == 'normal')
                  $('#errorManager').append(`<div class="alert alert-success">اخطار ${item.event.name}  طبیعی است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${JSON.parse(item.data).d[payload]} </div>`)
              if (item.process == 'warning')
                  $('#errorManager').append(`<div class="alert alert-warning">اخطار ${item.event.name}  در بازه  مجاز  است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${JSON.parse(item.data).d[payload]} </div>`)
              if (item.process == 'error'){
                  $('#errorManager').append(`<div class="alert alert-danger">اخطار ${item.event.name}  در بازه غیر مجاز  است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${JSON.parse(item.data).d[payload]} </div>`)
              }
          });
        }

        var g_2 = new JustGage({
            id: "gaugeContainer_2",
            value: 30,
            min: 0,
            max: 100,
            title: "میزان آمپر",
            label: "دما محیط",
            levelColors: ['#FF0000','#00FF00','#FF0000']
        });
        var g_1 = new JustGage({
            id: "gaugeContainer_1",
            value: 2,
            min: 0,
            max: 100,
            title: "میزان آمپر",
            label: "دما سیم پیچ",
            levelColors: ['#FF0000', '#FFCC00', '#00FF00']
        });




        const linechart = document.getElementById('linechart');

        let chart = new Chart(linechart, {

            type: 'line',
            data: {
                labels: ['Red', 'green', 'Yellow',],
                datasets: [
                    {
                        label: 'Error',
                        data: [12, 1, 3, 5, 2, 3],
                        fill: true, // <-- Here
                    },
                    {
                        label: 'Warning',
                        data: [120, 19, 3, 5, 2, 13],
                        fill: true, // <-- Here
                    },{
                        label: 'normal',
                        data: [12, 19, 31, 50, 2, 3],
                        fill: true, // <-- Here
                    }

                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const refresh = async () => {
            freshData = await fetch(`/api/${motorId}/${sellerId}/${buyerId}/`);
            freshData = await freshData.json();
            console.log(freshData)
            g_1.refresh(JSON.parse(freshData.temperature.data).d[freshData.temperature.payload.split('->')[1]]);
            g_2.refresh(JSON.parse(freshData.ambtemperature.data).d[freshData.ambtemperature.payload.split('->')[1]]);



            point = [

                { x: 798, y: 50, data: JSON.parse(freshData.imgData[0].data).d[freshData.imgData[0].payload.split('->')[1]] },
                { x: 796, y: 141, data: JSON.parse(freshData.imgData[1].data).d[freshData.imgData[1].payload.split('->')[1]] },
                { x: 798, y: 199, data: JSON.parse(freshData.imgData[2].data).d[freshData.imgData[2].payload.split('->')[1]] },
                { x: 798, y: 298, data: JSON.parse(freshData.imgData[3].data).d[freshData.imgData[3].payload.split('->')[1]]  },
                { x: 798, y: 199, data: JSON.parse(freshData.imgData[4].data).d[freshData.imgData[4].payload.split('->')[1]] },
                { x: 798, y: 371, data: JSON.parse(freshData.imgData[5].data).d[freshData.imgData[5].payload.split('->')[1]] },
            ]
            imageDataSet(point)


            errorManager(freshData.lastTenData)


        }
        document.addEventListener('DOMContentLoaded',refresh);
        setInterval(refresh,30000)
        x = 30
        setInterval(()=>{
            $('#counter').text(x--)
            if (x ==0)
                x =30
        },1000)


    </script>
</body>
</html>
