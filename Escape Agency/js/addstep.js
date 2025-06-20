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
