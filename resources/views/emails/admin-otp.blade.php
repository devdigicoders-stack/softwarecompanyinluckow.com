<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Security OTP & Login Audit</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #334155;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f1f5f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width: 580px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08);">
                    
                    <!-- Header Banner -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); padding: 30px 25px; text-align: center;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -0.5px;">Software Company in Lucknow</h2>
                            <p style="color: #ecfdf5; margin: 5px 0 0 0; font-size: 14px; font-weight: 500;">Admin 2FA Security Login Verification</p>
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td style="padding: 30px 25px;">
                            <p style="margin: 0 0 15px 0; font-size: 15px; color: #1e293b; font-weight: 600;">
                                Hello {{ $adminName ?? 'Administrator' }},
                            </p>
                            <p style="margin: 0 0 25px 0; font-size: 14px; color: #475569; line-height: 1.6;">
                                A login attempt was initiated for your Administrative Account. Use the 6-digit OTP code below to verify your identity. This code is valid for <strong>2 minutes</strong>.
                            </p>

                            <!-- OTP Box -->
                            <div style="background-color: #ecfdf5; border: 2px dashed #059669; border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 30px;">
                                <div style="font-size: 12px; text-transform: uppercase; color: #047857; font-weight: 700; letter-spacing: 1px; margin-bottom: 8px;">
                                    Your 6-Digit OTP Code
                                </div>
                                <div style="font-family: 'Courier New', Courier, monospace; font-size: 36px; font-weight: 800; color: #065f46; letter-spacing: 8px;">
                                    {{ $otp }}
                                </div>
                                <div style="font-size: 12px; color: #059669; margin-top: 8px; font-weight: 600;">
                                    ⏰ Valid for 2 Minutes Only
                                </div>
                            </div>

                            <!-- Security Audit Table -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 25px;">
                                <div style="font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 12px; border-bottom: 1px solid #cbd5e1; padding-bottom: 8px;">
                                    🛡️ Login Security & Audit Info
                                </div>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="6" style="font-size: 13px; color: #475569;">
                                    <tr>
                                        <td width="35%" style="font-weight: 600; color: #64748b;">Account Email:</td>
                                        <td style="font-weight: 600; color: #0f172a;">{{ $email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #64748b;">IP Address:</td>
                                        <td style="font-weight: 600; color: #0f172a;">{{ $ipAddress }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #64748b;">Browser & OS:</td>
                                        <td style="font-weight: 600; color: #0f172a;">{{ $browser }} ({{ $deviceOs }})</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #64748b;">Login Location:</td>
                                        <td style="font-weight: 600; color: #0f172a;">
                                            <a href="{{ $mapUrl }}" target="_blank" style="color: #0284c7; text-decoration: underline; font-weight: 700; display: inline-block;">
                                                📍 {{ $locationAddress }} (Open Google Maps 🗺️)
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #64748b;">Request Time:</td>
                                        <td style="font-weight: 600; color: #0f172a;">{{ $requestTime }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Warning Box -->
                            <div style="background-color: #fff1f2; border-left: 4px solid #e11d48; padding: 12px 15px; border-radius: 6px; font-size: 12px; color: #9f1239; line-height: 1.5;">
                                <strong>⚠️ Security Notice:</strong> If you did not attempt to log in to the admin panel, please ignore this email or update your admin account password immediately.
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 25px; text-align: center; font-size: 12px; color: #94a3b8;">
                            &copy; {{ date('Y') }} Software Company in Lucknow. All rights reserved.<br>
                            Automated System Security Audit Notification.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
