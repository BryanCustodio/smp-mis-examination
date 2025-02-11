<?php
include '../db/dbcon.php';
?>


<h2>Update or Delete Questions</h2>

<!-- DataTable for Questions -->
<table id="questionsTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
            <th>Option D</th>
            <th>Correct Answer</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = $conn->query("SELECT * FROM questions");
        while ($row = $query->fetch_assoc()) {
            echo "<tr id='row_{$row['id']}'>
                <td>{$row['id']}</td>
                <td>{$row['question_text']}</td>
                <td>{$row['option_a']}</td>
                <td>{$row['option_b']}</td>
                <td>{$row['option_c']}</td>
                <td>{$row['option_d']}</td>
                <td>{$row['correct_option']}</td>
                <td>
                    <button class='edit-btn' data-id='{$row['id']}' data-question='{$row['question_text']}' data-a='{$row['option_a']}' data-b='{$row['option_b']}' data-c='{$row['option_c']}' data-d='{$row['option_d']}' data-correct='{$row['correct_option']}'>Edit</button>

                    <button class='delete-btn' data-id='{$row['id']}'>Delete</button>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

</table>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Edit Question</h3>
        <form id="editForm">
            <input type="hidden" name="question_id" id="question_id">
            <input type="text" name="question_text" id="question_text" required>
            <input type="text" name="option_a" id="option_a" required>
            <input type="text" name="option_b" id="option_b" required>
            <input type="text" name="option_c" id="option_c" required>
            <input type="text" name="option_d" id="option_d" required>
            <select name="correct_option" id="correct_option" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
</div>

<!-- DataTables Script -->
<script>
$(document).ready(function() {
    $('#questionsTable').DataTable();

    // Edit Button Click
    $(".edit-btn").click(function() {
        var id = $(this).data("id");
        $("#question_id").val(id);
        $("#question_text").val($(this).data("question"));
        $("#option_a").val($(this).data("a"));
        $("#option_b").val($(this).data("b"));
        $("#option_c").val($(this).data("c"));
        $("#option_d").val($(this).data("d"));
        $("#correct_option").val($(this).data("correct"));

        $("#editModal").show();
    });

    // Close Modal
    $(".close").click(function() {
        $("#editModal").hide();
    });

    // AJAX Update Question
    $("#editForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "../function/update.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });
});
</script>

<!-- CSS for Modal -->
<style>
.modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
.modal-content { background-color: #fff; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 30%; }
.close { color: #aaa; float: right; font-size: 28px; font-weight: bold; }
.close:hover, .close:focus { color: black; text-decoration: none; cursor: pointer; }
</style>
