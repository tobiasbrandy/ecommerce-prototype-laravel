function updateShoplistCounter(operator){
  var shoplistCounter = document.querySelector('#shoplistCounter');
  var badgeCounter = document.querySelector('#badge');

  if (operator == 'plus') {
    badgeCounter.style.display = 'inline-block';
    shoplistCounter.innerText++;

  } else if (operator == 'minus') {
    shoplistCounter.innerText--;

    if (shoplistCounter.innerText == 0) {
      badgeCounter.style.display = 'none';
    }
  }
}
