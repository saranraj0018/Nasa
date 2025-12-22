$(function () {
    // ==== EDIT BANNER ====
    $(document).on("click", ".student_register", function () {
        var event_id = $(this).data("event_id");
        $.ajax({
            url: "get-student",
            type: "GET",
            data: {
                event_id: event_id,
                get_student: true,
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
                    document
                        .querySelector(".registerModal")
                        .classList.add("hidden");
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
                    showToast(
                        err?.message || "Unexpected error",
                        "error",
                        2000
                    );
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
        ongoingTab.classList.remove("bg-white", "text-primary", "rounded-full");
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

document.querySelectorAll(".pay-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        alert("Payment process started");
        payWithRazorpay(
            this.dataset.eventId,
            this.dataset.amount,
            this.dataset.title
        );
    });
});

// function payWithRazorpay(eventId, amount, title) {
//     $.ajax({
//         url: "razorpay-order",
//         type: "POST",
//         dataType: "json",
//         contentType: "application/json; charset=utf-8",
//         data: JSON.stringify({
//             event_id: eventId,
//             _token: $("meta[name='csrf-token']").attr("content"),
//         }),
//         success: function (order) {
//             var options = {
//                 key: window.RAZORPAY_KEY,
//                 amount: order.amount,
//                 currency: "INR",
//                 name: window.username,
//                 description: title,
//                 order_id: order.id,
//                 handler: function (response) {
//                     console.log(response);
//                     $.ajax({
//                         url: "razorpay_success",
//                         type: "POST",
//                         headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
//                         dataType: "json",
//                         contentType: "application/json; charset=utf-8",
//                         data: JSON.stringify({
//                             event_id: eventId,
//                             razorpay_payment_id: response.razorpay_payment_id,
//                             razorpay_order_id: response.razorpay_order_id,
//                             razorpay_signature: response.razorpay_signature,
//                         }),
//                         success: function (res) {
//                             alert(res.message || "Payment successful");
//                             location.reload();
//                         },
//                         error: function (err) {
//                             console.error(err);
//                             alert(err.responseJSON?.error || "Payment failed");
//                         },
//                     });
//                 },
//                 prefill: {
//                     name: window.username,
//                     email: window.email,
//                 },
//             };
//             var rzp = new Razorpay(options);
//             rzp.open();
//         },
//         error: function (err) {
//             alert(err.responseJSON?.error || "Unable to create order!");
//         },
//     });
// }
console.log(window.RAZORPAY_KEY);
function payWithRazorpay(eventId, title) {
    $.ajax({
        url: "razorpay-order",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: { event_id: eventId },
        success: function (order) {
            if (order.free === true) {
                alert(order.message);
                location.reload();
                return;
            }

            console.log("Razorpay order received:", order);

            var options = {
                key: window.RAZORPAY_KEY,
                amount: order.amount, // MUST be integer in paise
                currency: "INR",
                name: window.username,
                description: "Event Registration",
                order_id: order.id,
                image: "https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/razorpay-icon.png",
                handler: function (response) {
                    console.log("Razorpay response:", response);

                    $.ajax({
                        url: "/razorpay-success",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            event_id: eventId,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (res) {
                            alert(res.message);
                            location.reload();
                        },
                        error: function (err) {
                            console.error(err);
                            alert(
                                err.responseJSON?.error ||
                                    "Payment verification failed"
                            );
                        },
                    });
                },
                prefill: {
                    name: window.username,
                    email: window.email,
                },
                theme: { color: "#7A1C73" },
            };

            console.log("Razorpay options:", options);

            var rzp = new Razorpay(options);
            rzp.open();
        },
        error: function (err) {
            console.error(err);
            alert(err.responseJSON?.error || "Unable to create order");
        },
    });
}



