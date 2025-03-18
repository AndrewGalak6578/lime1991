// import './bootstrap';

import 'inputmask';

var phone = document.getElementById('footer-your-phone');
if(document.body.contains(phone)){
    var im2 = new Inputmask('+7(999) 999-9999');
    im2.mask(phone);
}
