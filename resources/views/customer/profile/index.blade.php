<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelanggan</title>
    @include('customer.profile.css')
</head>
<body>
    <div class="profile-container">
        <button class="back-button" onclick="window.history.back()">
            <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            </svg>
        </button>
        
        <div class="profile-header">
            <div class="avatar">
                {{ strtoupper(substr($user->customer->name, 0, 1)) }}
            </div>
            <h1 class="profile-name">{{ $user->customer->name }}</h1>
            <span class="profile-role">{{ ucfirst($user->role) }}</span>
        </div>

        <div class="profile-info">
            <div class="info-item">
                <div class="info-icon">
                    <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <div class="info-content">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                </div>
                <div class="info-content">
                    <div class="info-label">Nomor Telepon</div>
                    <div class="info-value">{{ $user->customer->phone }}</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <div class="info-content">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">{{ ucfirst($user->customer->address) }}</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                        <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                    </svg>
                </div>
                <div class="info-content">
                    <div class="info-label">Tanggal Bergabung</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') }}</div>
                </div>
            </div>
        </div>

        <div class="profile-footer">
            <div class="profile-id">USER ID: #{{ $user->id }}</div>
        </div>
    </div>
</body>
</html>
