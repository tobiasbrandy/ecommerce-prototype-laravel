function shoplist(idProduct){
  console.log(idProduct);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      var response = JSON.parse(xmlhttp.responseText);
      console.log(response);
      if (response.success == true) {
        document.querySelector("#btn-shp1-" + idProduct).style.display = 'none';
        document.querySelector("#btn-shp2-" + idProduct).style.display = 'inline-block';
      }
    }
  }
  xmlhttp.open('GET', '/api/shoplist/' + idProduct, true);
  //xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); Para POST.
  xmlhttp.send();
}

function unshoplist(idProduct){
  console.log(idProduct);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      var response = JSON.parse(xmlhttp.responseText);
      if (response.success == true) {
        document.querySelector("#btn-shp2-" + idProduct).style.display = 'none';
        document.querySelector("#btn-shp1-" + idProduct).style.display = 'inline-block';
      }
    }
  }
  xmlhttp.open('GET', '/api/unshoplist/' + idProduct, true);
  xmlhttp.send();
}

function unshoplistAndUnlist(idProduct){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      var response = JSON.parse(xmlhttp.responseText);
      if (response.success == true) {
        document.querySelector("#div-" + idProduct).parentNode.removeChild(document.querySelector("#div-" + idProduct));

      var products = updateTotalPrice();
      }
      if (products.length == 0) {
        document.querySelector('#product-full').style.display = 'none';
        document.querySelector('#product-empty').style.display = 'inline-block';
      }
    }
  }
  xmlhttp.open('GET', '/api/unshoplist/' + idProduct, true);
  xmlhttp.send();
}

function updateTotalPrice(){
  var products = document.getElementsByClassName('col-xs-6 col-sm-3');

  var totalPrice = 0;
  for (var i = 0; i < products.length; i++) {
    var quantity = products[i].querySelector('#quantity').value;
    var productPrice = products[i].querySelector('#productPrice').innerText;
    totalPrice += parseInt(productPrice) * parseInt(quantity);
  }
  document.querySelector('#totalPrice').innerText = totalPrice;

  return products;
}
