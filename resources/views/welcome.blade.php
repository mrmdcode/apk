<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>متن روی تصویر</title>
</head>
<body>
<canvas id="canvas"></canvas>
<div id="text-container"></div>
<script>
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const textContainer = document.getElementById('text-container');

    // بارگیری تصویر
    const image = new Image();
    image.onload = function() {
        canvas.width = image.width;
        canvas.height = image.height;
        ctx.drawImage(image, 0, 0);

        // تعریف نقاط اتصال متن و تصویر
        const textConnections = [
            { text: 'متن 1', x1: 600, y1: 250, x2: 50, y2: 50 },
            { text: 'متن 2', x1: 120, y1: 20, x2: 150, y2: 80 },
            // ... add more connections as needed
        ];

        // پردازش هر اتصال متن و تصویر
        textConnections.forEach(connection => {
            // رسم متن در div
            const textElement = document.createElement('div');
            textElement.textContent = connection.text;
            textElement.style.position = 'absolute';
            textElement.style.left = connection.x1 + 'px';
            textElement.style.top = connection.y1 + 'px';
            textElement.style.fontSize = '20px';
            textElement.style.color = 'black';
            textContainer.appendChild(textElement);

            // رسم خط اتصال
            ctx.beginPath();
            ctx.moveTo(connection.x1, connection.y1);
            ctx.lineTo(connection.x2, connection.y2);
            ctx.strokeStyle = 'black';
            ctx.stroke();
        });
    };
    image.src = '/img/exam.png';
</script>
</body>
</html>
