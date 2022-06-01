// import 'matchHeight';
import "lity";
// import 'drawsvg';
// import particles from "particles.js";
// import remodal from "remodal";
// import "slick-carousel";
import Burger from "./utils/Burger";
import validate from "./utils/validate";
import style from "./utils/style";
// import lit from "./utils/lit";

class Main {
  constructor() {
    new Burger();
  }
}

window.addEventListener("DOMContentLoaded", () => {
  new Main();
});
