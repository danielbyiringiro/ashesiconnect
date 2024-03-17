<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/events.css">
    <title>Events Page</title>
</head>
<body>


    <header><h1>Events</h1></header>
    
    
                </li>
    <section id="event-calendar"></section>
    <section id="event-list">

    
        <h2>Event List</h2>
        
        <div class="event-list-container">
            <ul>
                

            <li>
            <div id="new-event-form-container">
                        <h3>Add New Event</h3>
                        <div id="new-event-container">
    <form id="new-event-form" action="../actions/submit_event.php" method="post">
        <label for="event-name">Event Name:</label><br>
        <input type="text" id="event-name" name="event-name" required><br>
    
        <label for="event-date">Event Date (YYYY-MM-DD):</label><br>
<input type="text" id="event-date" name="event-date" required pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD"><br>

        <label for="event-location">Event Location:</label><br>
        <input type="text" id="event-location" name="event-location" required><br>
        <label for="event-description">Event Description:</label><br>
        <textarea id="event-description" name="event-description" required></textarea><br>
        <input type="submit" id="submit-event-btn" value="Submit">
    </form>
</div>

     
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
