<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #dc3545;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 0 0 5px 5px;
        }

        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="content">
        <p>Уважаемые представители компании <strong>{{ $company_name }}</strong>,</p>

        <p>К сожалению, ваша заявка на получение доступа была отклонена.</p>

        <div style="background-color: white; padding: 15px; border-left: 4px solid #dc3545; margin: 20px 0;">
            <strong>Причина отклонения:</strong><br>
            {{ $message }}
        </div>

        <p>Если у вас есть вопросы или вы хотите подать заявку повторно, пожалуйста, свяжитесь с нами.</p>

        <p>С уважением,<br>
            Команда Skazoknet</p>
    </div>

    <div class="footer">
        <p>Это автоматическое сообщение, пожалуйста, не отвечайте на него.</p>
    </div>
</body>

</html>
