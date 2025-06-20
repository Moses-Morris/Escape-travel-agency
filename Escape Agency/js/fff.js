document.addEventListener("DOMContentLoaded", () => {
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
            removeBtn.textContent = "Remove";
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
            removeBtn.textContent = "Remove";
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
