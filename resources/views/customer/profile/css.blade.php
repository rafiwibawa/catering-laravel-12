<style>
    /* === CSS yang kamu kirim tetap sama === */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 50%, #3f3f3f 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .profile-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        padding: 40px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideIn 0.5s ease-out;
        position: relative;
    }

    .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, #fcd34d 0%, #f59e0b 100%);
        border: none;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(252, 211, 77, 0.3);
        transition: all 0.3s ease;
    }

    .back-button:hover {
        transform: translateX(-4px);
        box-shadow: 0 6px 16px rgba(252, 211, 77, 0.4);
    }

    .back-button:active {
        transform: translateX(-2px);
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .profile-header { text-align: center; margin-bottom: 40px; }

    .avatar {
        width: 120px; height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #fcd34d 0%, #f59e0b 100%);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        font-size: 48px; color: white; font-weight: bold;
        box-shadow: 0 10px 30px rgba(252, 211, 77, 0.4);
        transition: transform 0.3s ease;
    }

    .avatar:hover { transform: scale(1.05); }

    .profile-name { font-size: 32px; color: #2d3748; font-weight: 700; margin-bottom: 8px; text-transform: capitalize; }

    .profile-role {
        display: inline-block;
        background: linear-gradient(135deg, #fcd34d 0%, #f59e0b 100%);
        color: #1f2937;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .profile-info { background: #f7fafc; border-radius: 16px; padding: 30px; margin-top: 30px; }

    .info-item {
        display: flex;
        align-items: flex-start;
        padding: 16px 0;
        border-bottom: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .info-item:last-child { border-bottom: none; }

    .info-item:hover {
        background: white;
        margin: 0 -15px;
        padding-left: 15px;
        padding-right: 15px;
        border-radius: 8px;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #fcd34d 0%, #f59e0b 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .info-content { flex: 1; }

    .info-label {
        font-size: 12px;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .info-value { font-size: 16px; color: #2d3748; font-weight: 500; }

    .profile-footer { margin-top: 30px; text-align: center; color: #718096; font-size: 12px; }

    .profile-id {
        display: inline-block;
        background: #edf2f7;
        padding: 6px 12px;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-size: 11px;
        color: #4a5568;
        margin-top: 10px;
    }

    @media (max-width: 640px) {
        .profile-container { padding: 24px; }
        .profile-name { font-size: 24px; }
        .avatar { width: 100px; height: 100px; font-size: 40px; }
    }
</style>