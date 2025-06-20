// Booking Form JavaScript Logic
let currentStep = 1;
let bookingData = {
    personal: {},
    activities: [],
    hosting: null,
    travel: null,
    basePrice: 900, // Mt Kilimanjaro base price
    totalAmount: 900
};

// Activity prices
const activityPrices = {
    'hiking_mountain': 250,
    'hiking_top': 150,
    'hiking_basic': 100
};

// Hosting prices per night
const hostingPrices = {
    'zulu_house': 120,
    'maskani_resort': 180,
    'top_villa': 200
};

// Travel prices
const travelPrices = {
    'economy_flight': 400,
    'business_flight': 800,
    'first_class': 1200,
    'road_transport': 150
};

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    updateProgressBar();
});

function setupEventListeners() {
    // Step 1 - Personal details form validation
    const personalInputs = document.querySelectorAll('#step1 input');
    personalInputs.forEach(input => {
        input.addEventListener('blur', validatePersonalDetails);
    });

    // Step 2 - Activity selection
    const activityButtons = document.querySelectorAll('.activity-card button');
    activityButtons.forEach(button => {
        button.addEventListener('click', handleActivitySelection);
    });

    // Step 3 - Hosting selection
    const hostingButtons = document.querySelectorAll('#step3 .activity-card button');
    hostingButtons.forEach(button => {
        button.addEventListener('click', handleHostingSelection);
    });

    // Step 3 - Date and people inputs
    const peopleInput = document.querySelector('input[placeholder="Number Of People"]');
    const checkInInput = document.querySelector('input[placeholder="Starting From"]');
    const checkOutInput = document.querySelector('input[placeholder="Check Out On"]');
    
    if (peopleInput) peopleInput.addEventListener('change', calculateHostingCost);
    if (checkInInput) checkInInput.addEventListener('change', calculateHostingCost);
    if (checkOutInput) checkOutInput.addEventListener('change', calculateHostingCost);

    // Step 4 - Travel selection
    const travelSelect = document.getElementById('travel');
    if (travelSelect) {
        travelSelect.addEventListener('change', handleTravelSelection);
        populateTravelOptions();
    }
}

function validatePersonalDetails() {
    const fullName = document.querySelector('input[placeholder="Full names"]').value;
    const email = document.querySelector('input[placeholder="Email"]').value;
    const phone = document.querySelector('input[placeholder="Country Code and Your Phone number"]').value;
    const travelType = document.querySelector('input[placeholder="Type of Travel : Friends, Family, Group, Couple"]').value;
    const country = document.querySelector('input[placeholder="Country"]').value;
    const location = document.querySelector('input[placeholder="Location"]').value;

    bookingData.personal = {
        fullName,
        email,
        phone,
        travelType,
        country,
        location
    };

    // Enable/disable proceed button based on validation
    const proceedBtn = document.querySelector('#step1 button');
    const isValid = fullName && email && phone && travelType && country && location;
    proceedBtn.disabled = !isValid;
    
    return isValid;
}

function handleActivitySelection(event) {
    const card = event.target.closest('.activity-card');
    const activityName = card.querySelector('h4').textContent;
    const button = event.target;
    
    // Toggle activity selection
    if (button.textContent.includes('Remove')) {
        // Remove activity
        button.textContent = '+ Add';
        button.classList.remove('selected');
        card.classList.remove('selected');
        
        // Remove from bookingData
        const index = bookingData.activities.findIndex(a => a.name === activityName);
        if (index > -1) {
            bookingData.activities.splice(index, 1);
        }
    } else {
        // Add activity
        button.textContent = '- Remove';
        button.classList.add('selected');
        card.classList.add('selected');
        
        // Add to bookingData
        const activityKey = getActivityKey(activityName);
        bookingData.activities.push({
            name: activityName,
            price: activityPrices[activityKey] || 150
        });
    }
    
    updateActivityTotal();
}

function getActivityKey(activityName) {
    if (activityName.includes('top of mountain')) return 'hiking_mountain';
    if (activityName.includes('top')) return 'hiking_top';
    return 'hiking_basic';
}

function updateActivityTotal() {
    const total = bookingData.activities.reduce((sum, activity) => sum + activity.price, 0);
    bookingData.totalAmount = bookingData.basePrice + total + 
        (bookingData.hosting ? bookingData.hosting.totalCost : 0) + 
        (bookingData.travel ? bookingData.travel.price : 0);
    
    updateTotalDisplay();
}

function handleHostingSelection(event) {
    const card = event.target.closest('.activity-card');
    const hostingName = card.querySelector('h4').textContent;
    const hostingType = card.querySelector('.type').textContent;
    
    // Clear previous selections
    document.querySelectorAll('#step3 .activity-card').forEach(c => {
        c.classList.remove('selected');
        c.querySelector('button').textContent = '+ Reserve';
    });
    
    // Select current hosting
    card.classList.add('selected');
    event.target.textContent = '- Selected';
    
    const hostingKey = getHostingKey(hostingName);
    bookingData.hosting = {
        name: hostingName,
        type: hostingType,
        pricePerNight: hostingPrices[hostingKey] || 150,
        totalCost: 0
    };
    
    calculateHostingCost();
}

function getHostingKey(hostingName) {
    if (hostingName.includes('Zulu')) return 'zulu_house';
    if (hostingName.includes('Maskani')) return 'maskani_resort';
    if (hostingName.includes('Top Villa')) return 'top_villa';
    return 'zulu_house';
}

function calculateHostingCost() {
    if (!bookingData.hosting) return;
    
    const peopleInput = document.querySelector('input[placeholder="Number Of People"]');
    const checkInInput = document.querySelector('input[placeholder="Starting From"]');
    const checkOutInput = document.querySelector('input[placeholder="Check Out On"]');
    
    const people = parseInt(peopleInput.value) || 1;
    const checkIn = new Date(checkInInput.value);
    const checkOut = new Date(checkOutInput.value);
    
    if (checkIn && checkOut && checkOut > checkIn) {
        const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        bookingData.hosting.nights = nights;
        bookingData.hosting.people = people;
        bookingData.hosting.totalCost = bookingData.hosting.pricePerNight * nights * people;
        
        // Update total
        const activitiesTotal = bookingData.activities.reduce((sum, activity) => sum + activity.price, 0);
        bookingData.totalAmount = bookingData.basePrice + activitiesTotal + 
            bookingData.hosting.totalCost + 
            (bookingData.travel ? bookingData.travel.price : 0);
        
        updateTotalDisplay();
    }
}

function populateTravelOptions() {
    const travelSelect = document.getElementById('travel');
    if (!travelSelect) return;
    
    travelSelect.innerHTML = `
        <option value="">Select Travel Option</option>
        <option value="economy_flight">Economy Flight - $400</option>
        <option value="business_flight">Business Flight - $800</option>
        <option value="first_class">First Class Flight - $1200</option>
        <option value="road_transport">Road Transport - $150</option>
    `;
}

function handleTravelSelection(event) {
    const selectedValue = event.target.value;
    const selectedText = event.target.options[event.target.selectedIndex].text;
    
    if (selectedValue) {
        bookingData.travel = {
            option: selectedValue,
            name: selectedText,
            price: travelPrices[selectedValue] || 0
        };
    } else {
        bookingData.travel = null;
    }
    
    updateTotal();
}

function updateTotal() {
    const activitiesTotal = bookingData.activities.reduce((sum, activity) => sum + activity.price, 0);
    const hostingTotal = bookingData.hosting ? bookingData.hosting.totalCost : 0;
    const travelTotal = bookingData.travel ? bookingData.travel.price : 0;
    
    bookingData.totalAmount = bookingData.basePrice + activitiesTotal + hostingTotal + travelTotal;
    updateTotalDisplay();
}

function updateTotalDisplay() {
    const totalElement = document.getElementById('totalAmount');
    if (totalElement) {
        totalElement.textContent = bookingData.totalAmount;
    }
}

function nextStep(step) {
    // Validate current step
    if (!validateCurrentStep(step)) {
        return;
    }
    
    // Hide current step
    document.getElementById(`step${step}`).style.display = 'none';
    
    // Show next step
    const nextStepNum = step + 1;
    document.getElementById(`step${nextStepNum}`).style.display = 'block';
    
    currentStep = nextStepNum;
    
    // Update review section if we're on step 5
    if (nextStepNum === 5) {
        updateReviewSection();
    }
    
    updateProgressBar();
}

function prevStep(step) {
    // Hide current step
    document.getElementById(`step${step}`).style.display = 'none';
    
    // Show previous step
    const prevStepNum = step - 1;
    document.getElementById(`step${prevStepNum}`).style.display = 'block';
    
    currentStep = prevStepNum;
    updateProgressBar();
}

function validateCurrentStep(step) {
    switch(step) {
        case 1:
            return validatePersonalDetails();
        case 2:
            if (bookingData.activities.length === 0) {
                alert('Please select at least one activity.');
                return false;
            }
            return true;
        case 3:
            if (!bookingData.hosting) {
                alert('Please select a hosting option.');
                return false;
            }
            const peopleInput = document.querySelector('input[placeholder="Number Of People"]');
            const checkInInput = document.querySelector('input[placeholder="Starting From"]');
            const checkOutInput = document.querySelector('input[placeholder="Check Out On"]');
            
            if (!peopleInput.value || !checkInInput.value || !checkOutInput.value) {
                alert('Please fill in all hosting details.');
                return false;
            }
            return true;
        case 4:
            if (!bookingData.travel) {
                alert('Please select a travel option.');
                return false;
            }
            return true;
        default:
            return true;
    }
}

function updateReviewSection() {
    const step5 = document.getElementById('step5');
    
    // Update review content
    const reviewHTML = `
        <h3>Review Your Booking: Payment Summary</h3>
        <div class="booking-summary">
            <div class="summary-section">
                <h4>Personal Details</h4>
                <p><strong>Name:</strong> ${bookingData.personal.fullName}</p>
                <p><strong>Email:</strong> ${bookingData.personal.email}</p>
                <p><strong>Phone:</strong> ${bookingData.personal.phone}</p>
                <p><strong>Travel Type:</strong> ${bookingData.personal.travelType}</p>
                <p><strong>Location:</strong> ${bookingData.personal.location}, ${bookingData.personal.country}</p>
            </div>
            
            <div class="summary-section">
                <h4>Destination</h4>
                <p><strong>Mt Kilimanjaro, Lemosho, Tanzania</strong> - $${bookingData.basePrice}</p>
            </div>
            
            <div class="summary-section">
                <h4>Selected Activities</h4>
                ${bookingData.activities.map(activity => 
                    `<p>• ${activity.name} - $${activity.price}</p>`
                ).join('')}
                <p><strong>Activities Total: $${bookingData.activities.reduce((sum, activity) => sum + activity.price, 0)}</strong></p>
            </div>
            
            <div class="summary-section">
                <h4>Hosting</h4>
                ${bookingData.hosting ? `
                    <p><strong>${bookingData.hosting.name}</strong> (${bookingData.hosting.type})</p>
                    <p>• ${bookingData.hosting.nights} nights for ${bookingData.hosting.people} people</p>
                    <p>• $${bookingData.hosting.pricePerNight} per night per person</p>
                    <p><strong>Hosting Total: $${bookingData.hosting.totalCost}</strong></p>
                ` : '<p>No hosting selected</p>'}
            </div>
            
            <div class="summary-section">
                <h4>Travel</h4>
                ${bookingData.travel ? `
                    <p><strong>${bookingData.travel.name}</strong> - $${bookingData.travel.price}</p>
                ` : '<p>No travel option selected</p>'}
            </div>
            
            <hr>
            <div class="total-section">
                <h3><strong>Total Amount: $<span id="totalAmount">${bookingData.totalAmount}</span></strong></h3>
            </div>
        </div>
        
        <p>Remember to read this guide on recommended documents:</p>
        <div class="links-container">
            <span class="advice-link" onclick="openPopup('international')">🌍 For International Travelers</span>
        </div>
        
        <div class="checkout-btn">
            <button type="button" onclick="prevStep(5)">
                <i class="fa fa-arrow-left"></i>
                Previous
            </button>
            <button type="button" onclick="proceedToCheckout()">
                Proceed to checkout
                <i class="fa fa-arrow-right"></i>
            </button>
        </div>
    `;
    
    step5.innerHTML = reviewHTML;
}

function updateProgressBar() {
    // Add progress bar if it doesn't exist
    if (!document.querySelector('.progress-bar')) {
        const progressBar = document.createElement('div');
        progressBar.className = 'progress-bar';
        progressBar.innerHTML = `
            <div class="progress-steps">
                <div class="step ${currentStep >= 1 ? 'active' : ''}">1</div>
                <div class="step ${currentStep >= 2 ? 'active' : ''}">2</div>
                <div class="step ${currentStep >= 3 ? 'active' : ''}">3</div>
                <div class="step ${currentStep >= 4 ? 'active' : ''}">4</div>
                <div class="step ${currentStep >= 5 ? 'active' : ''}">5</div>
            </div>
        `;
        
        const form = document.getElementById('bookingForm');
        form.insertBefore(progressBar, form.firstChild);
    } else {
        // Update existing progress bar
        const steps = document.querySelectorAll('.progress-bar .step');
        steps.forEach((step, index) => {
            if (index + 1 <= currentStep) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
    }
}

function openPopup(type) {
    const popup = document.getElementById('popupOverlay');
    const content = document.getElementById('popupContent');
    
    if (type === 'international') {
        content.innerHTML = `
            <div class="popup-header">
                <h3>International Travel Documents</h3>
                <button onclick="closePopup()" class="close-btn">&times;</button>
            </div>
            <div class="popup-body">
                <h4>Required Documents:</h4>
                <ul>
                    <li>Valid passport (minimum 6 months validity)</li>
                    <li>Visa (if required for your country)</li>
                    <li>Yellow fever vaccination certificate</li>
                    <li>Travel insurance documents</li>
                    <li>Flight tickets and hotel reservations</li>
                </ul>
                <h4>Recommended Items:</h4>
                <ul>
                    <li>Travel health insurance</li>
                    <li>Emergency contact information</li>
                    <li>Copies of important documents</li>
                    <li>Local currency and credit cards</li>
                </ul>
            </div>
        `;
    }
    
    popup.style.display = 'flex';
}

function closePopup() {
    document.getElementById('popupOverlay').style.display = 'none';
}

function proceedToCheckout() {
    // Prepare data for submission
    const formData = new FormData();
    
    // Add all booking data to form
    Object.keys(bookingData.personal).forEach(key => {
        formData.append(`personal_${key}`, bookingData.personal[key]);
    });
    
    formData.append('destination', 'Mt Kilimanjaro');
    formData.append('base_price', bookingData.basePrice);
    formData.append('activities', JSON.stringify(bookingData.activities));
    formData.append('hosting', JSON.stringify(bookingData.hosting));
    formData.append('travel', JSON.stringify(bookingData.travel));
    formData.append('total_amount', bookingData.totalAmount);
    
    // Submit to PHP
    fetch('process_booking.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Booking submitted successfully! You will receive a confirmation email shortly.');
            // Redirect to payment or confirmation page
            window.location.href = 'payment.php?booking_id=' + data.booking_id;
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while processing your booking.');
    });
}

















///Next JS
// Global variables to store selected items and cache
let selectedActivities = [];
let selectedHostings = [];
let selectedTravel = null;
let currentStep = 1;
let totalAmount = 0;

// Cache object to store all booking data
let bookingCache = {
    userDetails: {},
    activities: [],
    hostings: [],
    travel: null,
    totalAmount: 0
};

// Initialize the booking form
document.addEventListener('DOMContentLoaded', function() {
    showStep(1);
    updateProgressBar();
    
    // Add click listeners to all add buttons
    attachEventListeners();
});

// Attach event listeners to buttons
function attachEventListeners() {
    // Activities add buttons
    document.querySelectorAll('#step2 .button').forEach(span => {
        span.addEventListener('click', function(e) {
            e.preventDefault();
            addActivity(this);
        });
    });

    // Hosting add buttons  
    document.querySelectorAll('#step3 .button').forEach(span => {
        span.addEventListener('click', function(e) {
            e.preventDefault();
            addHosting(this);
        });
    });

    // Travel option cards
    document.querySelectorAll('#step4 .travel-option').forEach(card => {
        card.addEventListener('click', function() {
            selectTravel(this);
        });
    });
}

// Add activity functionality
function addActivity(span) {
    const card = span.closest('.activity-card');
    const activityName = card.querySelector('h4').textContent;
    const priceText = card.querySelector('p').textContent;
    const price = extractPrice(priceText);
    const rating = card.querySelector('.plus p').textContent;
    
    // Check if already added
    const existingIndex = selectedActivities.findIndex(item => item.name === activityName);
    
    if (existingIndex === -1) {
        // Add new activity
        const activity = {
            name: activityName,
            price: price,
            rating: rating,
            type: 'activity'
        };
        
        selectedActivities.push(activity);
        span.innerHTML = '✓ Added';
        span.style.backgroundColor = '#27ae60';
        
        // Add to right sidebar
        addToSummary(activity, 'activities-list');
        
    } else {
        // Remove activity
        selectedActivities.splice(existingIndex, 1);
        span.innerHTML = '+ Add';
        span.style.backgroundColor = '#f39c12';
        
        // Remove from sidebar
        removeFromSummary(activityName, 'activities-list');
    }
    
    updateCache();
    updateTotal();
}

// Add hosting functionality
function addHosting(button) {
    const card = button.closest('.activity-card');
    const hostingName = card.querySelector('h4').textContent;
    const priceText = card.querySelector('p').textContent;
    const price = extractPrice(priceText);
    const type = card.querySelector('.type') ? card.querySelector('.type').textContent : 'Hotel';
    const rating = card.querySelector('.plus p') ? card.querySelector('.plus p').textContent : '4.0';
    
    // Check if already added
    const existingIndex = selectedHostings.findIndex(item => item.name === hostingName);
    
    if (existingIndex === -1) {
        // Add new hosting
        const hosting = {
            name: hostingName,
            price: price,
            type: type,
            rating: rating,
            type: 'hosting'
        };
        
        selectedHostings.push(hosting);
        button.innerHTML = '✓ Reserved';
        button.style.backgroundColor = '#27ae60';
        
        // Add to right sidebar
        addToSummary(hosting, 'hostings-list');
        
    } else {
        // Remove hosting
        selectedHostings.splice(existingIndex, 1);
        button.innerHTML = '+ Reserve';
        button.style.backgroundColor = '#f39c12';
        
        // Remove from sidebar
        removeFromSummary(hostingName, 'hostings-list');
    }
    
    updateCache();
    updateTotal();
}

// Select travel option
function selectTravel(card) {
    // Remove previous selection
    document.querySelectorAll('#step4 .travel-option').forEach(c => {
        c.classList.remove('selected');
        c.style.border = '1px solid #ddd';
    });
    
    // Select new option
    card.classList.add('selected');
    card.style.border = '3px solid #3498db';
    
    const travelName = card.querySelector('h4').textContent;
    const priceText = card.querySelector('.price').textContent;
    const price = extractPrice(priceText);
    
    selectedTravel = {
        name: travelName,
        price: price,
        type: 'travel'
    };
    
    // Update travel summary
    updateTravelSummary();
    updateCache();
    updateTotal();
}

// Add item to summary sidebar
function addToSummary(item, listId) {
    let summaryList = document.getElementById(listId);
    
    // Create summary list if it doesn't exist
    if (!summaryList) {
        createSummarySection();
        summaryList = document.getElementById(listId);
    }
    
    const listItem = document.createElement('div');
    listItem.className = 'summary-item';
    listItem.setAttribute('data-name', item.name);
    
    listItem.innerHTML = `
        <div class="item-info">
            <div class="item-name">${item.name}</div>
            <div class="item-details">${item.type === 'hosting' ? item.type : ''}</div>
        </div>
        <div class="item-actions">
            <span class="item-price">$${item.price}</span>
            <button class="remove-btn" onclick="removeItem('${item.name}', '${item.type}')">×</button>
        </div>
    `;
    
    summaryList.appendChild(listItem);
}

// Remove item from summary sidebar
function removeFromSummary(itemName, listId) {
    const summaryList = document.getElementById(listId);
    if (summaryList) {
        const itemElement = summaryList.querySelector(`[data-name="${itemName}"]`);
        if (itemElement) {
            itemElement.remove();
        }
    }
}

// Update travel summary
function updateTravelSummary() {
    let travelSummary = document.getElementById('travel-summary');
    
    if (!travelSummary) {
        createSummarySection();
        travelSummary = document.getElementById('travel-summary');
    }
    
    if (selectedTravel) {
        travelSummary.innerHTML = `
            <div class="summary-item">
                <div class="item-info">
                    <div class="item-name">${selectedTravel.name}</div>
                </div>
                <div class="item-actions">
                    <span class="item-price">$${selectedTravel.price}</span>
                </div>
            </div>
        `;
    } else {
        travelSummary.innerHTML = '<p>No travel option selected</p>';
    }
}

// Create summary section in the right sidebar
function createSummarySection() {
    const summaryContainer = document.querySelector('.dest-info-form');
    
    let summarySection = document.querySelector('.booking-summary');
    
    if (!summarySection) {
        summarySection = document.createElement('div');
        summarySection.className = 'booking-summary';
        summarySection.style.cssText = `
            position: fixed;
            right: 20px;
            top: 100px;
            width: 350px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 20px;
            max-height: 70vh;
            overflow-y: auto;
            z-index: 1000;
        `;
        
        summarySection.innerHTML = `
            <h3 style="margin-bottom: 20px; color: #2c3e50;">Booking Summary</h3>
            
            <div class="summary-section">
                <h4 style="color: #3498db; margin-bottom: 10px;">Activities</h4>
                <div id="activities-list" class="summary-list"></div>
            </div>
            
            <div class="summary-section" style="margin-top: 20px;">
                <h4 style="color: #3498db; margin-bottom: 10px;">Hostings</h4>
                <div id="hostings-list" class="summary-list"></div>
            </div>
            
            <div class="summary-section" style="margin-top: 20px;">
                <h4 style="color: #3498db; margin-bottom: 10px;">Travel</h4>
                <div id="travel-summary" class="summary-list"></div>
            </div>
            
            <div class="total-section" style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                <h4 style="color: #2c3e50;">Total Amount</h4>
                <div id="total-display" style="font-size: 24px; font-weight: bold; color: #27ae60;">$0</div>
            </div>
        `;
        
        document.body.appendChild(summarySection);
    }
}

// Remove item function (called from remove button)
function removeItem(itemName, itemType) {
    if (itemType === 'activity') {
        const index = selectedActivities.findIndex(item => item.name === itemName);
        if (index !== -1) {
            selectedActivities.splice(index, 1);
            // Reset button
            const button = Array.from(document.querySelectorAll('#step2 .button')).find(btn => {
                return btn.closest('.activity-card').querySelector('h4').textContent === itemName;
            });
            if (button) {
                button.innerHTML = '+ Add';
                button.style.backgroundColor = '#f39c12';
            }
        }
        removeFromSummary(itemName, 'activities-list');
    } else if (itemType === 'hosting') {
        const index = selectedHostings.findIndex(item => item.name === itemName);
        if (index !== -1) {
            selectedHostings.splice(index, 1);
            // Reset button
            const button = Array.from(document.querySelectorAll('#step3 .button')).find(btn => {
                return btn.closest('.activity-card').querySelector('h4').textContent === itemName;
            });
            if (button) {
                button.innerHTML = '+ Reserve';
                button.style.backgroundColor = '#f39c12';
            }
        }
        removeFromSummary(itemName, 'hostings-list');
    }
    
    updateCache();
    updateTotal();
}

// Extract price from text
function extractPrice(priceText) {
    const match = priceText.match(/(\d+)/);
    return match ? parseInt(match[1]) : 0;
}

// Update total amount
function updateTotal() {
    let total = 0;
    
    // Add activities total
    selectedActivities.forEach(activity => {
        total += activity.price;
    });
    
    // Add hostings total
    selectedHostings.forEach(hosting => {
        total += hosting.price;
    });
    
    // Add travel total
    if (selectedTravel) {
        total += selectedTravel.price;
    }
    
    totalAmount = total;
    
    // Update display
    const totalDisplay = document.getElementById('total-display');
    if (totalDisplay) {
        totalDisplay.textContent = `$${total}`;
    }
    
    // Update step 5 total if visible
    const step5Total = document.getElementById('totalAmount');
    if (step5Total) {
        step5Total.textContent = total;
    }
}

// Update cache with current selections
function updateCache() {
    bookingCache.activities = [...selectedActivities];
    bookingCache.hostings = [...selectedHostings];
    bookingCache.travel = selectedTravel;
    bookingCache.totalAmount = totalAmount;
    
    // Store in localStorage for persistence
    localStorage.setItem('bookingCache', JSON.stringify(bookingCache));
}

// Load cache from localStorage
function loadCache() {
    const cached = localStorage.getItem('bookingCache');
    if (cached) {
        bookingCache = JSON.parse(cached);
        selectedActivities = bookingCache.activities || [];
        selectedHostings = bookingCache.hostings || [];
        selectedTravel = bookingCache.travel;
        totalAmount = bookingCache.totalAmount || 0;
        
        // Restore UI state
        restoreUIState();
    }
}

// Restore UI state from cache
function restoreUIState() {
    // Restore activities
    selectedActivities.forEach(activity => {
        const button = Array.from(document.querySelectorAll('#step2 .button')).find(btn => {
            return btn.closest('.activity-card').querySelector('h4').textContent === activity.name;
        });
        if (button) {
            button.innerHTML = '✓ Added';
            button.style.backgroundColor = '#27ae60';
        }
        addToSummary(activity, 'activities-list');
    });
    
    // Restore hostings
    selectedHostings.forEach(hosting => {
        const button = Array.from(document.querySelectorAll('#step3 .button')).find(btn => {
            return btn.closest('.activity-card').querySelector('h4').textContent === hosting.name;
        });
        if (button) {
            button.innerHTML = '✓ Reserved';
            button.style.backgroundColor = '#27ae60';
        }
        addToSummary(hosting, 'hostings-list');
    });
    
    // Restore travel selection
    if (selectedTravel) {
        const card = Array.from(document.querySelectorAll('#step4 .travel-option')).find(c => {
            return c.querySelector('h4').textContent === selectedTravel.name;
        });
        if (card) {
            card.classList.add('selected');
            card.style.border = '3px solid #3498db';
        }
        updateTravelSummary();
    }
    
    updateTotal();
}

// Step navigation functions
function nextStep(step) {
    if (step < 5) {
        // Collect user details from step 1
        if (step === 1) {
            collectUserDetails();
        }
        
        currentStep = step + 1;
        showStep(currentStep);
        updateProgressBar();
    }
}

function prevStep(step) {
    if (step > 1) {
        currentStep = step - 1;
        showStep(currentStep);
        updateProgressBar();
    }
}

function showStep(stepNumber) {
    // Hide all steps
    for (let i = 1; i <= 5; i++) {
        const stepElement = document.getElementById(`step${i}`);
        if (stepElement) {
            stepElement.style.display = 'none';
        }
    }
    
    // Show current step
    const currentStepElement = document.getElementById(`step${stepNumber}`);
    if (currentStepElement) {
        currentStepElement.style.display = 'block';
    }
    
    // Create summary section when needed
    if (stepNumber >= 2) {
        createSummarySection();
    }
}

function updateProgressBar() {
    // Update progress indicators if they exist
    for (let i = 1; i <= 5; i++) {
        const progressStep = document.querySelector(`.progress-step-${i}`);
        if (progressStep) {
            if (i < currentStep) {
                progressStep.classList.add('completed');
                progressStep.classList.remove('active');
            } else if (i === currentStep) {
                progressStep.classList.add('active');
                progressStep.classList.remove('completed');
            } else {
                progressStep.classList.remove('active', 'completed');
            }
        }
    }
}

// Collect user details from step 1
function collectUserDetails() {
    const inputs = document.querySelectorAll('#step1 input, #step1 select');
    inputs.forEach(input => {
        if (input.value) {
            bookingCache.userDetails[input.placeholder || input.name] = input.value;
        }
    });
    updateCache();
}

// Final booking submission
function submitBooking() {
    // Prepare final booking data
    const finalBookingData = {
        userDetails: bookingCache.userDetails,
        destination: "Mt Kilimanjaro", // From your HTML
        activities: selectedActivities,
        hostings: selectedHostings,
        travel: selectedTravel,
        totalAmount: totalAmount,
        bookingDate: new Date().toISOString()
    };
    
    console.log('Final Booking Data:', finalBookingData);
    
    // Here you would typically send this data to your PHP backend
    // Example AJAX call:
    /*
    fetch('process_booking.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(finalBookingData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Booking submitted successfully:', data);
        // Clear cache after successful submission
        localStorage.removeItem('bookingCache');
        // Redirect to confirmation page
        window.location.href = 'booking_confirmation.php';
    })
    .catch(error => {
        console.error('Error submitting booking:', error);
    });
    */
    
    alert('Booking data prepared! Check console for details.');
}

// Popup functionality for travel advice
function openPopup(type) {
    const popup = document.getElementById('popupOverlay');
    const content = document.getElementById('popupContent');
    
    let popupContent = '';
    
    if (type === 'international') {
        popupContent = `
            <div style="padding: 20px;">
                <h3>International Travel Requirements</h3>
                <button onclick="closePopup()" style="float: right; background: #e74c3c; color: white; border: none; padding: 5px 10px; border-radius: 5px;">×</button>
                <ul style="margin-top: 20px;">
                    <li>Valid passport (6+ months validity)</li>
                    <li>Visa requirements (check destination)</li>
                    <li>Travel insurance</li>
                    <li>Vaccination certificates</li>
                    <li>Flight tickets and accommodation bookings</li>
                </ul>
            </div>
        `;
    }
    
    content.innerHTML = popupContent;
    popup.style.display = 'flex';
}

function closePopup() {
    document.getElementById('popupOverlay').style.display = 'none';
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    loadCache(); // Load any existing cache
    attachEventListeners();
    showStep(1);
    
    // Add CSS for popup
    if (!document.getElementById('popup-styles')) {
        const style = document.createElement('style');
        style.id = 'popup-styles';
        style.textContent = `
            .popup-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 2000;
            }
            .popup-content {
                background: white;
                border-radius: 10px;
                max-width: 500px;
                max-height: 80vh;
                overflow-y: auto;
            }
            .summary-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0;
                border-bottom: 1px solid #eee;
            }
            .item-actions {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .remove-btn {
                background: #e74c3c;
                color: white;
                border: none;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                cursor: pointer;
                font-size: 12px;
            }
            .item-price {
                font-weight: bold;
                color: #27ae60;
            }
        `;
        document.head.appendChild(style);
    }
});














let selectedItems = [];

// Add event listeners after DOM loads
window.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".add-button").forEach(button => {
    button.addEventListener("click", () => {
      const title = button.dataset.title;
      const price = parseFloat(button.dataset.price);

      const alreadyExists = selectedItems.find(item => item.title === title);
      if (!alreadyExists) {
        selectedItems.push({ title, price });
        renderSelectedItems();
      }
    });
  });
});

function renderSelectedItems() {
  const container = document.getElementById("selectedItems");
  const totalElement = document.getElementById("totalAmount");
  const inputHidden = document.getElementById("selectedActivitiesInput");

  container.innerHTML = "";
  let total = 0;

  selectedItems.forEach((item, index) => {
    total += item.price;
    const itemEl = document.createElement("div");
    itemEl.classList.add("selected-item");
    itemEl.innerHTML = `
      <span>${item.title} - $${item.price}</span>
      <button type="button" onclick="removeItem(${index})">Remove</button>
    `;
    container.appendChild(itemEl);
  });

  if (totalElement) {
    totalElement.textContent = total;
  }
  if (inputHidden) {
    inputHidden.value = JSON.stringify(selectedItems);
  }
}

function removeItem(index) {
  selectedItems.splice(index, 1);
  renderSelectedItems();
}

function nextStep(step) {
  document.getElementById(`step${step}`).style.display = "none";
  document.getElementById(`step${step + 1}`).style.display = "block";
}

function prevStep(step) {
  document.getElementById(`step${step}`).style.display = "none";
  document.getElementById(`step${step - 1}`).style.display = "block";
}

function openPopup(type) {
  const popup = document.getElementById("popupOverlay");
  const content = document.getElementById("popupContent");
  popup.style.display = "block";

  if (type === 'international') {
    content.innerHTML = `<h3>International Travel Documents</h3><p>Make sure you have a valid passport, visa (if needed), and your travel insurance.</p>`;
  }
}


<style>
.selected-item {
  background: #f4f4f4;
  margin-bottom: 5px;
  padding: 8px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 5px;
}
.selected-item button {
  background-color: red;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}
</style>
/*
    let selectedItems = [];
    let totalPrice = 0;

    // Utility to update the selected items UI and total
    function updateSelectedItemsDisplay() {
        const container = document.getElementById('selectedItems');
        container.innerHTML = ''; // Clear previous

        if (selectedItems.length === 0) {
            container.innerHTML = '<p>No items selected yet.</p>';
        } else {
            const list = document.createElement('ul');
            selectedItems.forEach((item, index) => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <strong>${item.title}</strong> - ${item.type} - $${item.price} 
                    <button onclick="removeItem(${index})" style="margin-left:10px;color:red;">❌</button>
                `;
                list.appendChild(li);
            });
            container.appendChild(list);
        }

        document.getElementById('totalAmount').innerText = totalPrice.toFixed(2);
        document.getElementById('selectedActivitiesInput').value = JSON.stringify(selectedItems);
    }

    // Remove an item
    function removeItem(index) {
        if (index >= 0 && index < selectedItems.length) {
            totalPrice -= selectedItems[index].price;
            selectedItems.splice(index, 1);
            updateSelectedItemsDisplay();
        }
    }

    // Add Item button listener
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.add-button');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const type = button.getAttribute('data-type');
                const title = button.getAttribute('data-title');
                const price = parseFloat(button.getAttribute('data-price'));

                // Prevent duplicates
                if (selectedItems.some(item => item.title === title && item.type === type)) {
                    alert(`${title} already added.`);
                    return;
                }

                selectedItems.push({ type, title, price });
                totalPrice += price;
                updateSelectedItemsDisplay();
            });
        });

        // Set initial total and list
        updateSelectedItemsDisplay();
    });

    // Navigation functions
    function nextStep(step) {
        document.getElementById(`step${step}`).style.display = 'none';
        document.getElementById(`step${step + 1}`).style.display = 'block';

        // Optional: update summary on step 5
        if (step + 1 === 5) {
            document.getElementById('totalAmount').innerText = totalPrice.toFixed(2);
        }
    }

    function prevStep(step) {
        document.getElementById(`step${step}`).style.display = 'none';
        document.getElementById(`step${step - 1}`).style.display = 'block';
    };

    */

    /* Master JS for Activities + Hosting + Total Price
let selectedActivities = [];
let selectedHosting = [];
let total = 0;


function updateSelectedItemsDisplay() {
    const containers = document.querySelectorAll('#selectedItems');
    containers.forEach(container => {
        container.innerHTML = '';
        if (selectedItems.length === 0) {
            container.innerHTML = '<p>No items selected yet.</p>';
        } else {
            const list = document.createElement('ul');
            selectedItems.forEach((item, index) => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <strong>${item.title}</strong> - ${item.type} - $${item.price}
                    <button onclick="removeItem(${index})" style="margin-left:10px;color:red;">❌</button>
                `;
                list.appendChild(li);
            });
            container.appendChild(list);
        }
    });

    document.getElementById('totalAmount').innerText = totalPrice.toFixed(2);
    document.getElementById('selectedActivitiesInput').value = JSON.stringify(selectedItems.filter(item => item.type === 'activity'));
    document.getElementById('selectedHostingInput').value = JSON.stringify(selectedItems.filter(item => item.type === 'hosting'));
}

function removeItem(index) {
    if (index >= 0 && index < selectedItems.length) {
        totalPrice -= selectedItems[index].price;
        selectedItems.splice(index, 1);
        updateSelectedItemsDisplay();
    }
}
/*
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.add-button');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const type = button.getAttribute('data-type');
            const title = button.getAttribute('data-title');
            const price = parseFloat(button.getAttribute('data-price'));

            if (selectedItems.some(item => item.title === title && item.type === type)) {
                alert(`${title} already added.`);
                return;
            }

            selectedItems.push({ type, title, price });
            totalPrice += price;
            updateSelectedItemsDisplay();
        });
    });

    updateSelectedItemsDisplay();
});
*
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('add-button')) {
        const title = e.target.getAttribute('data-title');
        const price = parseFloat(e.target.getAttribute('data-price'));
        const type = e.target.getAttribute('data-type');

        if (type === 'activity') {
            if (!selectedActivities.some(item => item.title === title)) {
                selectedActivities.push({ title, price });
                total += price;
                updateSelectedDisplay('activity');
            }
        }

        if (type === 'hosting') {
            if (!selectedHosting.some(item => item.title === title)) {
                selectedHosting.push({ title, price });
                total += price;
                updateSelectedDisplay('hosting');
            }
        }

        updateTotal();
    }
});


function updateSelectedDisplay(type) {
    let container, data;

    if (type === 'activity') {
        container = document.getElementById('selectedActivitiesDisplay');
        data = selectedActivities;
    } else if (type === 'hosting') {
        container = document.getElementById('selectedHostingDisplay');
        data = selectedHosting;
    }

    container.innerHTML = '';
    data.forEach((item, index) => {
        const div = document.createElement('div');
        div.innerHTML = `
            <span>${item.title} - $${item.price}</span>
            <button type="button" onclick="removeItem('${type}', ${index})">Remove</button>
        `;
        container.appendChild(div);
    });

    // Also update hidden inputs
    if (type === 'activity') {
        document.getElementById('selectedActivitiesInput').value = JSON.stringify(selectedActivities);
    } else if (type === 'hosting') {
        document.getElementById('selectedHostingInput').value = JSON.stringify(selectedHosting);
    }
}
function removeItem(type, index) {
    if (type === 'activity') {
        total -= selectedActivities[index].price;
        selectedActivities.splice(index, 1);
        updateSelectedDisplay('activity');
    } else if (type === 'hosting') {
        total -= selectedHosting[index].price;
        selectedHosting.splice(index, 1);
        updateSelectedDisplay('hosting');
    }

    updateTotal();
}
function updateTotal() {
    document.querySelectorAll('#totalAmount').forEach(span => {
        span.innerText = total.toFixed(2);
    });
}

function nextStep(step) {
    document.getElementById(`step${step}`).style.display = 'none';
    document.getElementById(`step${step + 1}`).style.display = 'block';

    if (step + 1 === 5) {
        document.getElementById('totalAmount').innerText = totalPrice.toFixed(2);
    }
}

function prevStep(step) {
    document.getElementById(`step${step}`).style.display = 'none';
    document.getElementById(`step${step - 1}`).style.display = 'block';
}
*/