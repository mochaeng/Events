const agreePressenceForm = document.getElementById("make-pressence");
const agreePressenceButton = agreePressenceForm.querySelector("a");

agreePressenceButton.addEventListener("click", (event) => {
    event.preventDefault();
    agreePressenceForm.submit();
});
