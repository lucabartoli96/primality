

window.onload = function () {
    
    var number = parseInt(document
        .getElementsByTagName("script")[0]
        .getAttribute("data-number"));
    
    var numbers = document.querySelectorAll(".number_group span");
    
    if ( numbers ) {
         for(var i = 0; i < numbers.length; i++) {
             numbers[i].addEventListener(
                 "click",
                 function (event) {
                     var selected_number = parseInt(event.target.innerHTML);
                     document
                     .getElementsByName("number")[0]
                     .setAttribute("value", selected_number);
                     document
                     .getElementsByTagName("form")[0]
                     .submit();
                 });
         }
    }
}
