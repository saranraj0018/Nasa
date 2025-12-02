$(function () {
// ==== EDIT BANNER ====
$(document).on("click", ".student_register", function () {
           var event_id = $(this).data("event_id");
        $.ajax({
            url: "get-student",
            type: "GET",
            data: {
                event_id:event_id,
                get_student: true
            },
            success: function (response) {
                if (response.success && response.student) {
                    var student_data = response.student;
                    $(".phone").val(student_data.mobile_number);
                    $(".email").val(student_data.email);
                    $(".name").val(student_data.name);
                    $(".student_id").val(student_data.id);
                    $(".event").val(response.event.title);
                    $(".event_id").val(response.event.id);
                    $(".stu_id").val(student_data.id);
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
});

$(document).on("submit", "#eventForm", function (e) {
    e.preventDefault();
   var registerSuccessBox = $(".registerSuccessBox");
    // Enable disabled inputs so FormData includes them
    const disabledInputs = [...this.querySelectorAll("input:disabled")];
    disabledInputs.forEach((input) => (input.disabled = false));
    let formData = new FormData(this);
    $.ajax({
        url: "/student/student-register-event",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (res) {
            if (res.success) {
                registerSuccessBox.removeClass("hidden");
                document.querySelector(".registerModal").classList.add("hidden");
                setTimeout(() => {
                    document.getElementById("eventForm").reset();
                }, 500);
                // window.location.reload();
            } else {
                showToast("Something went wrong!", "error", 2000);
            }
        },
        error: function (xhr) {
            const err = xhr.responseJSON;
            if (err && err.errors) {
                let msg = "";
                $.each(err.errors, function (k, v) {
                    msg += v[0] + "<br>";
                });
                showToast(msg, "error", 2000);
            } else {
                showToast(err?.message || "Unexpected error", "error", 2000);
            }
        },
    });

    // Re-disable previously disabled inputs (optional)
    disabledInputs.forEach((input) => (input.disabled = true));
});

});

function showSection(type) {
    const upcomingTab = document.getElementById("upcoming-tab");
    const ongoingTab = document.getElementById("ongoing-tab");
    const upcomingSection = document.getElementById("upcoming-section");
    const ongoingSection = document.getElementById("ongoing-section");
    if (type === "upcoming") {
        upcomingSection.classList.remove("hidden");
        ongoingSection.classList.add("hidden");
        upcomingTab.classList.add("bg-white", "text-primary", "rounded-full");
        ongoingTab.classList.remove(
            "bg-white",
            "text-primary",
            "rounded-full"
        );
    } else {
       ongoingSection.classList.remove("hidden");
       upcomingSection.classList.add("hidden");
       ongoingTab.classList.add("bg-white", "text-primary", "rounded-full");
       upcomingTab.classList.remove(
            "bg-white",
            "text-primary",
            "rounded-full"
        );
    }
}



