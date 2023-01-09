// selects the select input 
var select = document.getElementById("cat");  //select input id 

var nameDiv = document.getElementById("nameDiv"); //div
var catDiv = document.getElementById("catDiv"); //div

// add event listener 
select.addEventListener("change", function(){ 
  if(select.value == "category"){
      catDiv.classList.add("show");
      nameDiv.classList.remove("show");
  }
  if(select.value == "name"){
      catDiv.classList.remove("show");
      nameDiv.classList.add("show");  
  }
})