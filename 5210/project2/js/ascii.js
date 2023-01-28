var step = 0;
var animation;
var size;
var turbo;
var viewer;
var speed;
var myInterval;
var text;
var playing;

function startAnimation() {
    getStopButton().disabled = false;
    getStartButton().disabled = true;
    getAnimationSelect().disabled = true;
    
    animation = getAnimationText(); 
    viewer = getViewer();
    playing = true;
    myInterval = setInterval(animate, getSpeed());
    viewer.disabled;
}

function animate() {
    viewer.value = animation[step];
    if (step < animation.length - 1) {
        step += 1;
    } else {
        step = 0;
    }
}

function changeAnimation() {
    setSize();
    if (playing) {
        clearInterval(myInterval);
        myInterval = setInterval(animate, getSpeed());
    }
}

function stopAnimation() {
    getStartButton().disabled = false;
    getStopButton().disabled = true;
    getAnimationSelect().disabled = false;
    clearInterval(myInterval);
    getViewer().value = text;
    playing = false;
    step = 0;
}


function getAnimationText() {
    text = getViewer().value;
    return text.split("=====\n");
}

function setAnimationText() {
    var selected = document.getElementById("animation").value  
    getViewer().value = ANIMATIONS[selected];
}

function setSize() {
    getViewer().style.fontSize = getSize();
}

function getSize() {
    return document.getElementById("size").value;
}

function getSpeed() {
    speed = 250;
    if (document.getElementById("turbo").checked) {
        speed = 50;
    }
    return speed;
}

function getViewer() {
    return document.getElementById("animation-viewer");
}

function getStartButton() {
   return document.getElementById("start");
}

function getStopButton() {
    return document.getElementById("stop");
}
function getAnimationSelect() {
    return document.getElementById("animation");
}