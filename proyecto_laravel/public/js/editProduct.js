window.onload = function(){

  var selectCategory = document.querySelector('#category');
  var selectSubCategory = document.querySelector('#subCategory');

  function ajax(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        console.log(JSON.parse(xmlhttp.responseText));
        var arraySubCategories = JSON.parse(xmlhttp.responseText);
        selectSubCategory.innerHTML = "";
        for (var i = 0; i < arraySubCategories.length; i++) {
          var id = arraySubCategories[i].id;
          var name = arraySubCategories[i].name;
          selectSubCategory.innerHTML += "<option value = '" + id + "'>" + name + "</option>"
        }
      }
    }
    xmlhttp.open('GET', '/api/subCategories/' + selectCategory.value, true);
    xmlhttp.send();
  }

  selectCategory.onchange = function(){ajax()};
}
