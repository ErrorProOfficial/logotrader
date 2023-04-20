$(document).ready(function() {
  // Постоянно зареждане на нови съобщения от базата данни
  setInterval(function() {
      $.getJSON("server.php", function(data) {
          var chat = $("#chat");
          chat.empty();
          $.each(data, function(key, value) {
              chat.append("<div><span class='sender'>" + value.sender + ":</span><span class='message'>" + value.message + "</span></div>");
          });
          chat.scrollTop(chat.prop("scrollHeight"));
      });
  }, 1000);
  // Изпращане на ново съобщение чрез формата
  $("#message-form").submit(function(event) {
      event.preventDefault();
      var sender = $("#sender").val();
      var message = $("#message").val();
      $.post("server.php", {action: "send", sender: sender, message: message}, function() {
          $("#message").val("");
      });
  });
});