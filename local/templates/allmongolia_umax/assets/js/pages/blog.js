window.addEventListener("DOMContentLoaded", () => {
  const sort = document.querySelector(".blog__sort");

  sort.addEventListener("click", () => {
    sort.classList.toggle("is-active");
  });

  document.querySelectorAll(".blog__sort-item").forEach(function (element) {
    element.addEventListener("click", function () {
      let selectText = this.textContent;
      document.querySelector(".blog__sort-top-text").textContent = selectText;
      document.querySelector(".blog__sort").classList.remove("is-active");
    });
  });
});
