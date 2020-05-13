let leftScroller;
let rightScroller;
let videoScroller;


let items = {
    "video1": 1,
    "video2": 2,
    "video3": 3,
    "video4": 4,
    "video5": 5,
    "video6": 6,
};

let imagesEventsTriggered = 6;

window.onload = function () {
    leftScroller = document.getElementById("leftScroller");
    rightScroller = document.getElementById("rightScroller");
    videoScroller = document.getElementById("videoScroller");


    leftScroller.addEventListener("click", function () {
        if (imagesEventsTriggered === 6) {
            imagesEventsTriggered = 0;
            scroll(0);
        }
    });

    rightScroller.addEventListener("click", function () {
        if (imagesEventsTriggered === 6) {
            imagesEventsTriggered = 0;
            scroll(1);
        }
    });
    let videoList = document.getElementsByClassName("videoScrollerItem");

    let navigatorEvents = whichTransitionEvent();

    for (let i = 0; i < videoList.length; i++) {
        videoList[i].addEventListener(navigatorEvents, function () {

            let itemId = this.getAttribute('id');

            //Lo devolvemos a su posicion sutilmente para que no parezca abrupto
            this.classList.add('notransition'); // Desactivamos transiciones
            this.style.transform = "translateX(0)";
            this.offsetHeight; // Provocamos un reflow en css, permitiendo que se produzcan los cambios
            this.classList.remove('notransition'); // Activamos de nuevo las transiciones

            //Establecemos el orden
            this.style.order = items[itemId].toString();

            imagesEventsTriggered++;

        }, false);
    }

}

//Util para saber en qué navegador estamos
function whichTransitionEvent() {
    var t;
    var el = document.createElement('fakeelement');
    var transitions = {
        'transition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'MozTransition': 'transitionend',
        'WebkitTransition': 'webkitTransitionEnd'
    }

    for (t in transitions) {
        if (el.style[t] !== undefined) {
            return transitions[t];
        }
    }
}


function scroll(direction) {
    //Obtenemos la lista de los elementos
    let itemList = document.getElementsByClassName("videoScrollerItem");

    //Realizamos el cambio en el orden
    for (let i = 0; i < itemList.length; i++) {
        setPosition(itemList[i].getAttribute('id'), direction);
    }
}

//En esta funcion utilizo el transform porque hacerlo con el left da problemas
//Está programada para albergar 6 videos, pero cambiarlo es tan sencillo como cambiar el
//neworder === 6 y añadirlo en el array de items
function setPosition(idItem, direction) {
    let item = document.getElementById(idItem);
    let newOrder = items[idItem];
    if (direction === 0) {
        if (newOrder === 1) {
            newOrder = 6;
            item.style.transform = "translateX(-106.5%)";
        } else {
            newOrder = items[idItem] - 1;
            item.style.transform = "translateX(-106.5%)";
        }
    } else if (direction === 1) {
        if (newOrder === 6) {
            newOrder = 1;
            item.style.transform = "translateX(+106.5%)";
        } else {
            newOrder = items[idItem] + 1;
            item.style.transform = "translateX(+106.5%)";
        }
    }

    //Guardamos y establecemos el orden
    items[idItem] = newOrder;
}