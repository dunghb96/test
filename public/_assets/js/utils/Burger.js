import { disableBodyScroll, clearAllBodyScrollLocks } from "body-scroll-lock";

export default class Burger {
  constructor() {
    this.toggle = $(".js-burger-toggle");
    this.overlay = $(".burger-overlay");
    this.popup = document.querySelector(".header-buttons");
    this.isOpen = 0;
    this.init();
  }

  init() {
    this.toggle.on("click", () => {
      this.isOpen === 0 ? this.open() : this.close();
    });
  }

  open() {
    this.isOpen = 1;
    $(this.popup).addClass("is-active");
    this.overlay.stop().fadeIn(100);
    disableBodyScroll(this.popup);
  }

  close() {
    this.isOpen = 0;
    $(this.popup).removeClass("is-active");
    this.overlay.stop().fadeOut(100);
    clearAllBodyScrollLocks();
  }
}
