<div class="webcam-container">

<div class="stickers" id="stickers">

	<input type="checkbox" value="1" name="sticker" id="sticker1">
	<input type="checkbox" value="2" name="sticker" id="sticker2">
	<input type="checkbox" value="3" name="sticker" id="sticker3">

	<label for="sticker1" ><img src="/sticker/sticker0.png" alt="sticker 1"  width="150" class="st"/></label>
	<label for="sticker2" ><img src="/sticker/sticker1.png" alt="sticker 2"  width="150" class="st"/></label>
	<label for="sticker3" ><img src="/sticker/sticker2.png" alt="sticker 3"  width="150" class="st"/></label>
</div>

<div class="video-preview">
	<div class="ctickers-group">
		<div id="sticker0-preview"><img width="150"/></div>
		<div id="sticker1-preview"><img width="150"/></div>
		<div id="sticker2-preview"><img width="150"/></div>
	</div>

	<img src="" id="upoaded-image-preview" />
	<video id="video" autoplay>Something went wrong</video>
    
</div>

<div id="preview"></div>

<input type="file" name="image" id="upload-image" accept="image/*" /><br />

<div class="control-buttons">
	<button id='start-camera-button' onclick="init">Camera</button>
	<button id="capture-image">Capture</button>
	<button id='choose-image'>Upload Image</button>
	<button id='send-image'>Send Image</button>
</div>
<canvas id="canvas" width="640" height="480"></canvas>

<script src="/public/js/webcam.js"></script>

</div>