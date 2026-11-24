$(document).on("submit", "#batchForm", function (e) {
    e.preventDefault();
    let $saveBtn = $("#batchSaveBtn");
    let originalHtml = $saveBtn.html();

    let fields = [
        {
            id: "#batch_name",
            condition: (val) => {
                if (!/^\d{4}-\d{4}$/.test(val)) return true;
                const [start, end] = val.split("-").map(Number);
                return end <= start || end - start > 10;
            },
            message: "Enter a valid batch, e.g. 2025-2029",
        },
    ];
    let isValid = true;
    for (const field of fields) {
        if (!validateField(field)) isValid = false;
    }
    if (!isValid) return;

    $saveBtn.prop("disabled", true).text("Saving...");

    sendRequest(
        appRoutes.save_batch,
        new FormData(this),
        "POST",
        function (res) {
            if (res.success) {
                showToast(res.message, "success", 2000);
                setTimeout(function () {
                    window.location.href = appRoutes.batch_list;
                }, 1500);
            } else {
                showToast(res.message || "Something went wrong!", "error", 2000);
                $saveBtn.prop("disabled", false).html(originalHtml);
            }
        },
        function (err) {
            if (err.errors) {
                let msg = "";
                $.each(err.errors, function (k, v) {
                    msg += v[0] + "<br>";
                });
                showToast(msg, "error", 3000);
            } else {
                showToast(err.message || "Unexpected error", "error", 2000);
            }
            $saveBtn.prop("disabled", false).html(originalHtml);
        }
    );
});
