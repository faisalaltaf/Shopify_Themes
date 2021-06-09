
// setTimeout(function(){ 

//     function myFunction()
//      {
//          document.querySelector('.product-form__cart-submit').style.display = "none";
//      }
//      console.log(document.querySelector('.product-form__cart-submit'));
 
//   }, 3000);
//  console.log('helo');


 function myFunction() {
    var x = document.getElementById("btnss");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }