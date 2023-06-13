<!DOCTYPE html>
<html>

<head>
    <title>Wycinanie i pobieranie obrazka</title>
    <style>
        #canvas {
            border: 1px solid #ccc;
            cursor: crosshair;
            min-width: 100%;
        }
    </style>
</head>

<body>
    <h1>Wycinanie i pobieranie obrazka</h1>
    <input type="file" id="imageInput">
    <br>
    <canvas id="canvas"></canvas>
    <br>
    <button onclick="cropAndUpload()">Wyciń i Wyślij</button>
    <br>
    <a id="downloadLink" style="display: none;">Pobierz wycięty obrazek</a>

    <script>
        // Zmienne do przechowywania współrzędnych początkowych i końcowych zaznaczenia
        var startX, startY, endX, endY;

        // Funkcja obsługująca zdarzenie naciśnięcia myszy na canvas
        function handleMouseDown(e) {
            var canvas = e.target;
            var rect = canvas.getBoundingClientRect();
            startX = e.clientX - rect.left;
            startY = e.clientY - rect.top;
        }

        // Funkcja obsługująca zdarzenie puszczenia myszy na canvas
        function handleMouseUp(e) {
            var canvas = e.target;
            var rect = canvas.getBoundingClientRect();
            endX = e.clientX - rect.left;
            endY = e.clientY - rect.top;

            cropAndUpload();
        }

        // Funkcja, która wycina fragment obrazka i wysyła go na serwer

        // Funkcja, która wycina fragment obrazka i wysyła go na serwer
        function cropAndUpload() {
            var input = document.getElementById('imageInput');
            var canvas = document.getElementById('canvas');
            var downloadLink = document.getElementById('downloadLink');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var image = new Image();
                    image.onload = function() {
                        var context = canvas.getContext('2d');

                        // Obliczanie szerokości i wysokości obrazka na canvasie
                        var aspectRatio = image.width / image.height;
                        var canvasWidth = Math.min(image.width, canvas.width);
                        var canvasHeight = canvasWidth / aspectRatio;

                        // Rysowanie obrazka na canvas
                        context.drawImage(image, 0, 0, canvasWidth, canvasHeight);

                        // Wycinanie fragmentu obrazka na podstawie zaznaczenia
                        var cropWidth = Math.abs(endX - startX);
                        var cropHeight = Math.abs(endY - startY);
                        var cropX = Math.min(startX, endX);
                        var cropY = Math.min(startY, endY);

                        // Wycinanie fragmentu obrazka
                        var croppedImage = context.getImageData(cropX, cropY, cropWidth, cropHeight);
                        canvas.width = cropWidth;
                        canvas.height = cropHeight;
                        context.putImageData(croppedImage, 0, 0);

                        // Przesyłanie wyciętego obrazka na serwer
                        canvas.toBlob(function(blob) {
                            var formData = new FormData();
                            formData.append('file', blob, 'cropped_image.png');

                            // Tutaj należy wysłać żądanie POST z formData na serwer, używając np. fetch lub AJAX

                            // Po pomyślnym przesłaniu obrazka można udostępnić link do pobrania
                            downloadLink.href = URL.createObjectURL(blob);
                            downloadLink.download = 'cropped_image.png';
                            downloadLink.style.display = 'block';
                        }, 'image/png');
                    };
                    image.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        // Dodanie obsługi zdarzeń dla myszy na canvas
        var canvas = document.getElementById('canvas');
        canvas.addEventListener('mousedown', handleMouseDown);
        canvas.addEventListener('mouseup', handleMouseUp);
    </script>
</body>

</html>