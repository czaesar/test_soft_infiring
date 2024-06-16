<!-- resources/views/emails/admin_notification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>New Note Created</title>
</head>
<body>
<h1>New Note Created</h1>
<p>A new note has been created by a user.</p>
<p><strong>Title:</strong> {{ $noteTitle }}</p>
<p><strong>Content:</strong> {{ $noteContent }}</p>
</body>
</html>
