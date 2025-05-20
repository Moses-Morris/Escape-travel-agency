function openPopup(type) {
    fetch('travel_documents_advice.php')
      .then(response => response.text())
      .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const body = doc.body.innerHTML;
        document.getElementById('popupContent').innerHTML = body + '<a href="javascript:void(0)" class="popup-close" onclick="closePopup()">Cancel & Go Back</a>';
        document.getElementById('popupOverlay').style.display = 'block';
      });
  }

  function closePopup() {
    document.getElementById('popupOverlay').style.display = 'none';
    document.getElementById('popupContent').innerHTML = '';
  }