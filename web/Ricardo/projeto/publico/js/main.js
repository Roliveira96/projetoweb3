document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
    instance.open();
});

// Initialize collapsible (uncomment the lines below if you use the dropdown variation)
// var collapsibleElem = document.querySelector('.collapsible');
// var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

// Or with jQuery

$(document).ready(function(){
    $('.sidenav').sidenav();
});

(function(){


function vereficaSeSoString(palavra) {
console.log("AQuid" + palavra) ;
   return  isNaN(palavra)? true : false;
}




    console.log("isNaN " + vereficaSeSoString(12));
    console.log("isNaN " + vereficaSeSoString("asfa"));
    console.log("isNaN " + isNaN("asfa hjghg 655"));
    console.log("isNaN " + isNaN(12));




}())

function $doc(id){
    return document.getElementById(id);
}

function validaString(item , id) {


console.log(item.value)

console.log('Atribulo do id: -- >' +id);

    var element =   document.getElementById(id);

    if (!isNaN(item.value)) {
      element.classList.add('error');
        console.log('inserindo error no html');
    }else{
        element.classList.add('right');
    }



}