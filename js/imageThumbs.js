var photoCard = Class.create();
var imageThumbs = new Array();
photoCard.prototype = {
    photoImg: undefined,
    photoCanvas: undefined,
    context: undefined,
    rotation: undefined,
    initialize: function (photo, album, rotation){
        this.photoImg = new Image();
        this.rotation = rotation;
        this.photoCanvas = $(photo);
        this.context = this.photoCanvas.getContext('2d');
        // Event.observe(this.photoImg, 'load', this.imageInit(this.photoImg));
        // this.photoImg.onload = this.imageInit(this.photoImg);
        this.photoImg.src = 'images/'+ album +'/thumbs/small/'+photo+'.jpg';
    },
    src: '',
    calcOffset: function(a, w, h){
        var h1 = Math.sin(a) * w;
        var x = Math.sin(a) * h1;
        var y = Math.cos(a) * h1;
        return [x, y];
    },
    calcOffset2: function(a, w, h){
        var h1 = Math.sin(a) * h;
        var x = Math.cos(a) * h1;
        var y = Math.sin(a) * h1;
        return [x, y];
    },
    calcCWH: function(a, w, h){
        var h2 = Math.sqrt(w*w + h*h);
        var th = Math.atan(h/w);
        var H = Math.sin(Math.abs(th)+Math.abs(a)) * h2;
        var ty = Math.atan(w/h);
        var W = Math.sin(Math.abs(ty)+Math.abs(a)) * h2;
        return [W, H];
    },
    toRads: function(a){
        return a / 180 * Math.PI
    },
    imageInit: function(photo){
        var a = this.toRads(this.rotation);
        var w = photo.width; 
        var h = photo.height;
        var canvasWH = this.calcCWH(a, w, h);
        this.photoCanvas.width = canvasWH[0];
        this.photoCanvas.height = canvasWH[1];
        this.context.rotate(a);
        if(this.rotation < 0){
            var offset = this.calcOffset(a, w, h);
            offset[0] = offset[0] * -1;
            offset[1] = offset[1] * -1;
        } else {
            var offset = this.calcOffset2(a, w, h);
            offset[1] = offset[1] * -1;
        }
        this.context.drawImage(photo, offset[0], offset[1]);
        //cContext.drawImage(photo, -37, 65);
    },
    clearContext: function(){
        this.context.clearRect(0, 0, 0, 0);
    
    },
}
Event.observe(window, 'load', function(){
    for(j=0; j<imageThumbs.length; j++){
        if(imageThumbs[j].photoImg.complete){
            var asdf = imageThumbs[j].photoImg.src;
            imageThumbs[j].imageInit(imageThumbs[j].photoImg);
        } else {
            
        }
    }
});
document.observe('dom:loaded', function(){
    var cards = $$('canvas.card');
    var a = 0;
    for(i=0; i<cards.length; i++){
        if(cards[i].hasClassName('r')){
            a = -30;
        } else if(cards[i].hasClassName('rm')) {
            a = -15;
        } else if(cards[i].hasClassName('m')) {
            a = 0;
        } else if(cards[i].hasClassName('ml')) {
            a = 15;
        } else if(cards[i].hasClassName('l')) {
            a = 30;
        } else {
        }
        var asdf = new photoCard(cards[i].id, cards[i].readAttribute('album'), a);
        imageThumbs.push(asdf);
    }
});
// function asdf(){
    // asdf = new photoCard('IMG_0023', 'photobooth', -60);

// }
// function asdf2(){
    // asdf.clearContext();

// }

/*
    Event.observe(window, 'load', function(){
    
    //var photo1 = new photoCard('IMG_0023', 'photobooth');
    
    
    var photobooth_canvas_1 = $('photobooth_card_1');
    var photobooth_canvas_2 = $('photobooth_card_2');
    var photobooth_image_1 = new Image();
    photobooth_image_1.onload = function (){
        imageInit('photobooth', 1);
    }
    
    var photobooth_image_2 = new Image();
    photobooth_image_2.onload = function (){
        imageInit('photobooth', 1);
    }
    photobooth_image_1.src = 'images/marlene/thumbs/small/IMG_3446.jpg';
    //photobooth_image_1.src = 'images/marlene/thumbs/small/IMG_3498.jpg';
    
    
    function imageInit(album, image){
        var cContext = photobooth_canvas_1.getContext('2d');
        cContext.rotate(-30 * Math.PI / 180);
        cContext.drawImage(photobooth_image_1, 0, 0);
    }
    
});
*/
