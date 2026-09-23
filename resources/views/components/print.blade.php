<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Document</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <!-- Embed the file (PDF or image) -->
    <iframe src="{{ $fileUrl }}" id="printFrame"></iframe>

    <script>
        // Automatically trigger print once the iframe content loads
        document.getElementById('printFrame').onload = function() {
            setTimeout(() => {
                this.contentWindow.print();
            }, 500); // Small delay to ensure rendering completes
        };
    </script>
</body>
</html>