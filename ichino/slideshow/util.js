function toggleBorder(divId)
{
	var element = document.getElementById(divId);
	element.style.border = "thick solid #0000FF";
}

var timer = setInterval(function () {slideShow()}, 100);
var element = document.getElementById("image_area");
element.style.opacity = "0";
var imgNum = 0;
var imgPath = "";
var count = 0;
var totalImages = 9;

function slideShow()
{
	//count == 0 means we have started a new cycle.
	if(count == 0)
	{
		imgPath = "<img src = images/" + imgNum + ".jpg>";
		element.innerHTML = imgPath;
	}
	
	//fade in 
	if(count >= 1 && count <= 20)
	{
		element.style.opacity = parseFloat(element.style.opacity) + 0.05;
	}
	
	//add to counter. When counter equals 11 - 29, we do nothing (just display the image)
	count++;
	
	//fade out
	if(count >= 40 && count < 60)
	{
		element.style.opacity = parseFloat(element.style.opacity) - 0.05;
	}
	
	//reset opacity and switch to the next image
	if(count == 60)
	{
		count = 0;
		element.style.opacity = "0";
		imgNum++;
		imgNum = imgNum % totalImages;
	}
	
	if(parseFloat(element.style.opacity) < parseFloat("0"))
		alert("UH OH!");

	if(parseFloat(element.style.opacity) < parseFloat("0.0"))
		alert("OH NO!");


}