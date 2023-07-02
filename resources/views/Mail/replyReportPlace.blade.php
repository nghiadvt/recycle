<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Email</title>
</head>

<body>
  <div>
    <h2 style="font-weight: 400; font-size: 16px">Hello,</h2>
    <p>
      Thanks for your contacting. We apologize for any delay in responding to
      your message.
    </p>
    <p>
      Please email us back with your service address and we will verify if we
      provide solid waste service to your location
    </p>
    <p>Thank you again for contacting us.</p>
    <div>
      <p>-----Original Message-----</p>
      <div>
        <span style="font-weight: 700">Send:</span>
        <span>{{ $dateNow }}</span>
      </div>
      <div>
        <span style="font-weight: 700">Subject:</span>
        <span style="font-weight: 700"> {{ $subject }}</span>
      </div>
    </div>
  </div>
</body>

</html>
