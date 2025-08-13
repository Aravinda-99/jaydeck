class Preloader {
  constructor(btn) {
    if (!window.jQuery) {
      throw 'Jquery link කරලා නෑ';
    }

    if (!(btn instanceof jQuery)) {
      throw 'Button එක Jquery object එකක් වෙන්න ඕනේ';
    }

    this.btn = btn
    this.text = ""
  }

  start(color = "pl-light-blue", size = "pl-size-xs"){
    this.text = this.btn.text()
    this.btn.prop('disabled', true);
    this.btn.html(
      `<div class="preloader `+size+`">
          <div class="spinner-layer `+color+`">
              <div class="circle-clipper left">
                  <div class="circle"></div>
              </div>
              <div class="circle-clipper right">
                  <div class="circle"></div>
              </div>
          </div>
      </div>`
    )

  }

  stop (){
    this.btn.prop('disabled', false);
    this.btn.html(this.text)
  }
}
