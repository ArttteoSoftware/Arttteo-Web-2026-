<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 24px; }
        h2 { border-bottom: 2px solid #eee; padding-bottom: 8px; }
        .field { margin-bottom: 16px; }
        .label { font-weight: bold; color: #555; }
        .value { margin-top: 4px; }
        .situation { background: #f9f9f9; padding: 12px; border-left: 4px solid #ccc; white-space: pre-wrap; }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Quote Request</h2>

        <div class="field">
            <div class="label">Full Name</div>
            <div class="value">{{ $data['full_name'] }}</div>
        </div>

        <div class="field">
            <div class="label">Company Name</div>
            <div class="value">{{ $data['company_name'] }}</div>
        </div>

        <div class="field">
            <div class="label">Email</div>
            <div class="value">{{ $data['email'] }}</div>
        </div>

        @if (!empty($data['role']))
        <div class="field">
            <div class="label">Role</div>
            <div class="value">{{ $data['role'] }}</div>
        </div>
        @endif

        @if (!empty($data['operator_qty']))
        <div class="field">
            <div class="label">Operator Quantity</div>
            <div class="value">{{ $data['operator_qty'] }}</div>
        </div>
        @endif

        <div class="field">
            <div class="label">Situation</div>
            <div class="situation">{{ $data['situation'] }}</div>
        </div>
    </div>
</body>
</html>
