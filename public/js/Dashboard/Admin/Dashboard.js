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



var options = {
    series: [
        {
            name: 'series1',
            data: [0, 60, 70, 110, 60, 70, 100, 85, 90, 70 ,77]

        },
        {
            name: 'series2',
            data: [50, 50, 60, 90, 50, 60, 90, 55, 44, 66, 55]
        },
        {
            name: 'series2',
            data: [90, 40, 50, 80, 40, 50, 80, 85, 98, 85, 46]
        }
    ],
    colors: ["#8EB0DE", "#90C6E0", "#E7EBF5"],
    chart: {
        height: 350,
        type: 'area',
        toolbar: {
            show: false,
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
};
var chart = new ApexCharts(document.querySelector("#dataReceivering"), options);
chart.render();


const dataListRefresh = async ()=>{
    freshData = await fetch(`/dashboard/admin/motorsData`);
    freshData = await freshData.json();
    // console.log(freshData);
    document.querySelector('#dataList').innerHTML ='';
    freshData.map((item)=>{
        payload = item.event.payload.split('->')[1]

        if (item.process == 'normal')
            document.querySelector('#dataList').innerHTML +=`<div class="alert alert-success">هشدار ${item.event.name}  طبیعی است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${JSON.parse(item.data).d[payload]} </div>`
        if (item.process == 'warning')
            document.querySelector('#dataList').innerHTML +=`<div class="alert alert-warning">هشدار ${item.event.name}  در بازه  مجاز  است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${JSON.parse(item.data).d[payload]} </div>`
        if (item.process == 'error'){
            document.querySelector('#dataList').innerHTML +=`<div class="alert alert-danger">هشدار ${item.event.name}  در بازه غیر مجاز  است .مقادیر طبیعی = ${item.event.min} < ${item.event.normal} < ${item.event.max} | مقدار ارسالی موتور =   ${JSON.parse(item.data).d[payload]} </div>`
        }
    });
}




setInterval(dataListRefresh,2000)

mapInit()
dataListRefresh()