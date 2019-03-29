<?php
echo "
<div ID='Konsola' style='
  position:fixed;
  overflow-y: scroll;
  top:80%;
  left:20%;
  width:60%;
  height:20%;
  background-color:blue;
  font-family: Consolas;
  background-color: #012156;
  font-size: 14;
  color: white;
  display:none;
'>Konsola<br></div>";
function konsola($wiadomosc, $nic, $linia)
{
echo "<script>
document.getElementById('Konsola').innerHTML = document.getElementById('Konsola').innerHTML + '<br>" . $linia . " " . $wiadomosc . "';
var scroller = document.getElementById('Konsola');
scroller.scrollTop = scroller.scrollHeight;
</script>";
}
echo "<script>
document.addEventListener('keypress', function onPress(event) {
    if (event.key === '`') {
        if(document.getElementById('Konsola').style.display == 'none'){
        document.getElementById('Konsola').style.display = 'block';
      }else{
        document.getElementById('Konsola').style.display = 'none';
      }
    }
});
</script>"
?>
