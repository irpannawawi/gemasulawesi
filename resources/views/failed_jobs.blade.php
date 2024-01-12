<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failed Jobs Table</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Failed Jobs Table</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Connection</th>
                <th>Queue</th>
                <th>Payload</th>
                <th>Exception</th>
                <th>Failed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($failed_jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->connection }}</td>
                    <td>{{ $job->queue }}</td>
                    <td>{{ $job->payload }}</td>
                    <td>{{ $job->exception }}</td>
                    <td>{{ $job->failed_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
