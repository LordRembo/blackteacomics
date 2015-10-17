$(document).ready(function() {

    /**
     * E-mail address
     */
    var s = "znvygb:uryyb@oynpxgrnpbzvpf.pbz";
    String.prototype.rot13 = function(){
        return this.replace(/[a-zA-Z]/g, function(c){
            return String.fromCharCode((c <= "Z" ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
        });
    };
    $('.mail a').each(function(){
        $(this).attr('href',s.rot13());
    });

    /**
     * Retina comic imates
     */

     var comic = $('.comic-visuals .comic');

    if(window.devicePixelRatio >= 2) {

        comic.each(function() {

            var comic = $(this),
                cImg = comic.find('img'),
                src = cImg.attr('src');

            // split src
            var arr = cImg.attr('src').split("."),
            // save extention
                ext = '.' + arr[arr.length-1],
                newExt = '-hires' + ext,
            // save new src
                new_image_src = src.replace(ext, newExt);

            console.log(new_image_src);

            // try to load new img src
            $.ajax({url: new_image_src, type: "HEAD", success: function() {
                cImg.attr('src', new_image_src);
            }});
        });
    }

});
