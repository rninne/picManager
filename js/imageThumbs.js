var photoCard = Class.create();

photoCard.prototype = {
    photoImg: new Image(),
    photoCanvas: undefined,
    context: undefined,
    rotation: undefined,
    initialize: function (photo, album, rotation){
        this.rotation = rotation;
        this.photoCanvas = $(photo);
        this.context = this.photoCanvas.getContext('2d'),
        this.photoImg.src = 'images/'+ album +'/thumbs/small/'+photo+'.JPG';
        this.photoImg.onload = this.imageInit(this.photoImg);
    },
    src: '',
    calcOffset: function(a, w, h){
        var h1 = Math.sin(a) * w;
        var x = Math.sin(a) * h1;
        var y = Math.cos(a) * h1;
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
        var offset = this.calcOffset(a, w, h);
        var canvasWH = this.calcCWH(a, w, h);
        this.photoCanvas.width = canvasWH[0];
        this.photoCanvas.height = canvasWH[1];
        this.context.rotate(a);
        if(this.rotation < 0){
            offset[0] = offset[0] * -1;
            offset[1] = offset[1] * -1;
        } else {
            offset[1] = 0;        
        }
        this.context.drawImage(photo, offset[0], offset[1]);
        //cContext.drawImage(photo, -37, 65);
    },
    clearContext: function(){
        this.context.clearRect(0, 0, 0, 0);
    
    },
    
}
Event.observe(window, 'load', function(){
    // asdf = new photoCard('IMG_0023', 'photobooth', -60);
    // asdf1 = new photoCard('IMG_0026', 'photobooth', -50);
    // asdf2 = new photoCard('IMG_0028', 'photobooth', -40);
    // asdf3 = new photoCard('IMG_0031', 'photobooth', -30);
    // asdf4 = new photoCard('IMG_0036', 'photobooth', -20);
    
    });
//document.observe('dom:loaded', function () { });

function asdf(){
    asdf = new photoCard('IMG_0023', 'photobooth', -60);

}
function asdf2(){
    asdf.clearContext();

}




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
