<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Link Generator</title>
    <script>
        function generateLink() {
            const videoUrl = document.getElementById('video').value;
            if (!videoUrl.includes('cloudinary.com')) {
                alert('Please enter a valid Cloudinary video URL.');
                return;
            }
            const encoded = btoa(videoUrl);
            const shareableLink = `${window.location.origin}/player.php?v=${encoded}`;
            document.getElementById('result').innerHTML = `Shareable Link: <a href="${shareableLink}" target="_blank">${shareableLink}</a>`;
        }
    </script>
</head>
<body>
    <h1>Generate Shareable Video Link</h1>
    <input id="video" type="text" placeholder="Enter Cloudinary video URL (e.g., https://res.cloudinary.com/youraccount/video/upload/yourvideo.mp4)" style="width: 500px;">
    <button onclick="generateLink()">Generate Link</button>
    <div id="result" style="margin-top: 20px;"></div>
</body>
</html>
