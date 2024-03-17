// Define an array to store RSVP notifications
let rsvpNotifications = [];

// Function to handle RSVP button click
function handleRSVP(eventId) {
    // Find the event details based on eventId
    let eventDetails = findEventDetails(eventId);

    // Add the event details to RSVP notifications
    rsvpNotifications.push(eventDetails);

    // Notify the user about the RSVP
    notifyUser(eventDetails);

}

// Function to find event details based on eventId
function findEventDetails(eventId) {
    let events = [
        {
            id: 1,
            name: "Workshop on Web Development",
            date: "March 15, 2024",
            time: "10:00 AM - 12:00 PM",
            location: "Room 101, Main Building",
            description: "Join us for an interactive workshop on the latest web development trends."
        },
        {
            id: 2,
            name: "Guest Lecture by Dr. Jane Smith",
            date: "March 20, 2024",
            time: "2:30 PM - 4:00 PM",
            location: "Auditorium, Science Center",
            description: "Dr. Jane Smith will discuss AI ethics and its impact on society."
        },
        {
            id: 3,
            name: "Campus Social Gathering",
            date: "March 25, 2024",
            time: "6:00 PM - 9:00 PM",
            location: "Courtyard",
            description: "Enjoy music, food, and games at our campus social event!"
        }
    ];

    // Find the event with the matching eventId
    let event = events.find(event => event.id == eventId);

    return event;
}

// Function to notify the user about the RSVP
function notifyUser(eventDetails) {
    // Display a message when RSVP button is clicked
    let message = `You've successfully RSVP'd for "${eventDetails.name}". We look forward to seeing you there!`;
    alert(message); // Display message as an alert

    console.log(message);
}

// Add event listeners to RSVP buttons
document.querySelectorAll('.rsvp-button').forEach(button => {
    button.addEventListener('click', function() {
        // Extract the eventId from the data attribute
        let eventId = parseInt(button.getAttribute('data-event-id'));
        // Call the handleRSVP function with the eventId
        handleRSVP(eventId);
    });
});

