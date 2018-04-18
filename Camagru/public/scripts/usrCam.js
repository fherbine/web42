	
const constraints = {
  video: true
};

const button = document.querySelector('#screenshot-button');
const img = document.querySelector('#screenshot-img');
const video = document.querySelector('#screenshot-video');

const canvas = document.createElement('canvas');

var select, getImg;
const width = 2800;
var height = 0;

button.addEventListener("click", function()
	{
		canvas.width = width;
		height = video.videoHeight / (video.videoWidth/width);
		canvas.height = height;
		ctx = canvas.getContext('2d');
		ctx.drawImage(video, 0, 0, width, height);
		img.src = canvas.toDataURL('image/webp');
		if (!document.getElementById('keep-it'))
		{
			select = '<button id="keep-it" >KEEP THIS</a>';
			document.getElementById('buttons').innerHTML += select;
		}
		console.log(img.src.length); //////////////////// debug size
		console.log(btoa(ctx.getImageData(10,10,50,50).data).length); //////////////////////// debug size
		keepit();
	}
);

function keepit()
{
	var keep = document.getElementById('keep-it');

	keep.addEventListener("click", function()
		{
			console.log("toto");
		}
	);
}


function handleSuccess(stream) {
	video.srcObject = stream;
}
function handleError(error) {
	console.error('Reeeejected!', error);
}

navigator.mediaDevices.getUserMedia(constraints).
then(handleSuccess).catch(handleError);