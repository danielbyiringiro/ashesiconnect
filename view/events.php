<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/events.css">
    <title>Events Page</title>
</head>
<body>
    <header><h1>Upcoming Events</h1></header>
    <section id="event-calendar"></section>
    <section id="event-list">
        <h2>Event List</h2>
        <div class="event-list-container">
            <ul>
                <li>
                    <h3>Event 1: Workshop on Web Development</h3>
                    <p>Date: March 15, 2024</p>
                    <p>Time: 10:00 AM - 12:00 PM</p>
                    <p>Location: Room 101, Main Building</p>
                    <p>Description: Join us for an interactive workshop on the latest web development trends.</p>
                    <button class="rsvp-button" data-event-id="1">RSVP</button>
                </li>
                <li>
                    <h3>Event 2: Guest Lecture by Dr. Jane Smith</h3>
                    <p>Date: March 20, 2024</p>
                    <p>Time: 2:30 PM - 4:00 PM</p>
                    <p>Location: Auditorium, Science Center</p>
                    <p>Description: Dr. Jane Smith will discuss AI ethics and its impact on society.</p>
                    <button class="rsvp-button" data-event-id="2">RSVP</button>
                </li>
                <li>
                    <h3>Event 3: Campus Social Gathering</h3>
                    <p>Date: March 25, 2024</p>
                    <p>Time: 6:00 PM - 9:00 PM</p>
                    <p>Location: Courtyard</p>
                    <p>Description: Enjoy music, food, and games at our campus social event!</p>
                    <button class="rsvp-button" data-event-id="3">RSVP</button>
                </li>
            </ul>
        </div>
    </section>
    <div id="event-details-modal" class="modal"></div>
    <script src="../js/events.js"></script>
</body>
</html>
