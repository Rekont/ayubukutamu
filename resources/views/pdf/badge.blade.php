<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; text-align: center; margin: 0; padding: 20px; }
        .badge-container { border: 2px solid #3b82f6; border-radius: 10px; padding: 30px 20px; background-color: #f8fafc; }
        .event-name { font-size: 16px; color: #64748b; margin-bottom: 20px; text-transform: uppercase; }
        .guest-name { font-size: 24px; font-weight: bold; color: #1e293b; margin-bottom: 5px; }
        .institution { font-size: 14px; color: #475569; margin-bottom: 30px; }
        .role { display: inline-block; background: #3b82f6; color: white; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="badge-container">
        <div class="event-name">{{ $guest->event->name }}</div>
        
        @if($guest->photo_path)
            <img src="{{ public_path('storage/' . $guest->photo_path) }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 15px;">
        @endif

        <div class="guest-name">{{ $guest->name }}</div>
        <div class="institution">{{ $guest->institution ?? 'Tamu Undangan' }}</div>
        
        <div class="role">VISITOR</div>
    </div>
</body>
</html>