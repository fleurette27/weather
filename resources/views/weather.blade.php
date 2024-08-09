<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .bg-image {
            background-image: url('https://images.unsplash.com/photo-1522364723953-452d3431c267?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            filter: brightness(0.7);
            background-size: cover;
            background-position: center;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="bg-image">
    <div class="container text-center">
        <h1 class="mb-4">Weather Search</h1>
        <p class="lead">Enter the name of a city or country to get the current weather information.</p>
        <form action="{{ route('weather') }}" method="GET">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="city" placeholder="Enter city name..." required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="mt-3">
            <h5>Examples:</h5>
            <p class="mb-0">London, UK</p>
            <p>Paris, FR</p>
            <p>New York, US</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
