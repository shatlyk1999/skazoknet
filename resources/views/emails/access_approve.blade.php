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
            background-color: #28a745;
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

        .credentials {
            background-color: white;
            padding: 15px;
            border-left: 4px solid #28a745;
            margin: 20px 0;
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
        <p>Поздравляем, представители компании <strong>{{ $company_name }}</strong>!</p>

        <p>Ваша заявка на получение доступа была одобрена. Ниже приведены ваши данные для входа в систему:</p>

        <div class="credentials">
            <strong>Данные для входа:</strong><br><br>
            <strong>Логин:</strong> {{ $login }}<br>
            <strong>Пароль:</strong> {{ $password }}
        </div>

        @if ($message)
            <div style="background-color: white; padding: 15px; border-left: 4px solid #17a2b8; margin: 20px 0;">
                <strong>Дополнительная информация:</strong><br>
                {{ $message }}
            </div>
        @endif

        <p>Теперь вы можете войти в систему, используя предоставленные данные.</p>

        <p>Если у вас возникнут вопросы, пожалуйста, свяжитесь с нами.</p>

        <p>С уважением,<br>
            Команда Skazoknet</p>
    </div>

    <div class="footer">
        <p>Это автоматическое сообщение, пожалуйста, не отвечайте на него.</p>
        <p>Пожалуйста, сохраните эти данные в безопасном месте.</p>
    </div>
</body>

</html>
