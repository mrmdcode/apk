const mapInit =async () => {
    motorLoc = await fetch('/dashboard/admin/motorLoc');
    cities = await motorLoc.json();
    // console.log(cities)

    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("sales_by_locations");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([am5themes_Animated.new(root)]);

        // Create the map chart
        // https://www.amcharts.com/docs/v5/charts/map-chart/
        var chart = root.container.children.push(
            am5map.MapChart.new(root, {
                panX: "rotateX",
                panY: "translateY",
                projection: am5map.geoMercator()
            })
        );

        var cont = chart.children.push(
            am5.Container.new(root, {
                layout: root.horizontalLayout,
                x: 20,
                y: 40
            })
        );

        // Create series for background fill
        // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
        var backgroundSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {}));
        backgroundSeries.mapPolygons.template.setAll({
            fill: root.interfaceColors.get("alternativeBackground"),
            fillOpacity: 0,
            strokeOpacity: 0
        });

        // Add background polygon
        // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
        backgroundSeries.data.push({
            geometry: am5map.getGeoRectangle(0,0)
        });

        // Create main polygon series for countries
        // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
        var polygonSeries = chart.series.push(
            am5map.MapPolygonSeries.new(root, {
                geoJSON: am5geodata_iranHigh
            })
        );

        // Create line series for trajectory lines
        // https://www.amcharts.com/docs/v5/charts/map-chart/map-line-series/
        var lineSeries = chart.series.push(am5map.MapLineSeries.new(root, {}));
        lineSeries.mapLines.template.setAll({
            stroke: root.interfaceColors.get("alternativeBackground"),
            strokeOpacity: 0.3
        });

        // Create point series for markers
        // https://www.amcharts.com/docs/v5/charts/map-chart/map-point-series/
        var pointSeries = chart.series.push(am5map.MapPointSeries.new(root, {}));
        var colorset = am5.ColorSet.new(root, {});

        pointSeries.bullets.push(function() {
            var container = am5.Container.new(root, {
                tooltipText: "{title}",
                cursorOverStyle: "pointer"
            });

            container.events.on("click", (e) => {
                window.location.href = e.target.dataItem.dataContext.url;
            });



            var circle = container.children.push(
                am5.Circle.new(root, {
                    radius: 4,
                    tooltipY: 0,
                    fill: colorset.next(),
                    strokeOpacity: 0
                })
            );


            var circle2 = container.children.push(
                am5.Circle.new(root, {
                    radius: 4,
                    tooltipY: 0,
                    fill: colorset.next(),
                    strokeOpacity: 0,
                    tooltipText: "{title}"
                })
            );

            circle.animate({
                key: "scale",
                from: 1,
                to: 5,
                duration: 600,
                easing: am5.ease.out(am5.ease.cubic),
                loops: Infinity
            });
            circle.animate({
                key: "opacity",
                from: 1,
                to: 0.1,
                duration: 600,
                easing: am5.ease.out(am5.ease.cubic),
                loops: Infinity
            });

            return am5.Bullet.new(root, {
                sprite: container
            });
        });



        for (var i = 0; i < cities.length; i++) {
            var city = cities[i];
            addCity(city.longitude, city.latitude, city.title, city.url);
        }

        function addCity(longitude, latitude, title, url) {
            pointSeries.data.push({
                url: url,
                geometry: { type: "Point", coordinates: [longitude, latitude] },
                title: title
            });
        }

        // Make stuff animate on load
        chart.appear(1000, 100);

    }); // end am5.ready()


}

const chartInit =async () => {
    motorLoc = await fetch('/dashboard/admin/motorLoc');
    cities = await motorLoc.json();
}
var options = {
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
var chart = new ApexCharts(document.querySelector("#dataReceivering"), options);
chart.render();

// chart.updateSeries([])


const dataListRefresh = async ()=>{
    freshData = await fetch(`/dashboard/admin/motorsData`);
    freshData = await freshData.json();
    // console.log(freshData);
    document.querySelector('#dataList').innerHTML ='';
    freshData.map((item)=>{

        // console.log(item)
        if (item.process == 'normal')
            document.querySelector('#dataList').innerHTML +=`<div class="alert alert-success">موتور ${item.motor.motor_name} |هشدار ${item.event.name}  طبیعی است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${item.data} </div>`
        if (item.process == 'warning')
            document.querySelector('#dataList').innerHTML +=`<div class="alert alert-warning">موتور ${item.motor.motor_name} | هشدار ${item.event.name}  در بازه  مجاز  است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${item.data} </div>`
        if (item.process == 'error'){
            document.querySelector('#dataList').innerHTML +=`<div class="alert alert-danger"> موتور ${item.motor.motor_name} | هشدار ${item.event.name}  در بازه غیر مجاز  است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${item.data} </div>`
        }
    })  ;
}




setInterval(dataListRefresh,7000)
mapInit()
dataListRefresh()




// تابعی برای گرد کردن زمان به نزدیک‌ترین بازه نیم ساعتی
function roundToNearestHalfHour(date) {
    const minutes = date.getMinutes();
    const roundedMinutes = (minutes < 30) ? 0 : 30;
    date.setMinutes(roundedMinutes, 0, 0);
    return date;
}

// تبدیل تاریخ به رشته با فرمت YYYY-MM-DD HH:mm
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${year}-${month}-${day} ${hours}:${minutes}`;
}

// تابع اصلی برای گرفتن و پردازش داده‌ها
async function fetchAndProcessData() {
    try {
        // گرفتن داده از API
        const response = await fetch('/dashboard/admin/motorsDatas',{
            headers: {'Accept':'application/json'}
        });
        const data = await  response.json();

        // پردازش داده‌ها
        let processedData = {};

        data.forEach(item => {
            const date = new Date(item.created_at);
            const roundedTime = formatDate(roundToNearestHalfHour(date));

            if (!processedData[roundedTime]) {
                processedData[roundedTime] = { normal: 0, warning: 0, error: 0 };
            }

            processedData[roundedTime][item.process]++;
        });

        // آماده‌سازی داده‌ها برای چارت
        const labels = Object.keys(processedData);
        const normalData = labels.map(time => processedData[time].normal);
        const warningData = labels.map(time => processedData[time].warning);
        const errorData = labels.map(time => processedData[time].error);
        chart.up
        chart.updateOptions({

            xaxis : {
                categories: labels,
            },
            series: [
                {
                    name: 'normal',
                    data: normalData

                },
                {
                    name: 'warning',
                    data: warningData
                },
                {
                    name: 'error',
                    data: errorData
                }
            ]
        })

        // حالا می‌توانید از chartData برای ساخت چارت خود استفاده کنید
    } catch (error) {
        console.error('Error fetching or processing data:', error);
    }
}

// فراخوانی تابع اصلی
fetchAndProcessData();
