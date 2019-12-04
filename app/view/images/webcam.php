<div class="webcam-container">

<div class="stickers" id="stickers">

	<input type="checkbox" value="1" name="sticker" id="sticker1">
	<input type="checkbox" value="2" name="sticker" id="sticker2">
	<input type="checkbox" value="3" name="sticker" id="sticker3">

	<label for="sticker1" ><img src="/sticker/sticker0.png" alt="sticker 1"  width="150" /></label>
	<label for="sticker2" ><img src="/sticker/sticker1.png" alt="sticker 2"  width="150" /></label>
	<label for="sticker3" ><img src="/sticker/sticker2.png" alt="sticker 3"  width="150" /></label>
</div>

<div class="video-preview">
	<div id="sticker0-preview"><img width="150"/></div>
	<div id="sticker1-preview"><img  width="150"/></div>
	<div id="sticker2-preview"><img  width="150"/></div>
    <video id="video" playsinline autoplay></video>
    <div class="capture-button">
        <button id="snap">Capture</button>
    </div>
</div>





<canvas id="canvas" width="640" height="480"></canvas>
<div id="preview"></div>

<script src="/public/js/webcam.js"></script>

</div>