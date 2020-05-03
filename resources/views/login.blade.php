<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://andybrewer.github.io/mvp/mvp.css">
    <title>Login</title>
  </head>
  <body>
    <main>
      <section>
        <form action="{{ route('login.submit') }}" method="POST">
        {{ csrf_field() }}
          <header>
            <h2>Login</h2>
          </header>
          <label for="input1">Email Address:</label>
          <input name="email" type="email" size="20" placeholder="Your email address">
          <button type="submit">Login</button>
        </form>
      </section>
    </main>
  </body>
</html>