$(document).ready(function() {
    $('#questionsTable').DataTable();

    // Open Edit Modal and Fetch Question Data
    $(".edit-btn").click(function() {
        var id = $(this).data("id");

        $.ajax({
            url: "../function/dynamic-edit.php",
            type: "POST",
            data: { question_id: id },
            dataType: "json",
            success: function(response) {
                $("#question_id").val(response.id);
                $("#question_text").val(response.question_text);
                $("#option_a").val(response.option_a);
                $("#option_b").val(response.option_b);
                $("#option_c").val(response.option_c);
                $("#option_d").val(response.option_d);
                $("#correct_option").val(response.correct_option);
                $("#editModal").show();
            }
        });
    });

    // Close Modal
    $(".close").click(function() {
        $("#editModal").hide();
    });

    // AJAX Update Question
    $("#editForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "../function/update-table.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    alert("Question updated successfully!");

                    // Update table row dynamically
                    $("#row_" + response.id).html(`
                        <td>${response.id}</td>
                        <td>${response.question_text}</td>
                        <td>${response.option_a}</td>
                        <td>${response.option_b}</td>
                        <td>${response.option_c}</td>
                        <td>${response.option_d}</td>
                        <td>${response.correct_option}</td>
                        <td>
                            <button class='edit-btn' data-id='${response.id}'>Edit</button>
                            <button class='delete-btn' data-id='${response.id}'>Delete</button>
                        </td>
                    `);
                    
                    $("#editModal").hide();
                } else {
                    alert("Error updating question.");
                }
            }
        });
    });
});
