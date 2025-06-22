<?php
    include 'base.php';
?>
<?php
//session_start();
include('User/config/connection.php');



// Fetch user info
$userid = $_SESSION['user_id'];
$userQuery = mysqli_query($mysqli, "SELECT * FROM users WHERE UserID = $userid");
$user = mysqli_fetch_assoc($userQuery);

// Fetch destination info (hardcoded here, should ideally come from selection)
$destinationID = 1; // Placeholder, ideally from GET or POST
$destinationQuery = mysqli_query($mysqli, "SELECT * FROM destinations WHERE DestinationID = $destinationID");
$destination = mysqli_fetch_assoc($destinationQuery);

// Fetch activities
$activitiesQuery = mysqli_query($mysqli, "SELECT * FROM activities WHERE DestinationID = $destinationID");
$activities = [];
while ($row = mysqli_fetch_assoc($activitiesQuery)) {
    $activities[] = $row;
}

// Fetch hostings
$hostingsQuery = mysqli_query($mysqli, "SELECT * FROM accomodation WHERE HostingID = $destinationID");
$hostings = [];
while ($row = mysqli_fetch_assoc($hostingsQuery)) {
    $hostings[] = $row;
}
?>

   

<div class="booking">
    <section class="booking-summary" id="invoice" >
        <h2>✅ Booking Confirmation</h2>
        <p><strong>Booking ID:</strong> #BKG-123456</p>
        <p><strong>Destination:</strong> Mt Kilimanjaro - Lemosho</p>
        <p><strong>Travel Option:</strong> Air Package</p>
        <p><strong>Hosting:</strong> Zulu House</p>
        <p><strong>Activities:</strong> Hiking, Safari, Night Walk</p>
        <p><strong>Type of Travel:</strong> Family</p>
        <p><strong>Number of People:</strong> 2</p>
        <p><strong>Start Date:</strong> 2025-07-01</p>
        <p><strong>End Date:</strong> 2025-07-10</p>
        <p><strong>Status:</strong> Confirmed</p>
        <p><strong>Booking Created:</strong> March 3, 2025, 4:53 PM</p>
        <hr>
        <h3>Total Price: <span style="color:green;">$1500.00</span></h3>

        <div class="qr-container">
            <p>Scan for Payment Order Request</p>
            <img src="https://api.qrserver.com/v1/create-qr-code/?data=BookingID123456&size=150x150" alt="QR Code">
        </div>

        <!--div class="actions">
            <button class="print-btn" onclick="window.print()">Print Invoice</button>
            <button class="download-btn" onclick="downloadInvoice()">Download Invoice</button>
            <button class="cancel-btn" onclick="cancelBooking()">Cancel Booking</button>
            <button class="rebook-btn" onclick="rebook()">Rebook</button>
        </div-->
        <h4>Choose Payment Method To Proceed</h4>
        <div class="actions">
            <div>
                <a href="visacheckout.php">
                    <img src="media/payments logos/Screenshot (2606).png" alt="visa logo">
                </a>
            </div>
            <div>
                <a href="stripecheckout.php">
                    <img src="media/payments logos/Stripe wordmark - blurple (small).png" alt="stripe logo">
                </a>
            </div>
            <div>
                <a href="mpesacheckout.php">
                    <img src="media/payments logos/mpesalogo.png" alt="mpesa logo">
                </a>
            </div>
            <div>
                <a href="paypalcheckout.php">
                    <img src="media/payments logos/Screenshot (2605).png" alt="paypal logo">
                </a>
            </div>
        </div>
    </section>

    <script>
        function downloadInvoice() {
            const invoice = document.getElementById("invoice").outerHTML;
            const blob = new Blob([invoice], { type: "text/html" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "invoice.html";
            a.click();
            URL.revokeObjectURL(url);
        }

        function cancelBooking() {
            if (confirm("Are you sure you want to cancel this booking?")) {
                alert("Your booking has been cancelled.");
                // Optionally: Make an AJAX call to backend to cancel it.
            }
        }

        function rebook() {
            alert("Redirecting to rebooking page...");
            window.location.href = "rebook.php?booking_id=123456"; // Replace with actual logic
        }
    </script>

    </div>
<?php
    include 'footer.php';
?>