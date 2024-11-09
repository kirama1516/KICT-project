//navigation
document.addEventListener("DOMContentLoaded", function() {
    const userLinks = document.querySelectorAll(".user-link");
    
    userLinks.forEach((link) => {
      link.addEventListener("click", (e) => {
        const userContent = document.getElementById(e.target.dataset.user);
        const allUserContents = document.querySelectorAll(".user-content");
        
        allUserContents.forEach((content) => {
          // content.style.display = "none";
          content.classList.remove("show");
          content.classList.add("hide");
        });
        
        // userContent.style.display = "block";
        userContent.classList.remove("hide");
        userContent.classList.add("show");
      });
    });
  });

  // slide
  var slideIndex = 1;
  showSlides(slideIndex);
  
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }
  
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }
  
  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length} ;
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].classList.remove("active");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].classList.add("active");
  }