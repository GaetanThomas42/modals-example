window.onload = function() {
  document.getElementById("main").classList.add("loaded")

  lax.setup()

  const update = () => {
    lax.update(window.scrollY)
    window.requestAnimationFrame(update)
  }

  window.requestAnimationFrame(update)

  let w = window.innerWidth
  window.addEventListener("resize", function() {
    if(w !== window.innerWidth) {
      lax.populateElements()
    }
  });
}