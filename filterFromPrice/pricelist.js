const resultTable = document.querySelector("#table");
const clickButton = document.querySelector("#clickButton");
const selectCost = document.querySelector("#input1");
const inputValue = document.querySelector("#input2");
const inputValue2 = document.querySelector("#input3");
const selectValue = document.querySelector("#input4");
const inputCol = document.querySelector("#input5");
clickButton.addEventListener("click", makeRequest);

function makeRequest(){
// создадим пустой объект
var $data = {};
// переберём все элементы input и select формы с id="form "
$('#myForm').find ('input, select').each(function() {
  // добавим новое свойство к объекту $data
  // имя свойства – значение атрибута id элемента
  // значение свойства – значение свойство value элемента
  $data[this.id] = $(this).val();
});

$.ajax({
  method: "POST",
  url: "kod.php",
  data: $data,
  success: function(responce) {
  $('#table').html(responce);
  
  }
});
 
};

