var images = [
    'assets/images/slider1.jpg',
    'assets/images/slider2.jpg',
    'assets/images/slider3.jpg',
    'assets/images/slider4.jpg'
]
var slidercount = 0;
var sliderimage = document.getElementById('sliderimage');
var sliderpoints = document.getElementById('sliderpoints');
var points = document.getElementsByClassName('sliderpoint');

function Timer(fn, t){
    var timerObj = window.setInterval(fn, t);
    this.stop = function() {
        if (timerObj) {
            clearInterval(timerObj);
            timerObj = null;
        }
        return this;
    }

    this.start = function() {
        if (!timerObj) {
            this.stop();
            timerObj = window.setInterval(fn, t);
        }
        return this;
    }

    this.reset = function() {
        return this.stop().start();
    }
}

sliderTimer = new Timer(function (){
    if(slidercount==3)
        slidercount = 0;
    else
    slidercount++;
    sliderimage.src=images[slidercount];
    sliderpoints.querySelector('.active').classList.remove('active');
    sliderpoints.children[slidercount].classList.add('active');
}, 5000);

for(var i=0; i<points.length; i++){
    points[i].onclick = function(){
        slidercount = this.dataset.index;
        sliderimage.src=images[slidercount];
        sliderpoints.querySelector('.active').classList.remove('active');
        sliderpoints.children[slidercount].classList.add('active');
        sliderTimer.reset();
    }
}
window.onload = ()=>{
    sliderimage.src=images[0];
    sliderTimer.start();
}
