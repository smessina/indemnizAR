<form method="post" action="send.php" id="send">
  <fieldset>
    <h3>Dejá tu comentario</h3>
    <div class="row">
      <div class="span3"></div>
      <div class="span6"><input name="mail" type="email" placeholder="Email..." required></div>
      <div class="span3"></div>
    </div>

    <div class="row">
      <div class="span3"></div>
      <div class="span6"><textarea name="txt" rows="5" placeholder="Tu opinión aqui..."></textarea></div>
      <div class="span3"></div>
    </div>
        
    <button type="submit" class="btn">Enviar</button>
  </fieldset>
</form>
<script type="text/javascript">
$("#send").submit(function( event ) {
  event.preventDefault(); 
  alert("èè");
  $.ajax({
    type : "POST",
    dataType : "text",
    data : $(this).serialize(), 
    url : $(this).attr("action"),
    success: function( data ) {
      if(data == true) {
        $(".jumbotron").html("<h2>Gracias por su contacto!</h2>");
      } else {
        $(".jumbotron").html("<h2>Error, intente de nuevo o envie un e-mail a silvio.messina@me.com</h2>");
      }
    }
  });
});
</script>