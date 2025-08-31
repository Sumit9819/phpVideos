<?php
if (!isset($_GET['v'])) {
    die('No video URL provided.');
}
$encoded = $_GET['v'];
$video_url = base64_decode($encoded);
if (!$video_url || !str_contains($video_url, 'cloudinary.com')) {
    die('Invalid video URL.');
}

// Generate thumbnail URL from Cloudinary video (replaces /upload/ with /upload/f_jpg,fl_screenshot/ for a JPG screenshot)
$thumbnail_url = preg_replace('/\/upload\//', '/upload/f_jpg,fl_screenshot/', $video_url);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Video</title>
    <meta name="twitter:card" content="player">
    <meta name="twitter:site" content="@your_twitter_username"> <!-- Replace with your X username -->
    <meta name="twitter:title" content="My Awesome Video">
    <meta name="twitter:description" content="Check out this video streamed from Cloudinary!">
    <meta name="twitter:image" content="<?php echo $thumbnail_url; ?>">
    <meta name="twitter:player:width" content="1280">
    <meta name="twitter:player:height" content="720">
    <meta name="twitter:player:stream" content="<?php echo $video_url; ?>">
    <meta name="twitter:player:stream:content_type" content="video/mp4">
</head>
<body>
    <h1>Video Player</h1>
    <video controls width="1280" height="720">
        <source src="<?php echo $video_url; ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</body>
</html>
