window.onload = function(){
  var timer = 5;

  function redirect(){
    console.log(timer);
    timer -= 1;

    if (timer <= 0) {
      window.clearInterval(interval);

      window.location.href = 'http://localhost:8000/';
    }

    document.querySelector('#span').innerText = timer;
  }

  var interval = setInterval(redirect, 1000);
}
