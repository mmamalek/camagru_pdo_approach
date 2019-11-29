<!-- <link rel="stylesheet" href="/style.css">
<h1>Webcam</h1>
<div class="container">
	<video id="video"></video>
	<button id="capture"></button>
	<canvas id="canvas"></canvas>
	<script>
		
	</script>
</div> -->

<div class="video-wrap">
    <video id="video" playsinline autoplay></video>
</div>

<div class="stickers" id="stickers">
	<img src="/sticker/st1.png" alt="sticker 1" id="sticker1" width="150" />
</div>

<div class="controller">
    <button id="snap">Capture</button>
    <button id="save">Save</button>
</div>

<canvas id="canvas" width="640" height="480"></canvas>

<script src="/public/js/webcam.js"></script>