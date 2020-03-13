function deleteProduct(idProduct){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      var response = JSON.parse(xmlhttp.responseText);
      if (response.success == true) {
        document.querySelector("#div-" + idProduct).parentNode.removeChild(document.querySelector("#div-" + idProduct));
      }
      var products = document.getElementsByClassName('col-xs-6 col-sm-3');
      if (products.length == 0) {
        document.querySelector('#product-full').style.display = 'none';
        document.querySelector('#product-empty').style.display = 'inline-block';
      }
    }
  }
  xmlhttp.open('GET', '/api/deleteProduct/' + idProduct, true);
  xmlhttp.send();
}
