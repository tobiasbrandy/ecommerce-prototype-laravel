
function wishlist(idProduct){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      var response = JSON.parse(xmlhttp.responseText);
      if (response.success == true) {
        document.querySelector("#btn-1-" + idProduct).style.display = 'none';
        document.querySelector("#btn-2-" + idProduct).style.display = 'inline-block';
      }
    }
  }
  xmlhttp.open('GET', '/api/wishlist/' + idProduct, true);
  //xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); Para POST.
  xmlhttp.send();
}

function unwishlist(idProduct){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      var response = JSON.parse(xmlhttp.responseText);
      if (response.success == true) {
        document.querySelector("#btn-2-" + idProduct).style.display = 'none';
        document.querySelector("#btn-1-" + idProduct).style.display = 'inline-block';
      }
    }
  }
  xmlhttp.open('GET', '/api/unwishlist/' + idProduct, true);
  xmlhttp.send();
}

function unwishlistAndUnlist(idProduct){
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
  xmlhttp.open('GET', '/api/unwishlist/' + idProduct, true);
  xmlhttp.send();
}
