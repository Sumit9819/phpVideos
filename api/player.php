<?php
if (!isset($_GET['v'])) {
    die('No video URL provided.');
}
$encoded = $_GET['v'];
$video_url = base64_decode($encoded);
if (!$video_url || !str_contains($video_url, 'cloudinary.com')) {
    die('Invalid video URL.');
}

// Generate thumbnail URL from Cloudinary (replaces /upload/ with /upload/f_jpg,fl_screenshot/ for a JPG screenshot)
$thumbnail_url = preg_replace('/\/upload\//', '/upload/f_jpg,fl_screenshot/', $video_url);

// Get the full URL of this player page for twitter:player
$player_url = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

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
    <meta name="twitter:player" content="<?php echo $player_url; ?>"> <!-- Added: Points to this page for iframe embedding -->
    <meta name="twitter:player:width" content="1280">
    <meta name="twitter:player:height" content="720">
    <meta name="twitter:player:stream" content="<?php echo $video_url; ?>"> <!-- Fallback for direct stream on mobile -->
    <meta name="twitter:player:stream:content_type" content="video/mp4">
    <style>
        html, body { margin: 0; padding: 0; height: 100%; width: 100%; overflow: hidden; }
        video { width: 100%; height: 100%; object-fit: contain; } /* Responsive full-viewport video */
    </style>
</head>
<body>
    <video controls autoplay muted playsinline> <!-- Autoplay muted for policy; controls required -->
        <source src="<?php echo $video_url; ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</body>
</html>
