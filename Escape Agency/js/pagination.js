/* Sample JavaScript for basic pagination functionality
document.addEventListener("DOMContentLoaded", () => {
    const cardsPerPage = 4; // Number of cards per page
    const activityCards = Array.from(document.querySelectorAll(".adventures-activity"));
    const paginationContainer = document.querySelector(".adventures-pagination");
    let currentPage = 1;
  
    // Function to show specific cards based on the page
    function showPage(page) {
      const start = (page - 1) * cardsPerPage;
      const end = start + cardsPerPage;
  
      activityCards.forEach((card, index) => {
        card.style.display = index >= start && index < end ? "block" : "none";
      });
  
      updatePagination(page);
    }
  
    /*Function to update pagination buttons
    function updatePagination(page) {
      paginationContainer.innerHTML = "";
  
      const totalPages = Math.ceil(activityCards.length / cardsPerPage);
  
      for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement("button");
        button.textContent = i;
        button.disabled = i === page;
        button.addEventListener("click", () => {
          currentPage = i;
          showPage(currentPage);
        });
        paginationContainer.appendChild(button);
      }
    }
  
    // Initialize the pagination
    if (paginationContainer) {
      showPage(currentPage);
    }
  });
  */
 






document.addEventListener("DOMContentLoaded", () => {
    const container = document.querySelector(".adventures-api-cards");
    const activities = document.querySelectorAll(".adventures-activity");
    let currentIndex = 0;
  
    function scrollToNext() {
      // Increment index and loop back to start if at the end
      currentIndex = (currentIndex + 1) % activities.length;
  
      // Scroll the container to the next activity
      const nextActivity = activities[currentIndex];
      container.scrollTo({
        left: nextActivity.offsetLeft,
        behavior: "smooth", // Smooth scrolling effect
      });
    }
  
    // Automatically scroll every 3 seconds
    setInterval(scrollToNext, 5000);
  });

  document.getElementById("prev-btn").addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + activities.length) % activities.length;
    container.scrollTo({
      left: activities[currentIndex].offsetLeft,
      behavior: "smooth",
    });
  });
  
  document.getElementById("next-btn").addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % activities.length;
    container.scrollTo({
      left: activities[currentIndex].offsetLeft,
      behavior: "smooth",
    });
  });
  