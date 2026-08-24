<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Form Submission Alert</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
            color: #1e293b;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 28px 32px;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0 0 6px 0;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.3px;
        }
        .email-header p {
            margin: 0;
            color: #94a3b8;
            font-size: 13px;
        }
        .email-body {
            padding: 32px;
        }
        .badge-type {
            display: inline-block;
            background: #e0e7ff;
            color: #3730a3;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 20px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        .data-table th {
            text-align: left;
            padding: 12px 14px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            width: 35%;
            border-bottom: 1px solid #e2e8f0;
        }
        .data-table td {
            padding: 12px 14px;
            color: #0f172a;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 1px solid #f1f5f9;
            word-break: break-word;
        }
        .cta-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            border: 1px dashed #cbd5e1;
        }
        .cta-btn {
            display: inline-block;
            background: #059669;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
        }
        .email-footer {
            background: #f8fafc;
            padding: 20px 32px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #f1f5f9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Software Company in Lucknow</h1>
            <p>New Form Submission Received</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="badge-type">⚡ {{ $formType }}</div>

            <p style="margin-top: 0; font-size: 15px; line-height: 1.6; color: #334155;">
                Hello Admin,<br>
                A new submission has been recorded on your website. Below are the submission details:
            </p>

            <table class="data-table">
                <tbody>
                    @foreach($formData as $key => $value)
                        <tr>
                            <th>{{ $key }}</th>
                            <td>
                                @if(is_array($value))
                                    {{ json_encode($value) }}
                                @else
                                    {!! nl2br(e($value ?? 'N/A')) !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Submitted At</th>
                        <td>{{ $submittedAt }}</td>
                    </tr>
                </tbody>
            </table>

            @if(isset($formData['Mobile']) || isset($formData['Phone']))
                @php
                    $phoneNum = $formData['Mobile'] ?? $formData['Phone'];
                @endphp
                <div class="cta-box">
                    <p style="margin: 0 0 12px 0; font-size: 13px; font-weight: 600; color: #475569;">Quick Response Action:</p>
                    <a href="tel:+{{ preg_replace('/[^0-9]/', '', $phoneNum) }}" class="cta-btn">
                        📞 Call Client   ({{ $phoneNum }})
                    </a>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="email-footer">
            Automated Notification System • Software Company in Lucknow<br>
            <span style="color: #94a3b8;">This is an automated alert for admin notifications.</span>
        </div>
    </div>
</body>
</html>
