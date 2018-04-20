function activeXHR()
{
	var xhr;

	if (window.ActiveXObject)
	{
		try
		{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	else if (window.XMLHttpRequest)
		xhr = new XMLHttpRequest();
	else
	{
		alert("Your web browser do not support XMLHttpRequest");
		return null;
	}
	return xhr;
}

function postImg(content)
{
	var xhr = activeXHR();

	content = encodeURIComponent(content);

	if (xhr)
	{
		xhr.open("POST", "index.php?action=postPic");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("camContent=" + content);
	}
}

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
		keepit(img.src.split(',')[1]);
	}
);

function keepit(content)
{
	var keep = document.getElementById('keep-it');

	keep.addEventListener("click", function()
		{
			postImg(content);
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