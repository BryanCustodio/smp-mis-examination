<?php include 'components/header.php'; ?>

<div class="container">
    <h2>Start Exam</h2>
    <form action="submit_exam.php" method="POST">
        <div class="question">
            <p>Question 1: What is 2 + 2?</p>
            <label><input type="radio" name="q1" value="4"> 4</label>
            <label><input type="radio" name="q1" value="5"> 5</label>
            <label><input type="radio" name="q1" value="6"> 6</label>
        </div>
        <button type="submit">Submit Exam</button>
    </form>
</div>
