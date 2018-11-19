
(function(){
    var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        photo = document.getElementById('photo'),
        button = document.getElementById('download'),
        x = 0;
        y = 0;
        vendorUrl = window.URL || window.webkitURL;
    navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;


    navigator.getMedia({
        video: true,
        audio: false
    }, function(stream){
        try{
            video.srcObject = stream;
        }
        catch (error){
            video.src = vendorUrl.createObjectURL(stream);
        }
        video.play();
    }, function(error) {
        alert(e.name);
    });
    sticker = new Image();

    document.getElementById('stick1').addEventListener('click', function() {
      sticker.src = '../stickers/cat.png';
      photo.src = sticker.src;
      x = 1;
      });

   document.getElementById('stick2').addEventListener('click', function() {
        sticker.src = '../stickers/duck.png';
        photo.src = sticker.src;
        x = 1;
        });

   document.getElementById('stick3').addEventListener('click', function() {
          sticker.src = '../stickers/boss_1.png';
          photo.src = sticker.src;
          x = 1;
          });

   document.getElementById('stick5').addEventListener('click', function() {
          sticker.src = '../stickers/wtc.png';
          photo.src = sticker.src;
          x = 1;
          });
   document.getElementById('stick4').addEventListener('click', function() {
          sticker.src = '../stickers/empty.png';
          context.clearRect(0, 0, 400, 300);
          photo.src = sticker.src;
          x = 0;
          });

   document.getElementById('capture').addEventListener('click', function(){
      if (x == 1)
      {
        context.drawImage(video, 0, 0, 400, 300);
        context.drawImage(sticker, 0, 0, 400, 300);
        var imagex = new Image();
	      imagex.src = canvas.toDataURL("image/png");
      }
      else {
          alert("SELECT A STICKER!");
      }
      });

      document.getElementById('SAVE').addEventListener('click', function(){
        var hr = new XMLHttpRequest();
        var url = "server.php";
        var usr = '<?php echo $_SESSION["uname"]; ?>';
        var pic = (encodeURIComponent(JSON.stringify(img.src)));
        var vars = "username="+usr+"&pic="+pic+"&submit_pic=true";
        hr.open("POST", url, true);
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("status").innerHTML = return_data;
        }
     }
     hr.send(vars);
     document.getElementById("status").innerHTML = "processing...";
     });
})();
