<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi | Pesantren Riyadussalikin</title>
    <style>
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                padding: 10px !important;
            }
            .email-card {
                padding: 24px !important;
                border-radius: 12px !important;
            }
            .btn {
                display: block !important;
                text-align: center !important;
                width: auto !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                <!-- Outer Container -->
                <table border="0" cellpadding="0" cellspacing="0" class="email-container" width="600" style="width: 600px; padding: 0 20px;">
                    
                    <!-- Header/Logo -->
                    <tr>
                        <td align="center" style="padding-bottom: 24px;">
                            <img src="{{ asset('logo_pondok.png') }}" alt="Logo Pesantren Riyadussalikin" style="height: 70px; width: auto; display: block; margin-bottom: 10px; outline: none; border: none;">
                            <h2 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f766e; letter-spacing: 1.5px; text-transform: uppercase;">
                                Pondok Pesantren Riyadussalikin
                            </h2>
                            <p style="margin: 2px 0 0 0; font-size: 12px; color: #6b7280; font-weight: 500;">Padaherang, Pangandaran</p>
                        </td>
                    </tr>

                    <!-- Email Card -->
                    <tr>
                        <td class="email-card" style="background-color: #ffffff; padding: 40px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); border: 1px solid #e5e7eb;">
                            <!-- Accent top bar -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="height: 4px; background-color: #0d9488; border-radius: 4px 4px 0 0;"></td>
                                </tr>
                            </table>

                            <h1 style="margin-top: 24px; margin-bottom: 16px; font-size: 22px; font-weight: 700; color: #111827;">
                                Halo, {{ $name }}
                            </h1>
                            
                            <p style="font-size: 15px; line-height: 1.6; color: #374151; margin-bottom: 24px;">
                                Kami menerima permintaan untuk mengatur ulang kata sandi akun Administrator Anda di portal PPDB Pesantren Riyadussalikin.
                            </p>

                            <!-- CTA Button Container -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 30px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $url }}" class="btn" style="background-color: #0f766e; color: #ffffff; text-decoration: none; padding: 14px 30px; font-size: 15px; font-weight: 600; border-radius: 8px; display: inline-block; box-shadow: 0 4px 6px -1px rgba(13, 148, 136, 0.2), 0 2px 4px -1px rgba(13, 148, 136, 0.1); transition: background-color 0.2s;">
                                            Atur Ulang Kata Sandi
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Expiration Warning -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f0fdfa; border-radius: 8px; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 16px; border-left: 4px solid #f59e0b;">
                                        <p style="margin: 0; font-size: 13px; line-height: 1.5; color: #0f766e;">
                                            <strong>Penting:</strong> Link reset password ini hanya berlaku selama <strong>{{ $expire }} menit</strong> demi keamanan akun Anda.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; line-height: 1.5; color: #4b5563; margin-bottom: 24px;">
                                Jika Anda tidak meminta pengaturan ulang kata sandi ini, silakan abaikan email ini. Kata sandi Anda akan tetap aman dan tidak berubah.
                            </p>

                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0 20px 0;">

                            <!-- Trouble Clicking link -->
                            <p style="font-size: 12px; line-height: 1.5; color: #6b7280; margin: 0;">
                                Jika tombol di atas tidak berfungsi, salin dan tempel URL berikut ke browser Anda:
                            </p>
                            <p style="font-size: 11px; word-break: break-all; color: #0d9488; margin: 8px 0 0 0;">
                                <a href="{{ $url }}" style="color: #0d9488; text-decoration: none;">{{ $url }}</a>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding-top: 30px;">
                            <p style="margin: 0; font-size: 12px; color: #9ca3af; line-height: 1.5;">
                                Email ini dikirim secara otomatis oleh sistem portal PPDB Pesantren Riyadussalikin.
                            </p>
                            <p style="margin: 6px 0 0 0; font-size: 12px; color: #9ca3af;">
                                &copy; {{ date('Y') }} Pondok Pesantren Riyadussalikin Padaherang.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
