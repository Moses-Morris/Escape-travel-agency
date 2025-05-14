let currentStep = 1;

function nextStep(step) {
    document.getElementById('step' + currentStep).style.display = 'none';
    currentStep = step + 1;
    document.getElementById('step' + currentStep).style.display = 'block';
}

function prevStep(step) {
    document.getElementById('step' + currentStep).style.display = 'none';
    currentStep = step - 1;
    document.getElementById('step' + currentStep).style.display = 'block';
}

function updateTotal() {
    let total = 0;
    
    // Handle Destination price
    let destination = document.getElementById('destination').value;
    if (destination === "Paris") total += 100;  // Example price for Paris

    // Handle Activities price
    let selectedActivities = document.querySelectorAll('.activity:checked');
    selectedActivities.forEach(activity => {
        total += 30;  // Example price for each activity
    });

    // Handle Hosting price
    let hosting = document.getElementById('hosting').value;
    if (hosting === "Hotel") total += 200;  // Example price for Hotel

    // Handle Travel price
    let travel = document.getElementById('travel').value;
    if (travel === "Flight") total += 300;  // Example price for Flight

    // Update the session total (this would ideally be done in PHP)
    document.getElementById('totalAmount').textContent = total;
}
