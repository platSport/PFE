<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background: #f9f9f9;
    }

    .container {
      max-width: 400px;
      width: 90%;
      margin: 50px auto;
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      margin-bottom: 20px;
      font-size: 24px;
      text-align: center;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    textarea {
      height: 150px;
      resize: vertical;
    }

    button[type="submit"] {
      width: 100%;
      padding: 10px;
      background: #11923c;
      border: none;
      color: #fff;
      font-size: 18px;
      cursor: pointer;
      border-radius: 5px;
    }

    button[type="submit"]:hover {
      background: #0f5f2a;
    }
  </style>
</head>

<body>
  <div class="container">
    <form id="contact" action="mail.php" method="post">
      <h1>Contact Form</h1>

      <input placeholder="Your name" name="name" type="text" tabindex="1" autofocus>
      
      <input placeholder="Your Email Address" name="email" type="email" tabindex="2">
      
      <input placeholder="Type your subject line" type="text" name="subject" tabindex="4">
      
      <textarea name="message" placeholder="Type your Message Details Here..." tabindex="5"></textarea>

      <button type="submit" name="send" id="contact-submit">Submit Now</button>
    </form>
  </div>
</body>

</html>
