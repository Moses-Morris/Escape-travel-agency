/*document.addEventListener('DOMContentLoaded', () => {
    const heartButtons = document.querySelectorAll('.heart-btn');

    heartButtons.forEach(button => {
        button.addEventListener('click', async () => {
            const eventId = button.dataset.eventId;

            try {
                const response = await fetch('../PHP_Handlers/favorite_handler.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=toggle_favorite&event_id=${eventId}`
                });

                const data = await response.json();

                if (data.success) {
                    button.classList.toggle('favorited', data.is_favorited);
                    const countElement = document.getElementById(`count-${eventId}`);
                    if (countElement) countElement.textContent = data.total_favorites;
                }
            } catch (error) {
                console.error('Error toggling favorite:', error);
            }
        });
    });

    // Load initial counts
    fetch('../PHP_favorite_handler.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=get_counts'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const { counts, user_favorites } = data;
            Object.entries(counts).forEach(([eventId, count]) => {
                const countElement = document.getElementById(`count-${eventId}`);
                if (countElement) countElement.textContent = count;
            });
            user_favorites.forEach(eventId => {
                const btn = document.querySelector(`.heart-btn[data-event-id="${eventId}"]`);
                if (btn) btn.classList.add('favorited');
            });
        }
    })
    .catch(error => console.error('Error loading favorite counts:', error));
});

*/

document.addEventListener('DOMContentLoaded', function () {
    const likeButtons = document.querySelectorAll('.heart-btn');
  
    likeButtons.forEach(button => {
      const eventId = button.getAttribute('data-event-id');
      const countSpan = document.getElementById(`count-${eventId}`);
  
      // Initialize count from local storage if available
      const savedCount = localStorage.getItem(`event-${eventId}-count`);
      const liked = localStorage.getItem(`event-${eventId}-liked`) === 'true';
  
      countSpan.textContent = savedCount || '0';
      if (liked) {
        button.classList.add('favorited');
      }
  
      button.addEventListener('click', () => {
        let count = parseInt(countSpan.textContent);
        const isFavorited = button.classList.toggle('favorited');
  
        if (isFavorited) {
          count++;
        } else {
          count = Math.max(0, count - 1);
        }
  
        countSpan.textContent = count;
  
        // Save state in local storage
        localStorage.setItem(`event-${eventId}-count`, count);
        localStorage.setItem(`event-${eventId}-liked`, isFavorited);
      });
    });
  });
  
