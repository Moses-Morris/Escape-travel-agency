
/* addstep.js
   Rewritten booking step JS: days calc for hosting (per-night), totals, hidden inputs for checkout.
   Drop into your site to replace the previous addstep.js
*/

document.addEventListener("DOMContentLoaded", () => {
  // --- Config & DOM references ---
  const form = document.getElementById('bookingForm');
  if (!form) {
    console.warn('Booking form (#bookingForm) not found - addstep.js aborting.');
    return;
  }

  const destinationSpan = document.getElementById('destinationPrice');
  const destinationPrice = destinationSpan ? parseFloat(destinationSpan.textContent || '0') || 0 : 0;

  const selectedActivitiesDisplay = document.getElementById('selectedActivitiesDisplay');
  const selectedHostingDisplay = document.getElementById('selectedHostingDisplay');
  const selectedTravelDisplay = document.getElementById('selectedTravelDisplay'); // may be absent

  // Step 3 container (we look for date/number inputs inside it)
  const step3 = document.getElementById('step3');
  const dateInputs = step3 ? step3.querySelectorAll('input[type="date"]') : [];
  const startInput = dateInputs[0] || null;
  const endInput = dateInputs[1] || null;
  const numPeopleInput = step3 ? step3.querySelector('input[type="number"]') : null;

  // Keep state
  let selectedActivities = []; // {title, price}
  let selectedHosting = null;  // {title, price}
  let selectedTravel = null;   // {title, price}
  let total = 0;

  // --- Helpers to ensure hidden inputs exist (so we don't require HTML edits) ---
  function ensureHidden(name, id) {
    let el = document.getElementById(id);
    if (!el) {
      el = document.createElement('input');
      el.type = 'hidden';
      el.name = name;
      el.id = id;
      form.appendChild(el);
    }
    return el;
  }

  const hiddenSelectedActivities = ensureHidden('selected_activities', 'selectedActivitiesInput');
  const hiddenSelectedHosting   = ensureHidden('selected_hosting', 'selectedHostingInput');
  const hiddenHostingNights     = ensureHidden('hosting_nights', 'hostingNightsInput');
  const hiddenHostingTotal      = ensureHidden('hosting_total', 'selectedHostingTotalInput');
  const hiddenSelectedTravel    = ensureHidden('selected_travel', 'selectedTravelInput');
  const hiddenTravelTotal       = ensureHidden('travel_total', 'selectedTravelTotalInput');
  const hiddenDestinationPrice  = ensureHidden('destination_price', 'destinationPriceInput');
  const hiddenTotalAmount       = ensureHidden('total_amount', 'totalAmountInput');
  const hiddenStartDate         = ensureHidden('start_date', 'startDateInput');
  const hiddenEndDate           = ensureHidden('end_date', 'endDateInput');
  const hiddenNumPeople         = ensureHidden('num_people', 'numPeopleInput');

  // put initial destination price (so PHP receives it)
  hiddenDestinationPrice.value = destinationPrice.toFixed(2);

  // --- Date / nights calculation (UTC day diff to avoid timezone fractional day issues) ---
  const MS_PER_DAY = 24 * 60 * 60 * 1000;

  function calcNights() {
    if (!startInput || !endInput) return 1;
    const s = (startInput.value || '').trim();
    const e = (endInput.value || '').trim();
    if (!s || !e) return 1;

    // Create Dates and compare in UTC (year, month, date)
    const sd = new Date(s);
    const ed = new Date(e);
    const sdUTC = Date.UTC(sd.getFullYear(), sd.getMonth(), sd.getDate());
    const edUTC = Date.UTC(ed.getFullYear(), ed.getMonth(), ed.getDate());

    let diff = Math.round((edUTC - sdUTC) / MS_PER_DAY);
    if (diff <= 0) diff = 1; // same-day or end earlier -> 1 night per your rule
    return diff;
  }

  // --- UI rendering ---
  function renderActivities() {
    if (!selectedActivitiesDisplay) return;
    selectedActivitiesDisplay.innerHTML = '';
    selectedActivities.forEach((act, idx) => {
      const div = document.createElement('div');
      div.className = 'selected-item';
      div.innerHTML = `
        <span>${escapeHtml(act.title)} - $${Number(act.price).toFixed(2)}</span>
        <button type="button" onclick="removeItem('activity', ${idx})">✖</button>
      `;
      selectedActivitiesDisplay.appendChild(div);
    });
    hiddenSelectedActivities.value = JSON.stringify(selectedActivities);
  }

  function renderHosting() {
    if (!selectedHostingDisplay) return;
    selectedHostingDisplay.innerHTML = '';
    if (!selectedHosting) {
      hiddenSelectedHosting.value = '';
      hiddenHostingNights.value = 0;
      hiddenHostingTotal.value = Number(0).toFixed(2);
      return;
    }

    const nights = calcNights();
    const hostingTotal = Number(selectedHosting.price) * nights;

    const div = document.createElement('div');
    div.className = 'selected-item';
    div.innerHTML = `
      <span>${escapeHtml(selectedHosting.title)} - $${Number(selectedHosting.price).toFixed(2)} per night</span>
      <div style="font-size:0.95em;color:#333">
        <small>${nights} night(s) × $${Number(selectedHosting.price).toFixed(2)} = <strong>$${hostingTotal.toFixed(2)}</strong></small>
      </div>
      <button type="button" onclick="removeItem('hosting', 0)">✖</button>
    `;
    selectedHostingDisplay.appendChild(div);

    // update hidden inputs
    hiddenSelectedHosting.value = JSON.stringify(selectedHosting);
    hiddenHostingNights.value = nights;
    hiddenHostingTotal.value = hostingTotal.toFixed(2);
  }

  function renderTravel() {
    if (selectedTravelDisplay) {
      selectedTravelDisplay.innerHTML = '';
      if (selectedTravel) {
        const div = document.createElement('div');
        div.innerHTML = `<span>${escapeHtml(selectedTravel.title)} - $${Number(selectedTravel.price).toFixed(2)}</span>
                         <button type="button" onclick="removeItem('travel', 0)">✖</button>`;
        selectedTravelDisplay.appendChild(div);
      }
    }
    hiddenSelectedTravel.value = selectedTravel ? JSON.stringify(selectedTravel) : '';
    hiddenTravelTotal.value = selectedTravel ? Number(selectedTravel.price).toFixed(2) : Number(0).toFixed(2);
  }

  function updateTotalAndUI() {
    // recompute everything from state
    const activitiesSum = selectedActivities.reduce((s, a) => s + (Number(a.price) || 0), 0);
    const nights = calcNights();
    const hostingSum = selectedHosting ? (Number(selectedHosting.price) || 0) * nights : 0;
    const travelSum = selectedTravel ? (Number(selectedTravel.price) || 0) : 0;

    total = Number(destinationPrice) + activitiesSum + hostingSum + travelSum;
    // update any visible total spans
    document.querySelectorAll('#totalAmount').forEach(span => {
      span.textContent = Number(total).toFixed(2);
    });

    // update hidden totals
    hiddenTotalAmount.value = Number(total).toFixed(2);
    hiddenDestinationPrice.value = Number(destinationPrice).toFixed(2);
    hiddenHostingNights.value = nights;
    hiddenHostingTotal.value = Number(hostingSum).toFixed(2);
  }

  // --- Utilities ---
  function escapeHtml(text) {
    return String(text || '').replace(/[&<>"'`=\/]/g, function (s) {
      return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;', '/': '&#x2F;', '`': '&#x60;', '=': '&#x3D;' })[s];
    });
  }

  // --- Add / Remove handlers ---
  function handleAddButtonClick(e) {
    const btn = e.currentTarget;
    const type = btn.dataset.type;
    const title = btn.dataset.title;
    const price = parseFloat(btn.dataset.price || '0') || 0;

    if (type === 'activity') {
      // prevent duplicates
      if (selectedActivities.some(a => a.title === title)) {
        alert(`${title} already added.`);
        return;
      }
      selectedActivities.push({ title, price });
      renderActivities();
    } else if (type === 'hosting') {
      // if a hosting exists, replace it
      selectedHosting = { title, price };
      renderHosting();
    }
    updateTotalAndUI();
  }

  // Expose removeItem to global scope (used by inline onclick in generated HTML)
  window.removeItem = function (type, index) {
    if (type === 'activity') {
      if (index >= 0 && index < selectedActivities.length) {
        selectedActivities.splice(index, 1);
        renderActivities();
      }
    } else if (type === 'hosting') {
      selectedHosting = null;
      renderHosting();
    } else if (type === 'travel') {
      selectedTravel = null;
      renderTravel();
    }
    updateTotalAndUI();
  };

  // Attach to all add buttons (activity/hosting)
  document.querySelectorAll('.add-button').forEach(btn => {
    btn.addEventListener('click', handleAddButtonClick);
  });

  // Travel select change (if a select element with id="travel" exists)
  const travelSelect = document.getElementById('travel');
  if (travelSelect) {
    travelSelect.addEventListener('change', function () {
      const opt = travelSelect.options[travelSelect.selectedIndex];
      const title = opt ? (opt.textContent.trim() || opt.value) : '';
      const price = parseFloat(opt ? (opt.dataset.price || '0') : '0') || 0;
      if (!title) {
        selectedTravel = null;
      } else {
        selectedTravel = { title, price };
      }
      renderTravel();
      updateTotalAndUI();
    });
  }

  // Update totals / hosting calculation when dates change
  if (startInput) startInput.addEventListener('change', () => { renderHosting(); updateTotalAndUI(); });
  if (endInput)   endInput.addEventListener('change', () => { renderHosting(); updateTotalAndUI(); });

  // Update hidden num_people when number input changes
  if (numPeopleInput) {
    numPeopleInput.addEventListener('input', () => {
      hiddenNumPeople.value = numPeopleInput.value || '';
    });
  }

  // Ensure hidden start/end get synced on change
  function syncDatesToHidden() {
    hiddenStartDate.value = startInput ? (startInput.value || '') : '';
    hiddenEndDate.value   = endInput   ? (endInput.value   || '') : '';
  }
  if (startInput) startInput.addEventListener('change', syncDatesToHidden);
  if (endInput)   endInput.addEventListener('change', syncDatesToHidden);

  // Before submit: ensure everything is synced and validated
  form.addEventListener('submit', function (ev) {
    // sync UI -> hidden
    renderActivities();
    renderHosting();
    renderTravel();
    syncDatesToHidden();
    if (numPeopleInput) hiddenNumPeople.value = numPeopleInput.value || '';

    updateTotalAndUI();

    // OPTIONAL: Minimal client validation (server should validate too)
    // If you want to block submission if no start/end dates: uncomment below
    // if (!hiddenStartDate.value || !hiddenEndDate.value) { ev.preventDefault(); alert('Please pick check-in and check-out dates'); return false; }
  });

  // Initialize UI render
  renderActivities();
  renderHosting();
  renderTravel();
  updateTotalAndUI();
});










/*document.addEventListener("DOMContentLoaded", () => {
    let currentStep = 1;

    const selectedActivities = [];
    let selectedHosting = null;
    let total = 0;

    function updateDisplay() {
        const activityDisplay = document.getElementById("selectedActivitiesDisplay");
        const hostingDisplay = document.getElementById("selectedHostingDisplay");
        const totalAmount = document.getElementById("totalAmount");
        const activityInput = document.getElementById("selectedActivitiesInput");
        const hostingInput = document.getElementById("selectedHostingInput");

        // Clear previous
        activityDisplay.innerHTML = "";
        hostingDisplay.innerHTML = "";

        // Activities
        selectedActivities.forEach((activity, index) => {
            const item = document.createElement("div");
            item.textContent = `${activity.title} - $${activity.price}`;
            const removeBtn = document.createElement("button");
            removeBtn.textContent = "x";
            removeBtn.onclick = () => {
                total -= activity.price;
                selectedActivities.splice(index, 1);
                updateDisplay();
            };
            item.appendChild(removeBtn);
            activityDisplay.appendChild(item);
        });

        // Hosting
        if (selectedHosting) {
            const item = document.createElement("div");
            item.textContent = `${selectedHosting.title} - $${selectedHosting.price}`;
            const removeBtn = document.createElement("button");
            removeBtn.textContent = "x";
            removeBtn.onclick = () => {
                total -= selectedHosting.price;
                selectedHosting = null;
                updateDisplay();
            };
            item.appendChild(removeBtn);
            hostingDisplay.appendChild(item);
        }

        // Update totals and form inputs
        totalAmount.textContent = total;
        activityInput.value = JSON.stringify(selectedActivities);
        hostingInput.value = selectedHosting ? JSON.stringify(selectedHosting) : "";
    }

    function handleAddClick(event) {
        const button = event.target;
        const type = button.dataset.type;
        const title = button.dataset.title;
        const price = parseFloat(button.dataset.price);

        if (type === "activity") {
            selectedActivities.push({ title, price });
            total += price;
        } else if (type === "hosting") {
            // If another hosting is already selected, subtract its price
            if (selectedHosting) {
                total -= selectedHosting.price;
            }
            selectedHosting = { title, price };
            total += price;
        }

        updateDisplay();
    }

    const addButtons = document.querySelectorAll(".add-button");
    addButtons.forEach(btn => {
        btn.addEventListener("click", handleAddClick);
    });

    // Step navigation functions
    window.nextStep = function(step) {
        document.getElementById(`step${step}`).style.display = "none";
        document.getElementById(`step${step + 1}`).style.display = "block";
        currentStep = step + 1;
    };

    window.prevStep = function(step) {
        document.getElementById(`step${step}`).style.display = "none";
        document.getElementById(`step${step - 1}`).style.display = "block";
        currentStep = step - 1;
    };
});
*/

















/*
document.addEventListener("DOMContentLoaded", () => {
    let selectedActivities = [];
    let selectedHosting = null;
    let total = 0;

    // Update UI displays and hidden inputs
    function updateSelectedDisplay(type) {
        let container, data;

        if (type === "activity") {
            container = document.getElementById("selectedActivitiesDisplay");
            data = selectedActivities;
        } else if (type === "hosting") {
            container = document.getElementById("selectedHostingDisplay");
            data = selectedHosting ? [selectedHosting] : [];
        }

        container.innerHTML = "";

        data.forEach((item, index) => {
            const div = document.createElement("div");
            div.innerHTML = `
                <span>${item.title} - $${item.price}</span>
                <button type="button" onclick="removeItem('${type}', ${index})" style="margin-left:10px;">❌</button>
            `;
            container.appendChild(div);
        });

        // Update hidden inputs
        document.getElementById("selectedActivitiesInput").value = JSON.stringify(selectedActivities);
        document.getElementById("selectedHostingInput").value = selectedHosting ? JSON.stringify(selectedHosting) : "";
    }

    // Remove item and update total
    window.removeItem = function(type, index) {
        if (type === "activity") {
            total -= selectedActivities[index].price;
            selectedActivities.splice(index, 1);
            updateSelectedDisplay("activity");
        } else if (type === "hosting") {
            total -= selectedHosting.price;
            selectedHosting = null;
            updateSelectedDisplay("hosting");
        }
        updateTotal();
    };

    // Update all total price displays
    function updateTotal() {
        document.querySelectorAll("#totalAmount").forEach(span => {
            span.innerText = total.toFixed(2);
        });
    }

    // Add item listener
    document.querySelectorAll(".add-button").forEach(button => {
        button.addEventListener("click", () => {
            const type = button.dataset.type;
            const title = button.dataset.title;
            const price = parseFloat(button.dataset.price);

            if (type === "activity") {
                const exists = selectedActivities.some(item => item.title === title);
                if (exists) {
                    alert(`${title} already selected as activity.`);
                    return;
                }
                selectedActivities.push({ title, price });
                total += price;
                updateSelectedDisplay("activity");
            }

            if (type === "hosting") {
                if (selectedHosting && selectedHosting.title === title) {
                    alert(`${title} is already selected as hosting.`);
                    return;
                }
                if (selectedHosting) {
                    total -= selectedHosting.price;
                }
                selectedHosting = { title, price };
                total += price;
                updateSelectedDisplay("hosting");
            }

            updateTotal();
        });
    });

    // Step navigation
    window.nextStep = function(step) {
        document.getElementById(`step${step}`).style.display = "none";
        document.getElementById(`step${step + 1}`).style.display = "block";

        // Final step summary update
        if (step + 1 === 5) {
            updateTotal();
        }
    };

    window.prevStep = function(step) {
        document.getElementById(`step${step}`).style.display = "none";
        document.getElementById(`step${step - 1}`).style.display = "block";
    };

    // Init display
    updateSelectedDisplay("activity");
    updateSelectedDisplay("hosting");
    updateTotal();
});




*/
/*
document.addEventListener("DOMContentLoaded", () => {
    let selectedActivities = [];
    let selectedHosting = null;
    let selectedTravel = null;
    let destinationPrice = 0;
    let total = 0;

    // Attempt to get destination price from DOM (ID must exist)
    const destinationSpan = document.getElementById("destinationPrice");
    if (destinationSpan) {
        const parsed = parseFloat(destinationSpan.textContent);
        destinationPrice = isNaN(parsed) ? 0 : parsed;
    }

    // Display items in the UI
    function updateSelectedDisplay(type) {
        let container = null;
        let data = [];

        if (type === "activity") {
            container = document.getElementById("selectedActivitiesDisplay");
            data = selectedActivities;
        } else if (type === "hosting") {
            container = document.getElementById("selectedHostingDisplay");
            data = selectedHosting ? [selectedHosting] : [];
        } else if (type === "travel") {
            container = document.getElementById("selectedTravelDisplay");
            data = selectedTravel ? [selectedTravel] : [];
        }

        if (container) {
            container.innerHTML = "";

            data.forEach((item, index) => {
                const div = document.createElement("div");
                div.innerHTML = `
                    <span>${item.title} - $${item.price}</span>
                    <button type="button" onclick="removeItem('${type}', ${index})" style="margin-left:10px;">❌</button>
                `;
                container.appendChild(div);
            });
        }

        // Update hidden inputs for submission (if needed)
        document.getElementById("selectedActivitiesInput").value = JSON.stringify(selectedActivities);
        document.getElementById("selectedHostingInput").value = selectedHosting ? JSON.stringify(selectedHosting) : "";
    }

    // Remove from selection
    window.removeItem = function (type, index) {
        if (type === "activity") {
            total -= selectedActivities[index].price;
            selectedActivities.splice(index, 1);
        } else if (type === "hosting") {
            if (selectedHosting) total -= selectedHosting.price;
            selectedHosting = null;
        } else if (type === "travel") {
            if (selectedTravel) total -= selectedTravel.price;
            selectedTravel = null;
        }

        updateSelectedDisplay(type);
        updateTotal();
    };

    // Update the displayed total
    function updateTotal() {
        const activitySum = selectedActivities.reduce((sum, a) => sum + a.price, 0);
        const hosting = selectedHosting ? selectedHosting.price : 0;
        const travel = selectedTravel ? selectedTravel.price : 0;

        total = destinationPrice + activitySum + hosting + travel;

        document.querySelectorAll("#totalAmount").forEach(span => {
            span.innerText = total.toFixed(2);
        });
    }

    // Main add button handler
    document.querySelectorAll(".add-button").forEach(button => {
        button.addEventListener("click", () => {
            const type = button.dataset.type;
            const title = button.dataset.title;
            const price = parseFloat(button.dataset.price);

            if (type === "activity") {
                const exists = selectedActivities.some(item => item.title === title);
                if (exists) {
                    alert(`${title} already selected as activity.`);
                    return;
                }
                selectedActivities.push({ title, price });
                total += price;
                updateSelectedDisplay("activity");
            }

            if (type === "hosting") {
                if (selectedHosting && selectedHosting.title === title) {
                    alert(`${title} is already selected as hosting.`);
                    return;
                }
                if (selectedHosting) total -= selectedHosting.price;

                selectedHosting = { title, price };
                total += price;
                updateSelectedDisplay("hosting");
            }

            updateTotal();
        });
    });

    // Travel Option dropdown logic
    const travelSelect = document.getElementById("travel");
    if (travelSelect) {
        travelSelect.addEventListener("change", function () {
            const selectedOption = this.options[this.selectedIndex];
            const title = selectedOption.textContent.trim();
            const price = parseFloat(selectedOption.dataset.price || "0");

            if (selectedTravel) total -= selectedTravel.price;

            selectedTravel = { title, price };
            total += price;

            updateSelectedDisplay("travel");
            updateTotal();
        });
    }

    // Step navigation logic
   window.nextStep = function(step) {
        document.getElementById(`step${step}`).style.display = "none";
        document.getElementById(`step${step + 1}`).style.display = "block";

        if (step + 1 === 5) {
            updateSummary();  // ✅ Populate summary now
        }
    };

    window.prevStep = function (step) {
        document.getElementById(`step${step}`).style.display = "none";
        document.getElementById(`step${step - 1}`).style.display = "block";
    };

    // Update booking summary step 5
   function updateSummary() {
        const destinationPrice = parseFloat(document.getElementById("destinationPrice").innerText);
        const destinationReview = document.getElementById("destinationReview");
        const activityReview = document.getElementById("activityReview");
        const hostingReview = document.getElementById("hostingReview");
        const travelReview = document.getElementById("travelReview");

        // Destination
        destinationReview.innerHTML = `<strong>Destination:</strong> Mt Kilimanjaro - $${destinationPrice.toFixed(2)}`;

        // Activities
        if (selectedActivities.length > 0) {
            let activityList = selectedActivities.map(a => `${a.title} ($${a.price})`).join(", ");
            activityReview.innerHTML = `<strong>Activities:</strong> ${activityList}`;
        } else {
            activityReview.innerHTML = `<strong>Activities:</strong> None selected`;
        }

        // Hosting
        if (selectedHosting) {
            hostingReview.innerHTML = `<strong>Hosting:</strong> ${selectedHosting.title} - $${selectedHosting.price}`;
        } else {
            hostingReview.innerHTML = `<strong>Hosting:</strong> Not selected`;
        }

        // Travel
        const travelSelect = document.getElementById("travel");
        const travelOption = travelSelect.options[travelSelect.selectedIndex];
        const travelValue = travelOption.value;
        const travelPrice = parseFloat(travelOption.dataset.price || "0");
        
        travelReview.innerHTML = travelValue 
            ? `<strong>Travel:</strong> ${travelValue} - $${travelPrice}`
            : `<strong>Travel:</strong> Not selected`;

        // Update total again just to be sure
        updateTotal();
    }

    // Initialize
    updateSelectedDisplay("activity");
    updateSelectedDisplay("hosting");
    updateSelectedDisplay("travel");
    updateTotal();
});
*/