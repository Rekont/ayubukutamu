<!DOCTYPE html>
<html>
<head>
    <title>Kehadiran Event</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Halo, {{ $guest->name }}!</h2>
    <p>Terima kasih telah hadir di acara <strong>{{ $guest->event->name }}</strong>.</p>
    <p>Sebagai tanda pengenal, kami telah melampirkan Badge (ID Card) digital Anda pada email ini. Anda bisa mengunduhnya dan menunjukkannya kepada panitia jika diperlukan.</p>
    <br>
    <p>Salam hangat,<br>Panitia {{ $guest->event->name }}</p>
</body>
</html>