document.addEventListener("DOMContentLoaded", function () {

  // const enquiryBtn = document.querySelectorAll(".common-red-btn");
  // enquiryBtn.forEach((link) => {
  //   link.addEventListener("click", function (event) {
  //     const projecttitle = link.getAttribute("data-project-title");

  //     document.getElementById("projectTitle").value = projecttitle;
  //      document.getElementById("subject").value = projecttitle;
  //   });
  // });

  const enquiryForm = document.getElementById("enquiryform");

  if (enquiryForm) {
    enquiryForm.addEventListener("submit", function (event) {
      event.preventDefault();

      if (!this.checkValidity()) {
        return;
      }

      const submitButton = this.querySelector("[type='submit']");
      submitButton.disabled = true;
      submitButton.textContent = "Submitting...";

      var formData = new FormData(this);

      fetch("submit_form.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.text();
        })
        .then((data) => {
           window.location.href = `${window.location.origin}/hi-life-single/thankyou.php`;
          enquiryForm.reset();
        })
        .catch((error) => {
          console.error("Error:", error.message);
          alert("Oops! Something went wrong. Please try again later.");
        })
        .finally(() => {
          submitButton.disabled = false;
          submitButton.textContent = "Submit";
        });
    });
  } else {
    console.error("Enquiry form not found.");
  }
});
