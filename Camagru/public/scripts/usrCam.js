	
const constraints = {
  video: true
};

const button = document.querySelector('#screenshot-button');
const img = document.querySelector('#screenshot-img');
const video = document.querySelector('#screenshot-video');

const canvas = document.createElement('canvas');

button.onclick = video.onclick = function() {
	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	canvas.getContext('2d').drawImage(video, 0, 0);
	img.src = canvas.toDataURL('image/webp');
};

function handleSuccess(stream) {
video.srcObject = stream;
}
function handleError(error) {
console.error('Reeeejected!', error);
}

navigator.mediaDevices.getUserMedia(constraints).
then(handleSuccess).catch(handleError);