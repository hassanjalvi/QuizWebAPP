<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="assets/fonts/font.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/result_style.css">
</head>
<body>

<main class="overflow-hidden">
    <!-- Background -->
    <video class="main-background" autoplay muted loop id="myVideo">
        <source src="assets/images/question-kid.mp4" type="video/mp4">
    </video>
    <div class="countdown sm-none">
        <span id="countdown-timer">60</span>
        sec
    </div>
    <div class="row position-relative">
        <div class="col-md-7 ms-auto tab-70 sm-100">

            <!-- Form -->
           <!-- Form -->
<form method="post" action="{{ route('quiz.submit') }}">
    @csrf
    <div class="wrapper show-section">

        <br>
        <br>

        @foreach($questions as $index => $question)
        <section class="steps">
            <!-- Question -->
            <div class="quiz-question" style="margin-top: -160px">
                <h2>{{ $question->question_text }}</h2>
            </div>
            <br>
            <br>
            <br>
            <!-- Form -->
            <fieldset id="step{{ $index + 1 }}" style="margin-top: -105px">
                @foreach($question->answers as $answer)
                <div class="radio-field bounce-left">
                    <input type="radio" name="op{{ $index + 1 }}" value="{{ $answer->answer_text }}" name="user_anse">
                    <label>{{ $answer->answer_text }}</label>
                </div>
                @endforeach
            </fieldset>

            <!-- Next Previous -->
            <div class="next-prev">
                @if($index > 0)
                <button class="prev" type="button"><i class="fa-solid fa-arrow-left"></i> last question</button>
                @endif
                @if($index < count($questions) - 1)
                <button class="next" id="step{{ $index + 1 }}btn" type="button">next question<i class="fa-solid fa-arrow-right"></i></button>
                @else
                <!-- Only show submit button on the last question -->
                <button class="next" id="sub" type="submit">Submit<i class="fa-solid fa-arrow-right"></i></button>
                @endif
            </div>
        </section>
        @endforeach

    </div>
</form>

        </div>
    </div>

    <!-- Step Count -->
    <div class="step-count sm-none">
        <div class="step-count-inner">
            @foreach($questions as $index => $question)
            <div class="step-single{{ $index === 0 ? ' active show' : '' }}">
                <div class="step-line"></div>
                <div class="step-number">
                    <span>{{ $index + 1 }}</span>
                </div>
            </div>
            @endforeach
            <br>
        </div>
    </div>
    
    
</main>

<div id="error"></div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Result JS -->
<script src="assets/js/result.js"></script>

<!-- Custom JS -->
<script src="assets/js/custom.js"></script>

</body>
</html>
