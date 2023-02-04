var emptySpace = {'x':300,'y':300};
var numbers = [];
var positions = [];
var desc;

window.onload = function() {
    $("shufflebutton").onclick = shuffleTiles;
    desc = $("puzzlearea").descendants();
    setPositions();
    setUpTiles();
}

function updateTiles(func) {
    for(var i = 0; i < desc.length; i++) {  
        func(i);
    }
    setEmptySpace(); 
}

function setPositions() {
    var c = 0;
    for (var i = 0; i < 4; i++) {
        var k = i * 100;
        for (var j = 0; j < 4; j++){
            positions[c] = {'x': j*100, 'y': k};
            c++;
        }
    }
}

function setUpTiles() {
    updateTiles(setClassAndEvent);
}

function setClassAndEvent(index) {
    var j = index + 1; 
    desc[index].setAttribute("id", "tile" + j);
    desc[index].onclick = moveTile;
}

function shuffleTiles() {
   setRandomArray();
   updateTiles(setTilePositions);
}

function setRandomArray() {
    var random;
    numbers = [];
    while (numbers.length < 16) {
        random = Math.floor(Math.random() * 16);
        if(numbers.indexOf(random) == -1) {
            numbers.push(random);
        }
    }
}

function setTilePositions(index) {
    var n = numbers.pop();
    desc[index].setStyle({
        top: positions[n]['y'] + "px",
        left: positions[n]['x'] + "px"
    });
    
}

function setEmptySpace() {
    var lastElement = numbers.pop();
    emptySpace['x'] = positions[lastElement]['x'];
    emptySpace['y'] = positions[lastElement]['y'];
}

function approvedMove(top, left) {
    if(((emptySpace['x'] - 100 == parseInt(left) || emptySpace['x'] + 100 == parseInt(left)) 
    && parseInt(top) == emptySpace['y']) 
    || ((emptySpace['y'] - 100 == parseInt(top) || emptySpace['y'] + 100 == parseInt(top)) 
    && parseInt(left) ==  emptySpace['x'])) {
        return true;
    }
    return false;
}

function moveTile() {
    var top = this.getStyle("top");
    var left = this.getStyle("left");
    if (approvedMove(top, left)){
       var newEmpty = {'x':parseInt(left), 'y':parseInt(top)};
        this.setStyle({
            top: emptySpace['y'] + "px",
            left: emptySpace['x'] + "px"
        });
        emptySpace = newEmpty;
    } 
    checkTilePositions();
}
