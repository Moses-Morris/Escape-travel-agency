  document.addEventListener("DOMContentLoaded", function() {
  const hearts = document.querySelectorAll(".heart-btn");

  hearts.forEach(heart => {
    heart.addEventListener("click", function() {
      const eventId = this.getAttribute("data-event-id");
      const countSpan = document.getElementById("count-" + eventId);

      // Change color instantly
      this.style.color = "red";

      // Send AJAX request
      fetch("../PHP_Handlers/like_event.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "event_id=" + eventId
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          countSpan.textContent = data.likes; // update count
        } else {
          alert("Error: " + data.message);
        }
      })
      .catch(err => console.error("AJAX error:", err));
    });
  });
});

