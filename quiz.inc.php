<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>

    <body>
        <?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include('sidebar.php'); ?>
                <div class="span9" id="content">
                 
                <div class="span9" id="content">
                     <div class="row-fluid">
                       <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Quiz </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    
                                    <div class="card-body">
                    <?php include 'quiz.php' ?>
               </div>
       
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
        <?php include('footer.php'); ?>
        </div>
        <?php include('script.php'); ?>
    </body>

</html>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
     $(document).ready(function(){
    $.ajax({
        url: 'fetch_question.php',
        method: 'GET',
        success: function(data) {
            var questions = JSON.parse(data);
            var quizHtml = '';
            questions.forEach(function(question, index) {
                quizHtml += '<div class="mb-3">';
                quizHtml += '<p><strong>' + (index + 1) + '. ' + question.question + '</strong></p>';
                quizHtml += '<p> <div class="form-check">';
                quizHtml += '<input class="form-check-input" type="radio" name="question' + question.id + '" value="A" style="display: inline-block; margin-right: 5px;">';
                quizHtml += '<label class="form-check-label" style="display: inline-block;">' + question.option_a + '</label>';
                quizHtml += '</div></p><p>';
                quizHtml += '<div class="form-check">';
                quizHtml += '<input class="form-check-input" type="radio" name="question' + question.id + '" value="B" style="display: inline-block; margin-right: 5px;">';
                quizHtml += '<label class="form-check-label" style="display: inline-block;">' + question.option_b + '</label>';
                quizHtml += '</div></p><p>';
                quizHtml += '<div class="form-check">';
                quizHtml += '<input class="form-check-input" type="radio" name="question' + question.id + '" value="C" style="display: inline-block; margin-right: 5px;">';
                quizHtml += '<label class="form-check-label" style="display: inline-block;">' + question.option_c + '</label>';
                quizHtml += '</div></p><p>';
                quizHtml += '<div class="form-check">';
                quizHtml += '<input class="form-check-input" type="radio" name="question' + question.id + '" value="D" style="display: inline-block; margin-right: 5px;">';
                quizHtml += '<label class="form-check-label" style="display: inline-block;">' + question.option_d + '</label>';
                quizHtml += '</div></p><p>';
                quizHtml += '</div>';
            });
            $('#quizQuestions').html(quizHtml);
        }
    });

    $('#quizForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serializeArray();
        var score = 0;
        var totalQuestions = formData.length;
        
        $.ajax({
            url: 'fetch_question.php',
            method: 'GET',
            success: function(data) {
                var questions = JSON.parse(data);
                questions.forEach(function(question) {
                    var userAnswer = formData.find(item => item.name === 'question' + question.id);
                    if (userAnswer && userAnswer.value === question.correct_option) {
                        score++;
                        $('input[name="question' + question.id + '"][value="' + userAnswer.value + '"]').closest('.form-check').addClass('correct');
                    } else {
                        $('input[name="question' + question.id + '"][value="' + question.correct_option + '"]').closest('.form-check').addClass('correct');
                        if (userAnswer) {
                            $('input[name="question' + question.id + '"][value="' + userAnswer.value + '"]').closest('.form-check').addClass('incorrect');
                        }
                    }
                });
                $('#result').html('<h4>Your Score: ' + score + ' out of ' + totalQuestions + '</h4>');
            }
        });
    });
});

    </script>     