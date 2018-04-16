	
const constraints = {
  video: true
};

const button = document.querySelector('#screenshot-button');
const img = document.querySelector('#screenshot-img');
const video = document.querySelector('#screenshot-video');

const canvas = document.createElement('canvas');

var select, getImg;
const width = 150;
var height = 0;

button.onclick = video.onclick = function() {
	canvas.width = width;
	height = video.videoHeight / (video.videoWidth/width);
	canvas.height = height;
	ctx = canvas.getContext('2d');
	ctx.drawImage(video, 0, 0, width, height);
	img.src = canvas.toDataURL('image/webp');
	getImg = "getImg=" + img.src.split(',')[1];
	document.cookie = getImg;
	select = '<a href ="index.php?action=upload_img" >KEEP THIS</a>';
	console.log(img.src.length); //////////////////// debug size
	console.log(btoa(ctx.getImageData(10,10,50,50).data).length); //////////////////////// debug size
	document.querySelector('#buttons').innerHTML += select;
};

function handleSuccess(stream) {
video.srcObject = stream;
}
function handleError(error) {
console.error('Reeeejected!', error);
}

navigator.mediaDevices.getUserMedia(constraints).
then(handleSuccess).catch(handleError);