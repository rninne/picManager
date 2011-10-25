var photoCard = Class.create();

photoCard.prototype = {
    photoImg: new Image(),
    photoCanvas: undefined,
    rotation: undefined,
    initialize: function (photo, album, rotation){
        this.rotation = rotation;
        this.photoCanvas = $(photo);
        this.photoImg.src = 'images/'+ album +'/thumbs/small/'+photo+'.JPG';
        this.photoImg.onload = this.imageInit(this.photoImg);
        
        //alert('images/'+ album +'/thumbs/small/'+photo+'.JPG');
        
    },
    src: '',
    calcOffset: function(a, w, h){
        /*
        var y = Math.tan(Math.abs(a)) * w;
        var x = Math.tan(Math.abs(a)) * y;
        //alert('x: '+ x +' | y: '+ y);
        */
        var h1 = Math.sin(a) * w;
        var x = Math.sin(a) * h1;
        var y = Math.cos(a) * h1;
        alert('x: '+ x +' | y: '+ y);
        return [x, y];
    },
    toRads: function(a){
        return a / 180 * Math.PI
    },
    imageInit: function(photo){
        var a = this.toRads(this.rotation);
        var offset = this.calcOffset(a, photo.width, photo.height);
        
        var cContext = this.photoCanvas.getContext('2d');
        cContext.rotate(a);
        if(this.rotation < 0){
            offset[0] = offset[0] * -1;
            offset[1] = offset[1] * -1;
        }
        cContext.drawImage(photo, offset[0], offset[1]);
        //cContext.drawImage(photo, -37, 65);
    },   
    


}
Event.observe(window, 'load', function(){
    asdf = new photoCard('IMG_0023', 'photobooth', -30);
    asdf1 = new photoCard('IMG_0026', 'photobooth', -15);
    //asdf2 = new photoCard('IMG_0028', 'photobooth', 0);
    //asdf3 = new photoCard('IMG_0031', 'photobooth', 15);
    //asdf4 = new photoCard('IMG_0036', 'photobooth', 30);
    
    });
//document.observe('dom:loaded', function () { });






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
