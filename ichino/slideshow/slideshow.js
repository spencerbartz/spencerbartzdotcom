function toggleBorder(divId) {
	var element = document.getElementById(divId);
	element.style.border = "thick solid #0000FF";
}

var timer = setInterval(function () {
	if (!paused) { 
		slideShow();
	}
}, 100);

var imageArea = document.getElementById("image_area");
imageArea.style.opacity = "0";

var imgNum = 0;
var imgTag = "";
var count = 0; // Controls where we are in the fading cycle (Not count of images)
var totalImages = 39;
var paused = false;

const playButton = document.getElementById("play-button");
playButton.addEventListener("click", function() {
	paused = false;
});

const pauseButton = document.getElementById("pause-button");
pauseButton.addEventListener("click", function() {
	paused = true;
});

function slideShow() {
	
	// count == 0 means we have started a new cycle.
	if (count == 0) {
		imgTag = "<img src=\"shashin/" + imgNum + ".jpg\" class=\"slideshow-image\" />";
		imageArea.innerHTML = imgTag;
	}
	
	// Fade in 
	if (count >= 1 && count <= 20) {
		imageArea.style.opacity = parseFloat(imageArea.style.opacity) + 0.05;
	}
	
	// Add to count. When count equals 11 - 29, we do nothing (just display the image)
	count++;
	
	// Fade out
	if(count >= 40 && count < 60) {
		imageArea.style.opacity = parseFloat(imageArea.style.opacity) - 0.05;
	}
	
	// Reset opacity and switch to the next image
	if(count == 60) {
		count = 0;
		imageArea.style.opacity = "0";
		imgNum++;
		imgNum = imgNum % totalImages;
	}
	
	// Check for opacity errors (shouldn't ever happen if the page loads correctly)
	if (parseFloat(imageArea.style.opacity) < parseFloat("0")) {
		console.error("Error: Image opacity out of bounds." + imageArea.style.opacity);
	}

	if(parseFloat(imageArea.style.opacity) < parseFloat("0.0")) {
		console.error("Error: Image opacity out of bounds." + imageArea.style.opacity);
	}
}