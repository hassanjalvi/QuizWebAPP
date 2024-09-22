<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container text-center">
    <h1>Your Result</h1>
    <div class="result_msg">
        <img src="assets/images/check.png" alt="check">
        Wow! You scored {{ $score }} out of {{ $totalQuestions }}!
    </div>
    <span>Your overall score:</span>
    <div class="u_prcnt">
        {{ round($percentageScore, 2) }}%
    </div>
</div>

</body>
</html>
