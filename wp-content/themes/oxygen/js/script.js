var d = document,
    preload = d.querySelector('.preload-home'),
    slide = d.querySelector('#slide-mm'),
    slideLi = d.querySelectorAll('#slide-mm li'),
    navSlide = d.getElementById("nav-slide"),
    navSlideLi = d.querySelectorAll('#nav-slide li'),
    slideSelect,
    slideCurrent = slideLi[0],
    numberCurrent = 0;
//
var timeVar =setInterval(function(){myTimer()},5000);
function preloader(){
    preload.classList.add('opacity');
}
function myTimer() {
    numberCurrent = (numberCurrent == Number(slideLi.length-1))? 0 : Number(numberCurrent) + 1;
    slideCurrent = slideLi[numberCurrent];
    createSlide(navSlideLi[numberCurrent]);

}

var slideF = function slideF(e) {
    e.preventDefault();
    numberCurrent = this.dataset.order;
    slideCurrent = slideLi[numberCurrent];
    if (slideCurrent.className != "select-li") {
        createSlide(this);
    }
    clearInterval(timeVar);
    timeVar = setInterval(myTimer, 5000);

}

function createSlide(element){
    slideSelect = d.querySelector('.select-li');
    var slideSelectContend = slideSelect.querySelector('.slide-contend'),
        figure = slideSelect.querySelector('figure');

  //  figure.classList.remove('show-izq');
  //  figure.classList.add('show-izq-hidden');
    slideSelectContend.classList.remove('show-move');
    slideSelectContend.classList.add('hidden-move');

    removeClassSelector(navSlideLi, 'selected');
    element.classList.add('selected');
    slideSelectContend.addEventListener("webkitAnimationEnd", AnimationListener, false);
    slideSelectContend.addEventListener("animationend", AnimationListener,false);
    slideSelectContend.addEventListener("oanimationend", AnimationListener,false);

    slide.style.backgroundImage = 'url(' + slideCurrent.dataset.background + ')';
}
function AnimationListener(e) {
    slideSelect.classList.remove('select-li');
    slideCurrent.classList.add('select-li');
    //slideCurrent.querySelector('figure').classList.remove('show-izq-hidden');
    //slideCurrent.querySelector('figure').classList.add('show-izq');
    slideCurrent.querySelector('.slide-contend').classList.remove('hidden-move');
    slideCurrent.querySelector('.slide-contend').classList.add('show-move');

}

var removeClassSelector = function (selector, nameClass) {

    for (var i = 0; i < selector.length; i++) {

        selector[i].classList.remove(nameClass);

    }
};

function init() {
    slide.style.backgroundImage = 'url(' + slideLi[0].dataset.background + ')';
    for (var i = 0; i < slideLi.length; i++) {
        var li = document.createElement("li");
        li.addEventListener('click', slideF);
        li.setAttribute("data-order", i);
        if (i == 0) {
            li.classList.add('selected')
        }
        navSlide.appendChild(li)
    }
    navSlideLi = d.querySelectorAll('#nav-slide li');
    var slideMM = d.querySelectorAll('#slide-mm li');
    for (var i = 0; i < slideMM.length; i++) {


        slideMM[i].querySelector('.slide-contend').addEventListener("mouseover", func, false);
        slideMM[i].addEventListener("mouseout", func1, false);
    }
}
function func(){
    clearInterval(timeVar);
}
function func1(){

    timeVar = setInterval(myTimer, 5000);
}

init();

