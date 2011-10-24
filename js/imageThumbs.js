var photoCard = Class.create();

photoCard.prototype = {
    initialize: function (photo, album){
        this.photoCanvas = $(photo);
        var photoImg = new Image();
        
        photoImg.onload = this.imageInit(photoImg);
        photoImg.src = 'images/'+ album +'/thumbs/small/'+photo+'.JPG';
        //alert('images/'+ album +'/thumbs/small/'+photo+'.JPG');
        
    },
    src: '',
    imageInit: function(photo){
        var cContext = this.photoCanvas.getContext('2d');
        cContext.rotate(-30 * Math.PI / 180);
        cContext.drawImage(photo, 0, 0);
    },   
    


}

document.observe('dom:loaded', function () { new photoCard('IMG_0023', 'photobooth'); });





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
