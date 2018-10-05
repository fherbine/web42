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

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

function postImg(content, fpath)
{
	var xhr = activeXHR();

	content = encodeURIComponent(content);

	if (xhr)
	{
		xhr.open("POST", "index.php?action=AddPic", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		console.log(xhr.send("camContent=" + content + "&fpath=" + fpath));
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState == XMLHttpRequest.DONE)
			{
    			var id = getCookie('AddingPicID');
    			box.innerHTML += '<form method="POST" action="index.php?action=SendPic&iid=' + id + '"><input type="image" src="public/user/' + uid + '-' + id + '.png" /></form>';
    		}
		});
	}
}

const constraints = {
  video: true
};

const button = document.querySelector('#screenshot-button');
var src;
const video = document.querySelector('#screenshot-video');
const vidFilter = document.querySelector("#filterV");
vidFilter.src = 'public/imgs/42.png'; // default filter
fpath = 'public/imgs/42.png';
const f42n = document.querySelector('#filter_42n');
const f42 = document.querySelector('#filter_42');
const fsun = document.querySelector('#filter_sun');
const uploaded = document.querySelector('#uImg');
const keep = document.querySelector('#keep-it');
const box = document.querySelector('#img_box');
const uid = document.querySelector('#uid').innerHTML;

const canvas = document.createElement('canvas');

var select, getImg;
const width = 400;
var height = 0;

// function createKeepButton()
// {
// 	keep.style = 'display:block;';
// }

// keep.addEventListener("click", function()
// 	{
// 		var content = src.split(',')[1];
// 		postImg(content, fpath);
// 	}
// );

button.addEventListener('click', function()
	{
		canvas.width = width;
		height = video.videoHeight / (video.videoWidth/width);
		canvas.height = height;
		ctx = canvas.getContext('2d');
		ctx.drawImage(video, 0, 0, width, height);
		src = canvas.toDataURL('image/png');
		// createKeepButton();
		var content = src.split(',')[1];
		postImg(content, fpath);
	}
);

function uploadVisual(file)
{
	var upl = new FileReader();

	upl.addEventListener('load', function()
	{
		src = this.result;
		var content = src.split(',')[1];
		postImg(content, fpath);
	});

	upl.readAsDataURL(file);
	// createKeepButton();
}

uploaded.addEventListener('change', function()
	{
		if (this.files[0].type == 'image/png')
		{
			uploadVisual(this.files[0]);

		}
	});

f42.addEventListener("click", function()
	{
		fpath = 'public/imgs/42.png';
		vidFilter.src = fpath;
		//document.getElementById("cam").innerHTML += '<img src="public/imgs/42.png" alt="logo42"/>';
	}
);

f42n.addEventListener("click", function()
	{
		fpath = 'public/imgs/42neg.png';
		vidFilter.src = fpath;
		//document.getElementById("cam").innerHTML += '<img src="public/imgs/42.png" alt="logo42"/>';
	}
);

fsun.addEventListener("click", function()
	{
		fpath = 'public/imgs/sun.png';
		vidFilter.src = fpath;
		//document.getElementById("cam").innerHTML += '<img src="public/imgs/42.png" alt="logo42"/>';
	}
);

// function keepit(content)
// {
// }


function handleSuccess(stream) {
	video.srcObject = stream;
}
function handleError(error) {
	console.error('Reeeejected!', error);
}

navigator.mediaDevices.getUserMedia(constraints).
then(handleSuccess).catch(handleError);