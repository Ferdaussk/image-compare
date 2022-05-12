  $(window).on("elementor/frontend/init", function() {
      elementorFrontend.hooks.addAction("frontend/element_ready/NameImageCompare.default", function($scope) {

function imgCompare(compareItem, event, direction) {
  let afterImg = compareItem.querySelector(".bwdic-compare-img .bwdic-after");
  let beforeImg = compareItem.querySelector(".bwdic-compare-img .bwdic-before");
  let sliderBar = compareItem.querySelector(".bwdic-slider-bar .bwdic-drag-line");
  let compareInp = compareItem.querySelector(".bwdic-slider-bar .bwdic-range-inp");
  let beforeText = compareItem.querySelector(".bwdic-text-before");
  let afterText = compareItem.querySelector(".bwdic-text-after");

  let compareImgWidth = beforeImg.offsetWidth + "";

  if (event === "input") {
    compareInp.addEventListener("input", (e) => {
      afterImg.style.width = e.target.value + "px";
      sliderBar.style.left = e.target.value + "px";
    });

    compareInp.setAttribute("max", compareImgWidth);
  } else if (event === "hover") {
    compareItem.addEventListener("mousemove", (e) => {
      let hoverArea = e.clientX - compareItem.offsetLeft;
      let hoverArea2 = e.clientY - compareItem.getBoundingClientRect().top;

      if (
        e.clientX >= compareItem.offsetLeft &&
        e.clientX <= compareItem.offsetLeft + compareItem.offsetWidth
      ) {
        if (
          direction === "height" &&
          e.clientY >= compareItem.getBoundingClientRect().top &&
          e.clientY <=
            compareItem.getBoundingClientRect().top + compareItem.offsetHeight
        ) {
          afterImg.style.height = hoverArea2 + "px";
          sliderBar.style.top = hoverArea2 + "px";

          let beforeTop = beforeText.getBoundingClientRect().top;
          let afterTop = afterText.getBoundingClientRect().top;
          if (afterTop < e.clientY) {
            afterText.classList.add("active");
          } else if (beforeTop + beforeText.offsetHeight > e.clientY) {
            beforeText.classList.add("active");
          } else {
            afterText.classList.remove("active");
            beforeText.classList.remove("active");
          }
        } else if (direction === "width") {
          afterImg.style.width = hoverArea + "px";
          sliderBar.style.left = hoverArea + "px";

          let beforeLeft = beforeText.getBoundingClientRect().left;
          let afterLeft = afterText.getBoundingClientRect().left;

          if (beforeLeft + beforeText.offsetWidth > e.clientX) {
            beforeText.classList.add("active");
          } else if (afterLeft < e.clientX) {
            afterText.classList.add("active");
          } else {
            afterText.classList.remove("active");
            beforeText.classList.remove("active");
          }
        }
      }
    });
  }
}

});
});
// img compare 1==========================
const compareItem1 = document.querySelector(".bwdic-compare-item-1");
imgCompare(compareItem1, "input");

window.addEventListener('resize', ()=>{
  imgCompare(compareItem1, "input")
})
