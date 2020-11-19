function getOrder(order){
  document.write(order);
  var imageOrder = "";
  for (i = 0; i < sizeof(order); i++) {
      imageOrder += "url(\"./index.php?c=image&i=" + order[i] + "\"),";
  }
  document.getElementById("puzzle").style.backgroundImage = imageOrder;
});
