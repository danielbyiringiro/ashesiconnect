<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messaging Page</title>
    <link rel="stylesheet" href="../css/message_style.css">
</head>
<body>
    <header>
        <h1>Messaging</h1>
    </header>
    <main>
        <aside id="inbox">
            <h2>Inbox</h2>
            <ul id="inbox-list">
                </ul>
        </aside>
        <section id="conversation-view">
            </section>
        <section id="message-compose">
            <h2>Compose Message</h2>
            <form id="message-form">
                <label for="recipient">To:</label>
                <input type="text" id="recipient" name="recipient" placeholder="Enter recipient(s)">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" placeholder="Type your message..."></textarea>
                <label for="file-upload">Attach File:</label>
                <input type="file" id="file-upload" name="file-upload">
                <button type="submit">Send</button>
            </form>
        </section>
        <aside id="contact-list">
            <h2>Contacts</h2>
            <ul id="contact-list">
                </ul>
        </aside>
    </main>
    <footer>
        &copy; 2024 AshesiConnect
    </footer>
    <script src="../js/message_script.js"></script>
</body>
</html>
