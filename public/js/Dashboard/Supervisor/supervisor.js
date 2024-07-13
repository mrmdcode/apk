
let allData ;


function imageDataSet(points) {
    const canvas = document.getElementById('mototoImage');
    const ctx = canvas.getContext('2d');

    const img = new Image();
    img.src = '/img/motorImage.jpg';
    img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0);
        points.forEach(point => {
            ctx.font = '32px Arial';
            ctx.fillStyle = 'black';
            ctx.fillText(point.data, point.x + 10, point.y + 5);
        });
    };
}



var bandsData = [
    {
        title: "cold",
        color: "#f3eb0c",
        lowScore: 0,
        highScore:30
    }, {
        title: "above",
        color: "#fdae19",
        lowScore: 30,
        highScore: 60
    }, {
        title: "hot",
        color: "#f04922",
        lowScore: 60,
        highScore: 90
    },];


var currentsOption = {
    series: [],
    colors: ["#8EB0DE", "#90C6E0", "#E7EBF5"],
    chart: {
        height: 350,
        type: 'area',
        toolbar: {
            show: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    grid: {
        borderColor: '#EDEFF5',
        strokeDashArray: 5,
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    xaxis: {
        type: 'datetime',
        categories: ["13 Jan", "14 Jan", "15 Jan", "16 Jan", "17 Jan", "18 Jan", "19 Jan", "20 Jan", "21 Jan", "22 Jan", "23 Jan"],
        labels: {
            style: {
                colors: ['#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8',],
                fontSize: '14px',
            },
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        }
    },
    yaxis: {
        labels: {
            style: {
                colors: ['#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8',],
                fontSize: '14px',
            },
        }
    },
    legend: {
        show: false,
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    },
    noData:{
        text:"....ng",
    }
};
var currentsChart = new ApexCharts(document.querySelector("#currents"), currentsOption);
currentsChart.render();





var temperatureOption = {
    series: [],
    colors: ["#8EB0DE", "#90C6E0", "#E7EBF5"],
    chart: {
        height: 350,
        type: 'area',
        toolbar: {
            show: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    grid: {
        borderColor: '#EDEFF5',
        strokeDashArray: 5,
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    xaxis: {
        type: 'datetime',
        categories: ["13 Jan", "14 Jan", "15 Jan", "16 Jan", "17 Jan", "18 Jan", "19 Jan", "20 Jan", "21 Jan", "22 Jan", "23 Jan"],
        labels: {
            style: {
                colors: ['#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8',],
                fontSize: '14px',
            },
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        }
    },
    yaxis: {
        labels: {
            style: {
                colors: ['#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8',],
                fontSize: '14px',
            },
        }
    },
    legend: {
        show: false,
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    },
    noData:{
        text:"....Loading",
    }
};
var temperatureChart = new ApexCharts(document.querySelector("#temperatureChart"), temperatureOption);
temperatureChart.render();




var vibrationOptions = {
    series: [],
    noData: {
        text :"... Lodaing"
    },
    chart: {
        id: 'area-datetime',
        type: 'area',
        height: 365,
        zoom: {
            autoScaleYaxis: true
        },
        toolbar: {
            show: false,
        }
    },
    colors: ['#ff001d','#b8c325','#757FEF'],
    dataLabels: {
        enabled: false
    },
    markers: {
        size: 0,
        style: 'hollow',
    },
    xaxis: {
        type: 'datetime',
        tickAmount: 6,
        labels: {
            style: {
                colors: ['#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8',],
            },
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        }
    },
    yaxis: {
        labels: {
            style: {
                colors: ['#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8', '#A9A9C8',],
            },
        },
    },
    grid: {
        borderColor: '#EDEFF5',
        strokeDashArray: 4,
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        },
    },
    tooltip: {
        x: {
            format: 'dd MMM yyyy'
        }
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 100]
        }
    },
};
var vibrationC = new ApexCharts(document.querySelector("#vibrations"), vibrationOptions);
vibrationC.render();




function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${year}-${month}-${day} ${hours}:${minutes}`;
}


const getData = async () => {
    data = await fetch(`/api/${$('#motor_id').val()}/${$('#motor_seller').val()}/${$('#motor_buyer').val()}`)
    data = await data.json();
    console.log(data)
    allData = data;
    temp1 =allData.events.filter((item)=>{
        return item.payload.includes("d->temperature");
    })[0];
    temp2 =allData.events.filter((item)=>{
        return item.payload.includes("d->ambtemperature");
    })[0];
    current1 =allData.events.filter((item)=>{
        return item.payload.includes("d->Current1");
    })[0];
    current2 =allData.events.filter((item)=>{
        return item.payload.includes("d->Current2");
    })[0];
    current3 =allData.events.filter((item)=>{
        return item.payload.includes("d->Current3");
    })[0];
    vibration1 = allData.events.filter((item)=>{
        return item.payload.includes("d->vibration1");
    })[0];
    vibration2 = allData.events.filter((item)=>{
        return item.payload.includes("d->vibration2");
    })[0];


    imageDataSet( [
        { x: 798, y: 50, data:  temp1.data[temp1.data.length-1].data},
        { x: 796, y: 141, data: temp2.data[temp2.data.length-1].data },
        { x: 798, y: 199, data:  current1.data[current1.data.length-1].data},
        { x: 798, y: 298, data:  current2.data[current2.data.length-1].data },
        { x: 798, y: 199, data: current3.data[current3.data.length-1].data },
        { x: 798, y: 371, data: vibration2.data[vibration2.data.length-1].data },
    ]);

    currentsChart.updateOptions({
        xaxis: {
            categories: current1.data.map((item) => {
                daate = new Date(item['created_at'])
                return formatDate(daate);
            }),
        },
        series: [
            {
                name: current1.name,
                data: current1.data.map((item) => {
                    return parseInt(item['data'])
                })
            },
            {
                name: current2.name,
                data: current2.data.map((item) => {
                    return parseInt(item['data'])
                })
            },
            {
                name: current2.name,
                data: current3.data.map((item) => {
                    return parseInt(item['data'])
                })
            }
        ]
    })
    temperatureChart.updateOptions({
        xaxis : {
            categories: temp1.data.map((item)=>{
                daate = new Date(item['created_at'])
                return formatDate(daate);
            }),
        },
        series : [{
            name:temp1.name,
            data:temp1.data.map((item)=>{return parseInt(item['data'])})
        },
            {
                name:temp2.name,
                data:temp2.data.map((item)=>{return parseInt(item['data'])})
            }]
    })
    vibrationC.updateOptions({
        xaxis : {
            categories: vibration1.data.map((item)=>{
                daate = new Date(item['created_at'])
                return formatDate(daate);
            }),
        },
        series : [
            {
                name:vibration1.name,
                data:vibration1.data.map((item)=>{return parseInt(item['data'])})
            },
            {
                name:vibration2.name,
                data:vibration2.data.map((item)=>{return parseInt(item['data'])})
            }
        ]
    })

    console.log(current1,current2,current3)


    const eventChart = document.getElementById('eventChart');

    new Chart(eventChart, {
        type: 'bar',
        data: {
            labels: data.events.map((item)=>{return item.name}),
            datasets: [{
                label: 'تعداد دیتا',
                data: data.events.map((item)=>{return item.data.length}),
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });



    am5.ready(function () {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("gauge_1");


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/radar-chart/
        var chart = root.container.children.push(am5radar.RadarChart.new(root, {
            panX: false,
            panY: false,
            startAngle: 160,
            endAngle: 380
        }));


        // Create axis and its renderer
        // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Axes
        var axisRenderer = am5radar.AxisRendererCircular.new(root, {
            innerRadius: -40
        });

        axisRenderer.grid.template.setAll({
            stroke: root.interfaceColors.get("background"),
            visible: true,
            strokeOpacity: 0.8
        });

        var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0,
            min: -40,
            max: 100,
            strictMinMax: true,
            renderer: axisRenderer
        }));


        // Add clock hand
        // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Clock_hands
        var axisDataItem = xAxis.makeDataItem({});

        var clockHand = am5radar.ClockHand.new(root, {
            pinRadius: am5.percent(20),
            radius: am5.percent(100),
            bottomWidth: 40
        })

        var bullet = axisDataItem.set("bullet", am5xy.AxisBullet.new(root, {
            sprite: clockHand
        }));

        xAxis.createAxisRange(axisDataItem);

        var label = chart.radarContainer.children.push(am5.Label.new(root, {
            fill: am5.color(0xffffff),
            centerX: am5.percent(50),
            textAlign: "center",
            centerY: am5.percent(50),
            fontSize: "3em"
        }));

        axisDataItem.set("value", 50);
        bullet.get("sprite").on("rotation", function () {
            var value = axisDataItem.get("value");
            var text = Math.round(axisDataItem.get("value")).toString();
            var fill = am5.color(0x000000);
            xAxis.axisRanges.each(function (axisRange) {
                if (value >= axisRange.get("value") && value <= axisRange.get("endValue")) {
                    fill = axisRange.get("axisFill").get("fill");
                }
            })

            label.set("text", Math.round(value).toString());

            clockHand.pin.animate({ key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic) })
            clockHand.hand.animate({ key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic) })
        });


        axisDataItem.animate({
            key: "value",
            to: temp2.data[temp2.data.length-1].data,
            duration: 500,
            easing: am5.ease.out(am5.ease.cubic)
        });

        chart.bulletsContainer.set("mask", undefined);


        // Create axis ranges bands
        // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Bands
        var bandsData = [{
            title: "Unsustainable",
            color: "#ee1f25",
            lowScore: -40,
            highScore: -20
        }, {
            title: "Volatile",
            color: "#f04922",
            lowScore: -20,
            highScore: 0
        }, {
            title: "Foundational",
            color: "#fdae19",
            lowScore: 0,
            highScore: 20
        }, {
            title: "Developing",
            color: "#f3eb0c",
            lowScore: 20,
            highScore: 40
        }, {
            title: "Maturing",
            color: "#b0d136",
            lowScore: 40,
            highScore: 60
        }, {
            title: "Sustainable",
            color: "#54b947",
            lowScore: 60,
            highScore: 80
        }, {
            title: "High Performing",
            color: "#0f9747",
            lowScore: 80,
            highScore: 100
        }];

        am5.array.each(bandsData, function (data) {
            var axisRange = xAxis.createAxisRange(xAxis.makeDataItem({}));

            axisRange.setAll({
                value: data.lowScore,
                endValue: data.highScore
            });

            axisRange.get("axisFill").setAll({
                visible: true,
                fill: am5.color(data.color),
                fillOpacity: 0.8
            });

            axisRange.get("label").setAll({
                text: data.title,
                inside: true,
                radius: 15,
                fontSize: "0.9em",
                fill: root.interfaceColors.get("background")
            });
        });


        // Make stuff animate on load
        chart.appear(1000, 100);



    });
    am5.ready(function () {
        var root = am5.Root.new("gauge_2");

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5radar.RadarChart.new(root, {
            panX: false,
            panY: false,
            startAngle: 160,
            endAngle: 380
        }));
        var axisRenderer = am5radar.AxisRendererCircular.new(root, {
            innerRadius: -40
        });
        axisRenderer.grid.template.setAll({
            stroke: root.interfaceColors.get("background"),
            visible: true,
            strokeOpacity: 0.8
        });
        var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0,
            min: -40,
            max: 100,
            strictMinMax: true,
            renderer: axisRenderer
        }));
        var axisDataItem = xAxis.makeDataItem({});

        var clockHand = am5radar.ClockHand.new(root, {
            pinRadius: am5.percent(20),
            radius: am5.percent(100),
            bottomWidth: 40
        })

        var bullet = axisDataItem.set("bullet", am5xy.AxisBullet.new(root, {
            sprite: clockHand
        }));

        xAxis.createAxisRange(axisDataItem);

        var label = chart.radarContainer.children.push(am5.Label.new(root, {
            fill: am5.color(0xffffff),
            centerX: am5.percent(50),
            textAlign: "center",
            centerY: am5.percent(50),
            fontSize: "3em"
        }));

        axisDataItem.set("value", 50);
        bullet.get("sprite").on("rotation", function () {
            var value = axisDataItem.get("value");
            var text = Math.round(axisDataItem.get("value")).toString();
            var fill = am5.color(0x000000);
            xAxis.axisRanges.each(function (axisRange) {
                if (value >= axisRange.get("value") && value <= axisRange.get("endValue")) {
                    fill = axisRange.get("axisFill").get("fill");
                }
            })

            label.set("text", Math.round(value).toString());

            clockHand.pin.animate({ key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic) })
            clockHand.hand.animate({ key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic) })
        });


        axisDataItem.animate({
            key: "value",
            to: temp1.data[temp1.data.length-1].data,
            duration: 500,
            easing: am5.ease.out(am5.ease.cubic)
        });

        chart.bulletsContainer.set("mask", undefined);


        // Create axis ranges bands
        // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Bands
        var bandsData = [{
            title: "Unsustainable",
            color: "#ee1f25",
            lowScore: -40,
            highScore: -20
        }, {
            title: "Volatile",
            color: "#f04922",
            lowScore: -20,
            highScore: 0
        }, {
            title: "Foundational",
            color: "#fdae19",
            lowScore: 0,
            highScore: 20
        }, {
            title: "Developing",
            color: "#f3eb0c",
            lowScore: 20,
            highScore: 40
        }, {
            title: "Maturing",
            color: "#b0d136",
            lowScore: 40,
            highScore: 60
        }, {
            title: "Sustainable",
            color: "#54b947",
            lowScore: 60,
            highScore: 80
        }, {
            title: "High Performing",
            color: "#0f9747",
            lowScore: 80,
            highScore: 100
        }];

        am5.array.each(bandsData, function (data) {
            var axisRange = xAxis.createAxisRange(xAxis.makeDataItem({}));

            axisRange.setAll({
                value: data.lowScore,
                endValue: data.highScore
            });

            axisRange.get("axisFill").setAll({
                visible: true,
                fill: am5.color(data.color),
                fillOpacity: 0.8
            });

            axisRange.get("label").setAll({
                text: data.title,
                inside: true,
                radius: 15,
                fontSize: "0.9em",
                fill: root.interfaceColors.get("background")
            });
        });


        // Make stuff animate on load
        chart.appear(1000, 100);



    });
}

getData()
