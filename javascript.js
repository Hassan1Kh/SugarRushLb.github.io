

const slideshow = document.getElementById('paralexo');

const imagDir = ["im1.jpg","im2.jpg","im3.jpg","im4.jpg"];
let index = 0;




function forworder()
{
	
	slideshow.setAttribute("style","background-image: url('resources/"+imagDir[index]+"')");
	index++;
if(index == imagDir.length)
	index =0;
}

// Set an interval to switch to the next slide every 5 seconds (adjust the timing as needed)
setInterval(forworder, 5000);

windowonload = function () {
var hours = 1; // Reset when storage is more than 24hours
var now = new Date().getTime();
var setupTime = localStorage.getItem('setupTime');
if (setupTime == null) {
    localStorage.setItem('setupTime', now)
} else {
    if(now-setupTime > hours*60*60*1000) {
        sessionStorage.clear()
        localStorage.setItem('setupTime', now);
    }
}
}

 






