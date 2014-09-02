var d = document,
    slide = d.querySelector('#slide-mm'),
    slideLi = d.querySelectorAll('#slide-mm li'),
    navSlide = d.getElementById("nav-slide"),
    navSlideLi = d.querySelectorAll('#nav-slide li'),
    slideSelect,
    slideCurrent = slideLi[0],
    numberCurrent = 0;
//
var timeVar =setInterval(function(){myTimer()},5000);

function myTimer() {

    numberCurrent = (numberCurrent == Number(slideLi.length-1))? 0 :numberCurrent + 1;
    slideCurrent = slideLi[numberCurrent];
    createSlide(navSlideLi[numberCurrent]);

}

var slideF = function slideF(e) {
    e.preventDefault();
    numberCurrent = this.dataset.order;
    slideCurrent = slideLi[this.dataset.order];


    clearInterval(timeVar);
    timeVar = setInterval(myTimer, 5000);
    if (slideCurrent.className != "select-li") {
        createSlide(this);
    }
}

function createSlide(element){
    slideSelect = d.querySelector('.select-li');
    var slideSelectContend = slideSelect.querySelector('.slide-contend');

    slideSelectContend.classList.remove('show-move');
    slideSelectContend.classList.add('hidden-move');

    removeClassSelector(navSlideLi, 'selected');
    element.classList.add('selected');
    console.log(slideSelectContend)
    slideSelectContend.addEventListener("webkitAnimationEnd", AnimationListener, false);
    slideSelectContend.addEventListener("animationend", AnimationListener,false);
    slideSelectContend.addEventListener("oanimationend", AnimationListener,false);

    slide.style.backgroundImage = 'url(' + slideCurrent.dataset.background + ')';
}
function AnimationListener(e) {
    slideSelect.classList.remove('select-li');
    slideCurrent.classList.add('select-li');
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
}


init();

