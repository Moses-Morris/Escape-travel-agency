<?php
// Start session to store booking data
session_start();

// Set up initial session variables if they don't exist
if (!isset($_SESSION['booking'])) {
    $_SESSION['booking'] = [
        'destination' => null,
        'activities' => [],
        'hosting' => null,
        'travel' => null,
        'total' => 0
    ];
}

// Fetch destinations, activities, hosting, and travel options
$destinations = ['Paris', 'London', 'New York'];  // Example destinations
$activities = ['Sightseeing', 'Museum Tour', 'City Bike Tour'];  // Example activities
$hostings = ['Hotel', 'Hostel', 'Airbnb'];  // Example hosting options
$travel_options = ['Flight', 'Train', 'Bus'];  // Example travel options
?>

<form id="bookingForm" method="POST" action="process_booking.php">
    <!-- Step 1: Select Destination -->
    <div id="step1">
        <h2>Select Destination</h2>
        <select name="destination" id="destination" onchange="updateTotal()">
            <?php foreach ($destinations as $destination): ?>
                <option value="<?= $destination ?>" <?= ($_SESSION['booking']['destination'] == $destination) ? 'selected' : '' ?>><?= $destination ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" onclick="nextStep(1)">Next</button>
    </div>

    <!-- Step 2: Select Activities -->
    <div id="step2" style="display:none;">
        <h2>Select Activities</h2>
        <?php foreach ($activities as $activity): ?>
            <label>
                <input type="checkbox" name="activities[]" value="<?= $activity ?>" class="activity" onchange="updateTotal()"> <?= $activity ?>
            </label><br>
        <?php endforeach; ?>
        <button type="button" onclick="prevStep(2)">Previous</button>
        <button type="button" onclick="nextStep(2)">Next</button>
    </div>

    <!-- Step 3: Select Hosting -->
    <div id="step3" style="display:none;">
        <h2>Select Hosting</h2>
        <select name="hosting" id="hosting" onchange="updateTotal()">
            <?php foreach ($hostings as $hosting): ?>
                <option value="<?= $hosting ?>" <?= ($_SESSION['booking']['hosting'] == $hosting) ? 'selected' : '' ?>><?= $hosting ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" onclick="prevStep(3)">Previous</button>
        <button type="button" onclick="nextStep(3)">Next</button>
    </div>

    <!-- Step 4: Select Travel -->
    <div id="step4" style="display:none;">
        <h2>Select Travel Option</h2>
        <select name="travel" id="travel" onchange="updateTotal()">
            <?php foreach ($travel_options as $travel): ?>
                <option value="<?= $travel ?>" <?= ($_SESSION['booking']['travel'] == $travel) ? 'selected' : '' ?>><?= $travel ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" onclick="prevStep(4)">Previous</button>
        <button type="button" onclick="nextStep(4)">Next</button>
    </div>

    <!-- Step 5: Review and Confirm -->
    <div id="step5" style="display:none;">
        <h2>Review Your Booking</h2>
        <p><strong>Destination:</strong> <?= $_SESSION['booking']['destination'] ?></p>
        <p><strong>Activities:</strong> <?= implode(", ", $_SESSION['booking']['activities']) ?></p>
        <p><strong>Hosting:</strong> <?= $_SESSION['booking']['hosting'] ?></p>
        <p><strong>Travel Option:</strong> <?= $_SESSION['booking']['travel'] ?></p>
        <p><strong>Total Amount:</strong> $<span id="totalAmount"><?= $_SESSION['booking']['total'] ?></span></p>
        <button type="button" onclick="prevStep(5)">Previous</button>
        <button type="submit">Confirm Booking</button>
    </div>
</form>
