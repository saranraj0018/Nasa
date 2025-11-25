$(document).on("submit", "#taskForm", function (e) {
    alert(1);
    e.preventDefault();
    // Fields to validate
    let fields = [
        {
            id: "#admin_id",
            condition: (val) => val === "",
            message: "please select admin",
        },
        {
            id: "#task_title",
            condition: (val) => val === "",
            message: "Task Title is required",
        },
        {
            id: "#description",
            condition: (val) => val === "",
            message: "Description is required",
        },
        {
            id: "#priority",
            condition: (val) => val === "",
            message: "please select priority",
        },
        {
            id: "#deadline_date",
            condition: (val) => val === "",
            message: "Please Select Deadline Date",
        }
    ];

    let isValid = true;

    for (const field of fields) {
        const result = validateField(field);
        if (!result) isValid = false;
    }

    if (!isValid) return;
    let formData = new FormData(this);

    sendRequest(
        "/admin/save-task",
        formData,
        "POST",
        function (res) {
            if (res.success) {
                showToast(res.message, "success", 2000);
                setTimeout(function () {
                    window.location.href = "/admin/assign-tasks"; // Replace with your actual event list route
                }, 2000);
            } else {
                showToast(res.message, "error", 2000);
            }
        },
        function (err) {
            if (err.errors) {
                let msg = "";
                $.each(err.errors, function (k, v) {
                    msg += v[0] + "<br>";
                });
                showToast(msg, "error", 2000);
            } else {
                showToast(err.message || "Unexpected error", "error", 2000);
            }
        }
    );
});


document.addEventListener("DOMContentLoaded", function () {

    const dropArea = document.getElementById("dropArea");
    const fileInput = document.getElementById("fileInput");
    const previewArea = document.getElementById("previewArea");

    let filesArr = [];

    // -----------------------------
    // CLICK TO OPEN FILE SELECT
    // -----------------------------
    dropArea.addEventListener("click", () => {
        fileInput.click();
    });

    // -----------------------------
    // WHEN FILES SELECTED
    // -----------------------------
    fileInput.addEventListener("change", function () {
        handleFiles(this.files);
    });

    // -----------------------------
    // DRAG OVER
    // -----------------------------
    dropArea.addEventListener("dragover", function (e) {
        e.preventDefault();
        dropArea.classList.add("border-purple-500");
    });

    dropArea.addEventListener("dragleave", function () {
        dropArea.classList.remove("border-purple-500");
    });

    // -----------------------------
    // DROP FILES
    // -----------------------------
    dropArea.addEventListener("drop", function (e) {
        e.preventDefault();
        dropArea.classList.remove("border-purple-500");

        handleFiles(e.dataTransfer.files);
    });

    // -----------------------------
    // HANDLE FILES (ADD + PREVIEW)
    // -----------------------------
    function handleFiles(files) {
        [...files].forEach(file => {
            filesArr.push(file);
            previewFile(file);
        });
    }

    // -----------------------------
    // SHOW PREVIEW IMAGE
    // -----------------------------
    function previewFile(file) {
        const reader = new FileReader();
        reader.onload = function (e) {

            const wrapper = document.createElement("div");
            wrapper.className = "img-wrapper relative inline-block";

            wrapper.innerHTML = `
                <img src="${e.target.result}" class="rounded-lg w-full h-32 object-cover" />
                <button type="button"
                    class="remove-img absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-sm">&times;</button>
                <p class="text-gray-800 text-xs truncate w-[120px]">${file.name}</p>
            `;

            previewArea.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    }

    // -----------------------------
    // REMOVE IMAGE (NEW + EXISTING)
    // -----------------------------
    previewArea.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-img")) {
            const wrapper = e.target.closest(".img-wrapper");

            // If existing image → mark for deletion
            if (wrapper.dataset.existing) {
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "remove_images[]";
                hiddenInput.value = wrapper.dataset.existing;
                document.body.appendChild(hiddenInput);
            }

            wrapper.remove(); // remove visually
        }
    });

});

let removedImageIds = [];

$(document).on("click", ".remove-img", function (e) {
    e.preventDefault();

    let wrapper = $(this).closest(".img-wrapper");
    let imgId = wrapper.data("existing");

    if (imgId) {
        removedImageIds.push(imgId);
        $("#removedImages").val(JSON.stringify(removedImageIds));
    }

    wrapper.remove();
});












